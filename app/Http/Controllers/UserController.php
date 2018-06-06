<?php

namespace App\Http\Controllers;

use App\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;


class UserController extends Controller
{
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return parent::_index($request);
    }

    public function store(UserRequest $request)
    {
        return parent::_store($request);
    }

    public function show(Request $request, User $user)
    {
        return parent::_show($request, $user);
    }

    public function update(UserRequest $request, User $user)
    {
        return parent::_update($request, $user);
    }

    public function destroy(User $user)
    {
        return parent::_destroy($user);
    }
}
