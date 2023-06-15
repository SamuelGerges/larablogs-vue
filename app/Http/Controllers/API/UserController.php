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
        $data = $request->validated();

        $user = User::create($data);
        $token = $user->createToken('api_token')->plainTextToken;
        $response = [
            'token' => $token,
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
        $response['token'] = $user->createToken('api_token')->plainTextToken;
        $response['user'] = $user;
        return $this->sendResponse($response);
    }

    public function getDetails()
    {
        return response()->json(auth()->user());
    }
}
