<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    /**
     *  @var UserService $userService
     */
    private $userService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserService $userService
    )
    {
        $this->userService = $userService;
    }

    /**
     * 
     */
    public function getAll()
    {
       return $this->userService->getAll();
    }

    /**
     * 
     */
    public function getOne($id)
    {
        return $this->userService->getOne($id);
    }

    /**
     * 
     */
    public function new(Request $request)
    {
        return $this->userService->new($request);
    }

    /**
     * 
     */
    public function update(Request $request, $id)
    {
        return $this->userService->update($request, $id);
    }

    /**
     * 
     */
    public function delete($id)
    {
        return $this->userService->delete($id);
    }
}
