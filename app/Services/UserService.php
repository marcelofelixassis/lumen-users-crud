<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class UserService
{
    const USER_FIELDS_RULES = [
        'name' => 'required|max:150|min:3',
        'age' => 'required|integer|max:110',
        'email' => 'required|email|unique:users|max:150|min:5',
        'job' => 'required|max:150'
    ];

    /**
     *  @var UserRepository $userRepo
     */
    private $userRepo;

    public function __construct(
        UserRepository $userRepo
    )
    {
        $this->userRepo = $userRepo;
    }

    /**
     * 
     */
    public function getAll()
    {
        try {
            $users = $this->userRepo->getAll();
            return response()->json(['response' => $users], Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json(['response' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * 
     */
    public function getOne($id)
    {
        try {
            $user = $this->userRepo->find($id);
            if(!$user)
                return response()->json(['response' => null], Response::HTTP_OK);
            return response()->json(['response' => $user], Response::HTTP_OK);
        } catch(QueryException $e) {
            return response()->json(['response' => false], Response::HTTP_INTERNAL_SERVER_ERROR); 
        }
    }

    /**
     * 
     */
    public function new(Request $request)
    {
        $validator = Validator::make($request->all(), self::USER_FIELDS_RULES);
        if($validator->fails())
        {
            return response()->json(['response' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        try {
            $user = $this->userRepo->new($request);
            return response()->json(['response' => $user], Response::HTTP_CREATED);
        } catch(QueryException $e) {
            return response()->json(['response' => false], Response::HTTP_INTERNAL_SERVER_ERROR); 
        }
    }

    /**
     * 
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), self::USER_FIELDS_RULES);
        if($validator->fails())
        {
            return response()->json(['response' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        try {
            $user = $this->userRepo->find($id);
            if(!$user)
                return response()->json(['response' => null], Response::HTTP_OK); 
            $this->userRepo->update($request, $id);
            return response()->json(['response' => $user], Response::HTTP_OK);
        } catch(QueryException $e) {
            return response()->json(['response' => false], Response::HTTP_INTERNAL_SERVER_ERROR); 
        }
    }

    /**
     * 
     */
    public function delete($id)
    {
        try {
            $user = $this->userRepo->find($id);
            if(!$user)
                return response()->json(['response' => null], Response::HTTP_OK);
            $this->userRepo->delete($id);
            return response()->json(['response' => true], Response::HTTP_OK);
        } catch(QueryException $e) {
            return response()->json(['response' => false], Response::HTTP_INTERNAL_SERVER_ERROR); 
        }
    }
}