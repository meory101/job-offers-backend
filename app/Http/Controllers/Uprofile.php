<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Uprofile as ModelsUprofile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use ReturnTypeWillChange;

class Uprofile extends Controller
{
    public function getUProfile($id)
    {
        $uprofile = ModelsUprofile::where('user_id', $id)->first();
        if ($uprofile) {
            return json_encode([
                'status' => 'success',
                'message' => $uprofile,
                'userdata' => $uprofile->user
            ]);
        }
        return json_encode([
            'status' => 'failed',
        ]);
    }
    public function CreateUProfile(Request $request)
    {
        $uprofile = new ModelsUprofile();
        $uprofile->graduated_at = $request->graduated_at;
        $uprofile->worked_at = $request->worked_at;
        $uprofile->cv_url = $request->cv_url;
        $uprofile->image_url = $request->image_url;
        $uprofile->cover_url = $request->cover_url;
        $uprofile->user_id = $request->user_id;


        $image = $request->file('image')->store('public');
        $uprofile->image_url = basename($image);

        $cover = $request->file('cover')->store('public');
        $uprofile->cover_url = basename($cover);

        $cv = $request->file('cv')->store('public');
        $uprofile->cv_url = basename($cv);

        $uprofile->save();
        $uprofileid = DB::getPdo()->lastInsertId();
        if ($uprofile) {
            return json_encode([
                'status' => 'success',
                'message' => $uprofileid
            ]);
        }
        return json_encode([
            'status' => 'failed',
        ]);
    }
    public function UpdateUProfile(Request $request)
    {
        $uprofile =  ModelsUprofile::find($request->id);
        if($request->has('graduated_at')){
            $uprofile->graduated_at = $request->graduated_at;
            $uprofile->worked_at = $request->worked_at;
            $uprofile->user_id = $request->user_id;
        }
       
        if($request->file('image')){
            Storage::delete('public/'.$uprofile->image_url);
            $image = $request->file('image')->store('public');
            $uprofile->image_url = basename($image);
        }
        if ($request->file('cover')) {
            Storage::delete('public/' . $uprofile->image_url);
            $image = $request->file('cover')->store('public');
            $uprofile->cover_url = basename($image);
        }
        if ($request->file('cv')) {
            Storage::delete('public/' . $uprofile->image_url);
            $image = $request->file('cv')->store('public');
            $uprofile->cv_url = basename($image);
        }
        $uprofile->save();
        if ($uprofile) {
            return json_encode([
                'status' => 'success',
            ]);
        }
        return json_encode([
            'status' => 'failed',
        ]);
    }
}
