<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
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
}
