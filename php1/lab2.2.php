<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="POST" style="text-align:center; border:1px solid red;width: 30%; margin:auto;" >
        <h1>Tính thuế thu nhập</h1>
        <table style="margin:auto;">
            <tr>
                <td><label for="">Lương</label></td>
                <td><input type="text" name="luong"></td>
            </tr>
            <tr>
                <td><label for="">Thưởng</label></td>
                <td><input type="text" name="thuong"></td>
            </tr>
        </table>
        <input type="submit" name="tinh" value="Tính thuế TN">
    </form>
    <center>
    <?php 
     if (isset($_POST['tinh'])) {
        $luong = $_POST['luong'];
        $thuong = $_POST['thuong'];
        $tong = $luong+$thuong;
        $x1 = $tong-9000;
        $x2 = $tong-15000;
        $x3 = $tong-30000;
        if($tong <= 9000){
            echo "bạn ko cần đóng thuế. Lương của bạn là: $tong";
        }else if($tong <= 15000){
            $thue = 0+ $x1*0.1;
            echo "thuế thu nhập của bạn là: $thue";
        }
        else if($tong <= 30000){
            $thue = 0+  6000*0.1 + $x2*0.15 ;
            echo "thuế thu nhập của bạn là: $thue";
        }
        else{
            $thue = 0+ 6000*0.1 + 15000*0.15 + $x3*0.2 ;
            echo "thuế thu nhập của bạn là: $thue";
        }
     }
    ?>
     </center>
</body>
</html>