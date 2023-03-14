<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <td>canh1</td><input type="text" name="canh1">
        <br>
        <td>canh1</td><input type="text" name="canh2">
        <br>
        <td>canh3</td><input type="text" name="canh3">
        <br>
        <button type="submit">tinh</button>
    </form>
    <?php
        if(isset($_POST['send'])){
            $canh1=$_POST['canh1'];
            $canh2=$_POST['canh2'];
            $canh3=$_POST['canh3'];
        }
        if(empty($canh1) || empty($canh2) || empty($canh3) ){
            echo"nhap thieu du lieu";
            exit();
        }
        if(!is_numeric($canh1) || !is_numeric($canh2) || !is_numeric($canh3)){
            echo"ki tu khong phai la so ";
            exit();
        }
       if(($canh1 + $canh2)>$canh3 && ($canh2 + $canh3)>$canh1 && ($canh1 + $canh3) >$canh2){
        echo "la mot tam giac";
        $p=($canh1+$canh2+$canh3)/2;
        $s=sqrt($p*($p-$canh1)*($p-$canh2)*($p-$canh3));
        
       }else{
        echo"khong tao thanh tam giac";
       }
       echo"$s la:";
    ?>
</body>
</html>