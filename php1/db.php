<?php
try{
    $com=new PDO("mySQL:host=localhost;dbname=demo;charset=utf8","root","");
}catch(\Throwable $th){
    echo"ket noi";
}
?>