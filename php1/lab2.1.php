<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="GET">
    <h1>In bảng cửu chương</h1>
    <label>N=</label><input type="text" name="number"> <br>    
    <input type="submit" value="In" name="output">
    </form>
    <?php
      
         if(isset($_GET['output'])){
            $number =$_GET['number'];
            for($i=2;$i<= $number;$i++){
                for($j=1;$j<= 10;$j++){
                    $so=$i*$j;
                    echo "$i *";
                    echo "$j=";
                    echo "$so<br>";
             }

            }
            
        }
        // echo "bảng cửu chương $so"

    ?>
</body>
</html>