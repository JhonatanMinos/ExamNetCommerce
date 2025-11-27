<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index()
    {
        return response()->json([User::all(), Response::HTTP_OK]);
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $user = User::create([
            'name'        => $data['name'],
            'email'       => $data['email'],
            'password'    => bcrypt($data['password'])
        ]);
        return response()->json([$user, Response::HTTP_CREATED]);
    }
}
