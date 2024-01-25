<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Authentication extends Controller
{
    public function USignUp(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:6|unique:users,name|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/',
                'email' => 'required | email | unique:users,email',
                'password' =>
                'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/'
            ]
        );
        if ($validator->fails()) {
            return json_encode([
                'status' => 'failed',
                'message' => $validator->errors()
            ]);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $userid = DB::getPdo()->lastInsertId();
        if ($userid) {
            return json_encode([
                'status' => 'success',
                'message' =>  'Signing up is successfully done',
                'userid' => $userid,
                'token' =>  $user->createToken('token')->plainTextToken
            ]);
        }
        return json_encode([
            'status' => 'failed',

        ]);
    }

    public function USignIn(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' =>
                'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/'
            ]
        );
        if ($validator->fails()) {
            return json_encode([
                'status' => 'failed',
                'message' => $validator->errors()
            ]);
        }

        $user =  User::where('email', $request->email)->first();
        $comapny =  Company::where('email', $request->email)->first();
        if ($user) {
            if (!Hash::check($request->password, $user->password)) {
                return json_encode([
                    'status' => 'failed',
                    'message' => [
                        'name' =>
                        'Password is wrong'
                    ]
                ]);
            }

            return json_encode([
                'status' => 'success',
                'message' =>  'Signing in is successfully done',
                $user ? 'userid' :'comid' =>$user?  "$user->id" : "$comapny->id",
                'token' =>  $user->createToken('token')->plainTextToken
            ]);
        }
        else if($comapny){
            if (!Hash::check($request->password, $comapny->password)) {
                return json_encode([
                    'status' => 'failed',
                    'message' => [
                        'name' =>
                        'Password is wrong'
                    ]
                ]);
            }

            return json_encode([
                'status' => 'success',
                'message' =>  'Signing in is successfully done',
                $user ? 'userid' : 'comid' => $user ?  "$user->id" : "$comapny->id",
                'token' =>$user?  $user->createToken('token')->plainTextToken: $comapny->createToken('token')->plainTextToken
            ]);
        }
        return json_encode([
            'status' => 'failed',
            'message' => [
                'email' =>
                'Email is not found'
            ]
        ]);
    }


    public function CSignUp(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:6|unique:company,name|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/',
                'email' => 'required | email | unique:company,email',
                'password' =>
                'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/'
            ]
        );
        if ($validator->fails()) {
            return json_encode([
                'status' => 'failed',
                'message' => $validator->errors()
            ]);
        }
        $comapny = new Company();
        $comapny->name = $request->name;
        $comapny->email = $request->email;
        $comapny->password = Hash::make($request->password);
        $comapny->save();
        $comid = DB::getPdo()->lastInsertId();
        return json_encode([
            'status' => 'success',
            'message' =>  'Signing up is successfully done',
            'comid' => $comid,
            'token' =>  $comapny->createToken('token')->plainTextToken
        ]);
    }


}
