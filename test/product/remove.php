<?php
require("../db.php");
$proID= $_GET["id"];
if(intval($proID)<=0){
    echo"";
}
$stmt= $conn -> prepare("SELECT id,name,description,image,cate_id,price FROM product WHERE id=$proID");
$stmt -> execute();
$products =$stmt -> fetch();
if(!$products){
    echo"";
}
$stmt=$conn ->prepare("DELETE id,name,description,image,cate_id,price FROM product WHERE id=$proID");
$stmt ->execute();
header('Location: ../product/index.php');