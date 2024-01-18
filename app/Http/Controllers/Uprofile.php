<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Uprofile as ModelsUprofile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ReturnTypeWillChange;

class Uprofile extends Controller
{
    public function getUProfile(Request $request)
    {
        $uprofile = ModelsUprofile::where('id',$request->id);
        if ($uprofile) {
            return json_encode([
                'status' => 'success',
                'message' => $uprofile
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
        $uprofile->user_id = $request->user_id;
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
        $uprofile =  ModelsUprofile::where('id',$request->id)->first();
        $uprofile->graduated_at = $request->graduated_at;
        $uprofile->worked_at = $request->worked_at;
        $uprofile->cv_url = $request->cv_url;
        $uprofile->user_id = $request->user_id;
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
}
