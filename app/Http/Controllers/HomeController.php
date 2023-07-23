<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\Facades\Image;
class HomeController extends Controller
{
    function dashboard(){
        return view('dashboard');
    }
    function user_profile(){
        return view('admin.user.user');
    }
    function user_info_update(Request $request){
        // echo $request->name;

        $request->validate([
            'name'=>'required',
            'email'=>'required | email:rfc,dns',
            // 'email'=>'email:rfc,dns',

        ]);

     User::find(Auth::id())->update([
        'name'=>$request->name,
        'email'=>$request->email,

     ]);

     return back();

    }

    function user_password_update(Request $request){
        $request->validate([
            'current_password'=> 'required',
            'password' => ['required', 'confirmed', Password::min(8)
                                                    ->letters()
                                                    ->mixedCase()
                                                    ->numbers()
                                                    ->symbols()],
            // 'password'=>'required | confirmed',
            // 'password'=>Password::min(8)
            //             ->letters()
            //             ->mixedCase()
            //             ->numbers()
            //             ->symbols(),
            'password_confirmation'=> 'required',

        ]);

        $user = User::find(Auth::id());

       if (password_verify($request->current_password, $user->password)) {
            User::find(Auth::id())->update([
                'password'=>bcrypt($request->password),

            ]);

            return back()->with('password_update', 'Password Updated Successfully');
       } else {
            return back()->with('current_password', 'Wrong Current Password!');
       }


    }

    function user_photo_update(Request $request){
        // print_r($request->photo);
        $request->validate([
            'photo'=> 'required | image',
            // 'photo'=> 'required | mimes:jpg,png',

        ]);
        $photo = $request->photo;
        $extension = $photo->extension();
        // echo $extension;
        $file_name = Auth::id().'.'.$extension;
        // echo $file_name;

        $image = Image::make($photo)->resize(300, 200)->save(public_path('uploads/user/'.$file_name));

        User::find(Auth::id())->update([
            'photo'=>$file_name,

        ]);
        return back()->with('photo_update', 'Photo Updated successfully');
    }
}
