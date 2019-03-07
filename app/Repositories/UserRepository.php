<?php

namespace App\Repositories;

use App\Models\User as UserModel;
use Illuminate\Http\Request;

class UserRepository
{
    /**
     *  @var UserModel $userModel
     */
    private $userModel;

    /**
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
    public function find($param)
    {
        return $this->userModel->find($param);
    }

    /**
     * 
     */
    public function getAll()
    {
       return $this->userModel->all();
    }

    /**
     * 
     */
    public function new(Request $request)
    {
        return $this->userModel->create($request->all());
    }

    /**
     * 
     */
    public function update(Request $request, $id)
    {
        return $this->userModel->find($id)->update($request->all());
    }

    /**
     * 
     */
    public function delete($id)
    {
        return $this->userModel->find($id)->delete();
    }

}