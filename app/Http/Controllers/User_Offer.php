<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\User_Offer as ModelsUser_Offer;
use Illuminate\Http\Request;

class User_Offer extends Controller
{
    public function checkSendCv($userid,$offerid){
            $isSended = ModelsUser_Offer::where('user_id',$userid)->where('offer_id',$offerid)->first();
            if($isSended){
            return [
            
                'message' => 'sended'
            ];
            }
        return [

            'message' => 'not sended'
        ];
    }
    public function getUoffers($userid){
        $message = [];
        $user_offers = ModelsUser_Offer::where('user_id',$userid)->get();
        if($user_offers){
            for($i=0;$i<count($user_offers);$i++){
                        array_push(
                    $message,
                            [
                                $user_offers[$i],
                                $user_offers[$i]->offer,

                            ]
                        );
            }
            if($message){
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
            for ($i = 0; $i < count($offers); $i++) {
                array_push(
                    $message,
                    [
                      'offerdata' =>  $offers[$i],
                      'offerusers' =>  $offers[$i]->user_offer->user->all(),
                      'user_offer' => $offers[$i]->user_offer->all()

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
}
