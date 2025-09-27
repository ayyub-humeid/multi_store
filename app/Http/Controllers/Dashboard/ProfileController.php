<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit(){
        $user = Auth::user();
        return view('dashboard.profile.edit',compact('user'));
    }
    public function update(Request $request){
        $request->validate([
            'first_name'=> ['required','string','max:255'],
            'last_name'=> ['required','string','max:255'],
            'birthday'=> ['nullable','date','before:today'],
            'gender'=> ['in:mail,female'],
            'country'=>['required','string','size:2']
        ]);
        $user = Auth::user();
        $user->profile->fill($request->all())->save();
        return redirect()->route('dashboard.profile.edit');
        // $profile = $user->profile;
        // if($profile->first_name){
        //     $user->profile->update($request->all());
        // }else{
        //     // $request->merge([
        //     //     'user_id'=> $user->id
        //     // ]);
        //     // Profile::create($request->all())
        //     $user->profile()->create($request->all());
        // }

    }
}
