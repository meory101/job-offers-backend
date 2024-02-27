<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\User;
use App\Models\User_Offer as ModelsUser_Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class User_Offer extends Controller
{
    public function checkSendCv($userid, $offerid)
    {
        $isSended = ModelsUser_Offer::where('user_id', $userid)->where('offer_id', $offerid)->first();
        if ($isSended) {
            return json_encode([

                'message' => 'sended'
            ]);
        }
        return json_encode([

            'message' => 'not sended'
        ]);
    }
    public function acceptcv(Request $request)
    {
        $new = ModelsUser_Offer::where('id', $request->id)->first();

        if ($new) {
            $new->res = $request->res;
            $file = $request->file('file')->store('public');
            $new->file_url = basename($file);
            $new->save();
            return json_encode([
                'status' => 'success',
            ]);
        }
        return json_encode([
            'status' => 'failed'
        ]);
    }
    public function getUoffers($userid)
    {
        $message = [];
        $user_offers = ModelsUser_Offer::where('user_id', $userid)->get();
        if ($user_offers) {
            for ($i = 0; $i < count($user_offers); $i++) {
                array_push(
                    $message,
                    [
                        'data' =>    $user_offers[$i],
                        'offerdata' =>  $user_offers[$i]->offer,
                        'com' => json_decode(app(\App\Http\Controllers\Cprofile::class)->getProfile($user_offers[$i]->offer['profile_id']))

                    ]
                );
            }
            if ($message) {
                return [
                    'status' => 'success',
                    'message' => $message
                ];
            }
            return [
                'status' => 'failed',

            ];
        }
    }
    public function getCoffers($cprofileid)
    {
        $message = [];

        $offers = Offer::where('profile_id', $cprofileid)->get();
        if ($offers) {
            $users = [];
            $users_data = [];
            for ($i = 0; $i < count($offers); $i++) {
                $offer_user = ModelsUser_Offer::where('offer_id', $offers[$i]['id'])->get();
                for ($j = 0; $j < count($offer_user); $j++) {

                    array_push($users, User::where('id', $offer_user[$j]['user_id'])->first());

                    array_push($users_data, json_decode(app(\App\Http\Controllers\Uprofile::class)->getUProfile($offer_user[$j]['user_id'])));
                }
                $users = array_unique($users);
                if (count($offer_user)) {
                    array_push(
                        $message,
                        [
                            'offerdata' =>  $offers[$i],
                            'offerusers' =>  $users,
                            'usersdata' => $users_data,
                            'data' => $offer_user

                        ]
                    );
                }
            }
            if ($message) {
                return [
                    'status' => 'success',
                    'message' => $message
                ];
            }
            return [
                'status' => 'failed',

            ];
        }
    }
    public function addDeal(Request $request)
    {
        $deal = new ModelsUser_Offer();
        $deal->res = '0';
        $deal->file_url = '';
        $deal->user_id = $request->user_id;
        $deal->offer_id = $request->offer_id;
        $deal = $deal->save();
        if ($deal) {
            return json_encode([
                'status' => 'success',

            ]);
        }
        return json_encode([
            'status' => 'failed',

        ]);
    }
}
