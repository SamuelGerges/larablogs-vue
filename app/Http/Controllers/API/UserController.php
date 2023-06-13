<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\UserRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\Response;
use App\Models\User;

class UserController extends Controller
{
    use ResponseTrait;

    public function register(UserRequest $request)
    {
        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        $user = User::create($data);
        $response = [
            'user' => $user
        ];
        return $this->sendResponse($response);

    }

    public function login(LoginRequest $request)
    {
        $dataValidated = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];

        $auth = auth()->attempt($dataValidated);
        if (!$auth) {
            return response()->json([
                'code' => Response::HTTP_NOT_ACCEPTABLE,
                'msg' => 'Auth Failed',
            ]);
        }
        $user = auth()->user();
        $data['token'] = $user->createToken('api_token')->plainTextToken;
        $data['user'] = $user;
        return $this->sendResponse($data);
    }
}
