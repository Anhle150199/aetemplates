<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function getAllUser()
    {
        $allUser = User::where('user_role', 'admin')->orWhere('user_role', 'superAdmin')->orWhere('user_role', 'deleted')->get();
        return view('users.allUser', ['slidebar' => ['users', 'all-user'],  'allUser' => $allUser]);
    }

    public function deleteUser(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => ['required', 'string', 'email', 'max:255'],
            ]
        );
        if ($validator->fails()) {
            return new JsonResponse(['errors' => $validator->getMessageBag()->toArray()], 406);
        }

        $user = User::where('email', $request->email)->first();
        $user->user_role = 'deleted';
        $user->save();
        $response = array(
            'status' => 'success',
        );
        return new JsonResponse($response, 200);
    }

    public function showUserRequest()
    {
        $userRequest = User::where('user_role', 'requestUser')->get();
        return view('users.request', ['slidebar' => ['users', 'request'], 'userRequest' => $userRequest]);
    }

    public function acceptUserRequest(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => ['required', 'string', 'email', 'max:255'],
                'role' => ['required', 'string']
            ]
        );
        if ($validator->fails()) {
            return new JsonResponse(['errors' => $validator->getMessageBag()->toArray()], 406);
        }
        if (!in_array($request->role, ['superAdmin', 'admin'])) {
            return new JsonResponse(['errors' => ['role' => 'Role is valid']], 406);
        }

        $user = User::where('email', $request->email)->first();
        $user->user_role = $request->role;
        $user->save();
        $response = array(
            'status' => 'success',
        );
        return new JsonResponse($response, 200);
    }

    public function deleteUserRequest(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => ['required', 'string', 'email', 'max:255'],
            ]
        );
        if ($validator->fails()) {
            return new JsonResponse(['errors' => $validator->getMessageBag()->toArray()], 406);
        }

        $user = User::where('email', $request->email)->first();
        $user->delete();
        $response = array(
            'status' => 'success',
        );
        return new JsonResponse($response, 200);
    }

    public function addNewUser(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'role' => ['required', 'string', function ($attribute, $value, $fail) {
                    if (!in_array($value, ['superAdmin', 'admin'])) {
                        return $fail(__('Set role for user fail.'));
                    }
                }],
                'password' => ['required', 'confirmed', 'min:8'],
            ]
        );
        if ($validator->fails()) {
            return new JsonResponse(['errors' => $validator->getMessageBag()->toArray()], 406);
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_role' => $request->role,
        ]);
        $response = array(
            'status' => 'success',
        );
        return new JsonResponse($response, 200);
    }
}
