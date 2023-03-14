<?php
require("../db.php");
session_start(); //start using session

 // get product form url
 if(isset($_GET["id"])){
    $proID= $_GET["id"];
   if(is_numeric($proID)){ // kiem tra id truyen vao co phai so hay khong
//lay san pham voi id truyen vao
   $stmt = $conn ->prepare("SELECT id,description,image,name,cate_id,price FROM product WHERE id=$proID");
   $stmt ->execute();
   $products =$stmt ->fetch();
   if(!$products){ //kiem tra san pham co ton tai hay khong
   }
   $arrayValue=[];
   if(isset($_SESSION["cart"])){  // kiem tra xem session cart co ton tai hay khong

    //kiem tra san pham da ton tai trong session chua
    $arrayValue =$_SESSION["cart"];
    $index= -1;
    for($i=0; $i< count($arrayValue); $i++){ // su dung vong lap de kiem tra product da ton tai chua
        $item= $arrayValue[$i];
        if($item["id"] ==$proID){ //neu ton tai thay doi gia tri cua bien index
            $index=$i;
            break;
        }
    }

    if($index >=0){
        //neu co ton tai can check so luong dang co trong session
        $quantity= $arrayValue [$index] ["quantity"];
        if($quantity >1){
            $arrayValue[$index] ["quantity"] -=1; // neu ton tai tru 1 vao quantity
        }else{
            array_splice($arrayValue,$index,1);
        }
     
   
    }
   }
   $_SESSION["cart"] = $arrayValue;
  
   }

 }
 header('Location:../cart/');