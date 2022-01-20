<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $response = array(
            'status' => 'success',
            'msg'    => 'Update successfully',
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
}
