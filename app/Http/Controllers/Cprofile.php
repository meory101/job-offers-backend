<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cprofile as ModelsCprofile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Cprofile extends Controller
{
    public function getCProfile($id)
    {
        $cprofile = ModelsCprofile::where('id', $id)->first();
        if ($cprofile) {
            return json_encode([
                'status' => 'success',
                'message' => $cprofile
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
        $cprofile->location = $request->location;
        $cprofile->company_id = $request->company_id;
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
        $cprofile->work_type = $request->work_type;
        $cprofile->location = $request->location;
        $cprofile->company_id = $request->company_id;
        $cprofile->save();
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
