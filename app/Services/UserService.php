<?php
namespace App\Services;
use App\Models\user;
use Illuminate\Support\Facades\Auth;

class UserService{

    public function createUser(array $data){
        $user=User::make($data);
        $user->save();
        return $user;

    }

    public function selectUser(){

    }

    public function updateUser(User $user, array $data){

        // Define the fields you want to allow for modification
        $allowedFields = ['name','status','role','email','password'];

        // Filter the incoming array to only include allowed keys, then update & save
        $user->update(array_intersect_key($data, array_flip($allowedFields)));

        return $user;
    }

    public function deleteUser(User $user){
        $user->delete();
    }


}