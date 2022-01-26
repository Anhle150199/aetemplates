<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{

    public function updateProfile(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
            ]
        );
        // $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return new JsonResponse(['errors' => $validator->getMessageBag()->toArray()], 406);
        }

        $user = Auth::user();
        if ( $user->name == $request->name && $user->email == $request->email){
            return new JsonResponse(['errors' => ['name'=> 'Name and Email not change']], 406);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $response = array(
            'status' => 'success',
            'msg'    => 'Update successfully',
            'name' => $user->name
        );
        return new JsonResponse($response, 200);
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make(
            $request->all(),
            [
                'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        return $fail(__('The current password is incorrect.'));
                    }
                }],
                'password' => ['required', 'string', 'min:8', 'differen t:current_password', 'confirmed'],
            ]
        );

        if ($validator->fails()) {
            return new JsonResponse(['errors' => $validator->getMessageBag()->toArray()], 406);
        }

        $user->password = Hash::make($request->password);
        $user->save();
        $response = array(
            'status' => 'success',
            'msg'    => 'Update successfully',
        );
        return new JsonResponse($response, 200);
    }

    public function updateAvatar(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file;
        $pathFile = 'img/avatar/';
        $newAvatar = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($pathFile, $newAvatar);
        if ($user->profile_photo_path != 'avatar1.png') {
            File::delete($pathFile . $user->profile_photo_path);
        }
        $user->profile_photo_path = $newAvatar;
        $user->save();
        $response = array(
            'msg'    => 'Update successfully',
            'image' => "/".$pathFile . $user->profile_photo_path
        );
        return new JsonResponse($response, 200);
    }
    public function logoutOtherSession(Request $request)
    {
        $user = Auth::user();
        
    }
}
