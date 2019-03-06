<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User as UserModel;

class UserController extends Controller
{
    /**
     *  @var UserModel $userModel
     */
    private $userModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserModel $userModel
    )
    {
        $this->userModel = $userModel;
    }

    /**
     * 
     */
    public function getAll()
    {
        $users = $this->userModel->all();
        return response()->json(['response' => $users], Response::HTTP_OK);
    }

    /**
     * 
     */
    public function getOne($id)
    {
        $user = $this->userModel->find($id);
        if(!$user)
            return response()->json(['response' => null], Response::HTTP_OK);
        return response()->json(['response' => $user], Response::HTTP_OK);
    }

    /**
     * 
     */
    public function new(Request $request)
    {
        $user = $this->userModel->create($request->all());
        return response()->json(['response' => $user], Response::HTTP_CREATED);
    }

    /**
     * 
     */
    public function update(Request $request, $id)
    {
        $user = $this->userModel->find($id);
        if(!$user)
            return response()->json(['response' => null], Response::HTTP_OK); 
        $user->update($request->all());
        return response()->json(['response' => $user], Response::HTTP_OK);
    }

    /**
     * 
     */
    public function delete($id)
    {
        $user = $this->userModel->find($id);
        if(!$user)
            return response()->json(['response' => null], Response::HTTP_OK);
        $user->delete();
        return response()->json(['response' => true], Response::HTTP_OK);

    }
}
