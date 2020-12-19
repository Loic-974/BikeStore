<?php

namespace App\Models\DAO\Vente;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DAO_SaleCustomers extends Model
{
    private $customer_id = 0;
    private $first_name ='';
    private $last_name = '';
    private $phone = 0;
    private $email = '';
    private $street ='';
    private $city ='';
    private $state ='';
    private $zip_code = 0;


    function __construct($customer_Id,$first_name,$last_name,$phone,$email,$street,$city,$state,$zip_code){

        $this->customer_id =$customer_Id;
        $this->first_name = $first_name;
        $this->last_name=$last_name;
        $this->phone=$phone;
        $this->email=$email;
        $this->street=$street;
        $this->city=$city;
        $this->state=$state;
        $this->zip_code=$zip_code;
    
    }

    function toJSONPrivate(){

        return json_encode(
            [
            'customer_id'=> $this->customer_id,
            'FirstName'=>$this->first_name,
            'LastName' =>  $this->last_name,
            'Phone'=> $this->phone,
            'Email'=>$this->email,
            'Street'=>$this->street,
            'City'=>$this->city,
            'State'=> $this->state,
            'ZipCode'=>$this->zip_code
        ]
        );
    }
}
