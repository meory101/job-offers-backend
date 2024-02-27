<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Offer as ModelsOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Offer extends Controller
{
    public function getAllOffers()
    {
        $offers = ModelsOffer::all();
        $message  = [];
        for ($i = 0; $i < count($offers); $i++) {
            array_push(
                $message,
                [
                    'offers' => $offers[$i],
                    'com_profile' =>
                    json_decode(app(\App\Http\Controllers\Cprofile::class)->getCProfile($offers[$i]->cprofile->id)),
                    'com_name' => $offers[$i]->cprofile->company
                ]
            );
        }
        if (count($offers) > 0) {
            return [
                'status' => 'success',
                'message' => $message
            ];
        }
        return [
            'status' => 'failed',

        ];
    }
    public function  getOffer($id)
    {
        $offer = ModelsOffer::where('profile_id', $id)->get();
        if (count($offer) > 0) {
            return json_encode([
                'status' => 'success',
                'message' => $offer
            ]);
        }
        return json_encode([
            'status' => 'failed',
        ]);
    }
    public function  SearchOffer($hashtag)
    {
        $message  = [];
        $offers = ModelsOffer::where('hashtag', 'like', '%' . $hashtag)->get();
        if (count($offers) > 0) {
            for ($i = 0; $i < count($offers); $i++) {
                array_push(
                    $message,
                    [
                        'offers' => $offers[$i],
                        'com_profile' =>
                        json_decode(app(\App\Http\Controllers\Cprofile::class)->getCProfile($offers[$i]->cprofile->id)),
                        'com_name' => $offers[$i]->cprofile->company
                    ]
                );
            }
            if (count($message) > 0) {
                return [
                    'status' => 'success',
                    'message' => $message
                ];
            }
        }
        return [
            'status' => 'failed',

        ];
    }
    public function CreateOffer(Request $request)
    {
        $offer = new ModelsOffer();
        $offer->content = $request->content;
        $offer->hashtag = $request->hashtag;
        $offer->date = $request->date;
        $offer->profile_id = $request->profile_id;
        if ($request->file('image')) {
            $image = $request->file('image')->store('public');
            $offer->image_url = basename($image);
        }
        $offer->save();
        $offerid = DB::getPdo()->lastInsertId();
        if ($offer) {
            return json_encode([
                'status' => 'success',
                'message' => $offerid
            ]);
        }
        return json_encode([
            'status' => 'failed',
        ]);
    }
    public function Updateoffer(Request $request)
    {
        $offer =  ModelsOffer::where('id', $request->id)->first();
        $offer->content = $request->content;
        $offer->hashtag = $request->hashtag;
        $offer->date = $request->date;
        $offer->profile_id = $request->profile_id;
        if ($request->file('image')) {
            Storage::delete('public/' . $offer->imageurl);
            $image = $request->file('image')->store('public');
            $offer->image_url = basename($image);
        }
        $offer->save();
        if ($offer) {
            return json_encode([
                'status' => 'success',
            ]);
        }
        return json_encode([
            'status' => 'failed',
        ]);
    }
    public function Deleteoffer(Request $request)
    {
        $offer =  ModelsOffer::where('id', $request->id)->first();

        if ($offer) {
            $offer->delete();
            return json_encode([
                'status' => 'success',
            ]);
        }
        return json_encode([
            'status' => 'failed',
        ]);
    }
}
