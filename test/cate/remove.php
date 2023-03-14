<?php
require("../db.php");
    $cateID=$_GET["id"];
    if(intval($cateID) <=0){
        echo"Invalid category id"; die;
    }
    $stmt=$conn ->prepare("SELECT id, name, description, image FROM category WHERE id=$cateID");
    $stmt -> execute();
    $category =$stmt -> fetch();
    if(!$category){
        echo"category not existed"; die;
    }
$stmt=$conn ->prepare("DELETE  FROM category WHERE id=$cateID");
$stmt -> execute();
header('Location: ../index.php');