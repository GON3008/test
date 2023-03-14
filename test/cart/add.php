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
   if(!isset($_SESSION["cart"])){  // kiem tra xem session cart co ton tai hay khong
    //nei khonh ton tai
    $products ["quantity"] =1;
    array_push($arrayValue,$products); //them san pham co quantity =1 vao session
   }else{ 
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
        $arrayValue[$index] ["quantity"] +=1; // neu ton tai them 1 vao quantity
    }else{
        $products ["quantity"] =1;  
    array_push($arrayValue,$products);  // neu chua thi quantity =1 va them vao session
    }
   }
   $_SESSION["cart"] = $arrayValue;
  
   }

 }
 header('Location:../cart/');