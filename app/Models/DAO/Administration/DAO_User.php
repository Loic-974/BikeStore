<?php

namespace App\Models\DAO\Administration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DAO_User extends Model
{
    private $user_id;
    private $firstName;
    private $lastName;
    private $email;
    private $phone;
    private $active;
    private $store_id;
    private $manager_id;
    private $manager_firstName;
    private $manager_lastName;
    private $password;
    private $firstConnect;
    private $roleUser;


    private function __construct($user_id,$firstName,$lastName,$email,$phone,$active,$store_id,$manager_id,$manager_firstName,$manager_lastName,$password,$firstConnect,$roleUser){
       $this->user_id = $user_id;
       $this->firstName = $firstName;
        $this ->lastName = $lastName;
        $this-> email= $email;
        $this->phone = $phone;
        $this->active = $active;
        $this->store_id =$store_id;
        $this->manager_id = $manager_id;
        $this->managerFirstName =$manager_firstName;
        $this->managerLastName= $manager_lastName;
        $this-> password = $password;
        $this-> firstConnect =$firstConnect;
        $this -> roleUser =$roleUser;
    }



    public function toJSONPrivate(){
        return json_encode([
            "user_id"=>$this->user_id,
            "firstName"=>$this->firstName,
            "lastName"=>$this->lastName,
            "email"=>$this->email,
            "phone"=>$this->phone,
            "active"=>$this->active,
            "store_id"=>$this->store_id,
            "manager_id"=>$this->manager_id,
            "managerFirstName"=>$this->managerFirstName,
            "managerLastName"=>$this->managerLastName,
            "password"=>$this->password,
            "firstConnect"=>$this->firstConnect,
            "role"=>$this->roleUser
        ]);
    }
  
}
