<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cprofile as ModelsCprofile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Cprofile extends Controller
{
    public function getCProfile($id)
    {
        $cprofile = ModelsCprofile::where('company_id', $id)->first();
        if ($cprofile) {
            return json_encode([
                'status' => 'success',
                'message' => $cprofile,
                'comdata' => $cprofile->company
            ]);
        }
        return json_encode([
            'status' => 'failed',
        ]);
    }
    public function getProfile($pid)
    {
        $cprofile = ModelsCprofile::where('id', $pid)->first();
        if ($cprofile) {
            return json_encode([
                'status' => 'success',
                'message' => $cprofile,
                'comdata' => $cprofile->company
            ]);
        }
        return json_encode([
            'status' => 'failed',
        ]);
    }
    public function CreateCProfile(Request $request)
    {
        $cprofile = new ModelsCprofile();
        $cprofile->work_type = $request->work_type;
        $cprofile->lat = $request->lat;
        $cprofile->long = $request->long;
        $cprofile->company_id = $request->company_id;
        $image = $request->file('image')->store('public');
        $cprofile->image_url = basename($image);
        $cover = $request->file('cover')->store('public');
        $cprofile->cover_url = basename($cover);
        $cprofile->save();
        $cprofileid = DB::getPdo()->lastInsertId();
        if ($cprofile) {
            return json_encode([
                'status' => 'success',
                'message' => $cprofileid
            ]);
        }
        return json_encode([
            'status' => 'failed',
        ]);
    }
    public function UpdateCProfile(Request $request)
    {
        $cprofile =  ModelsCprofile::where('id', $request->id)->first();
        if ($request->has('wo')) {
            $cprofile->work_type = $request->wo;
            $cprofile->lat = $request->lat;
            $cprofile->long = $request->long;
            $cprofile->company_id = $request->com_id;
        }


        if ($request->file('image')) {
            Storage::delete('public/' . $cprofile->image_url);
            $image = $request->file('image')->store('public');
            $cprofile->image_url = basename($image);
        }
        if ($request->file('cover')) {
            Storage::delete('public/' . $cprofile->image_url);
            $image = $request->file('cover')->store('public');
            $cprofile->cover_url = basename($image);
        }

        $cprofile = $cprofile->save();
        if ($cprofile) {
            return json_encode([
                'status' => 'success',
            ]);
        }
        return json_encode([
            'status' => 'failed',
        ]);
    }
}
