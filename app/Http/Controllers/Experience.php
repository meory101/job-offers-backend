<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Experience as ModelsExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Experience extends Controller
{
    public function  getExp($id)
    {
        $exp = ModelsExperience::where('profile_id', $id)->get();
        if (count($exp)>0) {
            return json_encode([
                'status' => 'success',
                'message' => $exp
            ]);
        }
        return json_encode([
            'status' => 'failed',
        ]);
    }
    public function CreateExp(Request $request)
    {
        $exp = new ModelsExperience();
        $exp->title = $request->title;
        $exp->content = $request->content;
        $exp->years = $request->years;
        $exp->profile_id = $request->profile_id;
        if($request->file('image')){
            $image = $request->file('image')->store('public');
            $exp->image_url = basename($image);
        }
        $exp->save();
        $expid = DB::getPdo()->lastInsertId();
        if ($exp) {
            return json_encode([
                'status' => 'success',
                'message' => $expid
            ]);
        }
        return json_encode([
            'status' => 'failed',
        ]);
    }
    public function UpdateExp(Request $request)
    {
        $exp =  ModelsExperience::where('id', $request->id)->first();
        $exp->title = $request->title;
        $exp->content = $request->content;
        $exp->years = $request->years;
        $exp->profile_id = $request->profile_id;
        if ($request->file('image')) {
            Storage::delete('public/' . $exp->imageurl);
            $image = $request->file('image')->store('public');
            $exp->image_url = basename($image);
        }
        $exp->save();
        if ($exp) {
            return json_encode([
                'status' => 'success',
            ]);
        }
        return json_encode([
            'status' => 'failed',
        ]);
    }
    public function DeleteExp(Request $request)
    {
        $exp =  ModelsExperience::where('id', $request->id)->first();
        
        if ($exp) {
            $exp->delete();
            return json_encode([
                'status' => 'success',
            ]);
        }
        return json_encode([
            'status' => 'failed',
        ]);
    }
}
