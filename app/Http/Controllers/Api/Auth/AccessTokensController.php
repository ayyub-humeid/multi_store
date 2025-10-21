<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Laravel\Sanctum\PersonalAccessToken;
use PhpParser\Node\Stmt\Return_;

class AccessTokensController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'email' => 'required|string|max:255',
            'password'=>'required|string',
            'device_name'=>'string|max:255'
        ]);
        $user = User::where('email',$request->email)->first();
        $device_name = $request->post('device_name',$request->userAgent());
        if($user && Hash::check($request->password,$user->password)){
           $token =  $user->createToken($device_name);
            return Response::json([
                'token'=> $token->plainTextToken,
                'user'=>$user
            ],201);
        }
        return Response::json([
            'code'=> 0,
            'message'=>'Invalid credentials'
        ],401);
    }
    public function destroy($token=null){
        $user = Auth::guard('sanctum')->user();
        // logout fron all devices
        // $user->tokens()->delete();
        if(null ===$token){
            $user->currentAccessToken()->delete();
            return ;
        }
        $personal_access_token = PersonalAccessToken::findToken($token);
        if($user->id == $personal_access_token->tokenable_id && get_class($user) == $personal_access_token->tokenable_type ){
                $personal_access_token->delete();
        }

        $user->tokens()->where('token',$token)->delete();
    }
}
