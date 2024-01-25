<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment as ModelsComment;
use Illuminate\Http\Request;

class Comment extends Controller
{
    public function getComments($id)
    {
        $comments = ModelsComment::where('offer_id', $id)->get();
        $message = [];
        for ($i = 0; $i < count($comments); $i++) {
            array_push($message, [
                'comment' => $comments[$i],
                'user' => $comments[$i]->user,
                'user_profile' => json_decode(app(\App\Http\Controllers\Uprofile::class)->getUProfile($comments[$i]->user->id))->message,

            ]);
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

    public function addComment(Request $request)
    {
        $comment = new ModelsComment();
        $comment->content = $request->content;
        $comment->offer_id = $request->offer_id;
        $comment->user_id = $request->user_id;
        $comment = $comment->save();
        if ($comment) {
            return [
                'status' => 'success',

            ];
        }
        return [
            'status' => 'failed',

        ];
    }
}
