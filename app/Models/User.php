<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    const FIELDS_RULES = [
        'name' => 'required | max:150',
        'age' => 'required | integer | max:3',
        'email' => 'required | email | unique:users | max:150 | min:5',
        'job' => 'required | max:150'
    ];

    protected $table = 'users';

    protected $fillable = [
        'name', 'age', 'email', 'job'
    ];
}
