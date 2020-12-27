<?php

namespace App\Models\Vente;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\DAO\Vente\DAO_SaleOrders;

class Model_SaleOrder extends Model
{
  
    function getSaleOrder($idStaff){

        $listOrder = DB::select('SELECT * from sales.orders where store_id = (SELECT store_id from sales.staffs where staff_id = ? )',[$idStaff]);
        $list = array();
    
    
        foreach($listOrder as $value){
            $nameClient = DB::select('SELECT last_name, first_name from sales.customers where customer_id= ?',[$value->customer_id]);
            foreach($nameClient as $info){
                $lastName=$info->last_name;
                $firstName=$info->first_name;
            }
            $temp = new DAO_SaleOrders($value->order_id,$value->customer_id,$lastName,$firstName,$value->order_status,$value->order_date,$value->required_date,$value->shipped_date,$value->store_id,$value->staff_id);
            array_push($list, $temp);
        }
      
        return $list;
    }

    function newTransaction($firstName,$lastName,$phone,$email,$street,$city,$state,$zipCode,$idStaff,$itemList){

        try{
            // $transac = DB::connection()->getPdo();
            // $transac->beginTransaction();

           DB::beginTransaction();

            if(empty(DB::select('SELECT * FROM sales.customers where last_name=? AND first_name=? AND email=? ',[$lastName,$firstName,$email]))){
               DB::insert('INSERT INTO sales.customers (first_name,last_name,phone,email,street,city,"state",zip_code) Values (?,?,?,?,?,?,?,?)',[$firstName,$lastName,$phone,$email,$street,$city,$state,$zipCode]);
                
               DB::insert('INSERT INTO sales.orders (customer_id,order_status,order_date,required_date,shipped_date,store_id,staff_id) VALUES ((SELECT IDENT_CURRENT(\'sales.customers\')),3,?,?,?,(SELECT store_id from sales.staffs where staff_id = ?),?)',[date("d-m-Y"),date("d-m-Y",strtotime('+3 days')),date("d-m-Y",strtotime('+3 days')),$idStaff,$idStaff]);
               $i=1; 
               foreach($itemList as $item){  
                     
                DB::insert('INSERT INTO sales.order_items (order_id,item_id,product_id,quantity,list_price,discount) Values ((SELECT IDENT_CURRENT(\'sales.orders\')),?,?,?,?,?)',[$i,$item->product_id,$item->orderQuantity,$item->price_id,$item->discount]);
                $i++;
            }
               
               DB::commit();
               return $this->getSaleOrder($idStaff);
                
            }else{
                DB::insert('INSERT INTO sales.orders (customer_id,order_status,order_date,required_date,shipped_date,store_id,staff_id) VALUES ((SELECT customer_id From sales.customers  where last_name=? AND first_name=? AND email=?),3,?,?,?,(SELECT store_id from sales.staffs where staff_id = ?),?)',[$lastName,$firstName,$email,date("d-m-Y"),date("d-m-Y",strtotime('+3 days')),date("d-m-Y",strtotime('+3 days')),$idStaff,$idStaff]);
                $i=1; 
                foreach($itemList as $item){  
                      
                 DB::insert('INSERT INTO sales.order_items (order_id,item_id,product_id,quantity,list_price,discount) Values ((SELECT IDENT_CURRENT(\'sales.orders\')),?,?,?,?,?)',[$i,$item->product_id,$item->orderQuantity,$item->price_id,$item->discount]);
                 $i++;
             }
                DB::commit();
                return $this->getSaleOrder($idStaff);
            }
         
        
           
        }catch(Exception $e){
            DB::rollback();
            // $transac->rollBack();
            echo "Failed".$e->getMessage();
        }

     

    }

} 
