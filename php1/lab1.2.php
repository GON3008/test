<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, init-ial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
   <center>
    <form class="border border-dark container mx-auto" style="width: 480px;" action="" method="POST">
        <h1>THONG TIN DAT HANG</h1>
        <table>
            <tr>
                <td>
                    <label>Ho ten:</label>
                    </td>
                    <td>
                        <input type="text" name="name">
                    </td>
            </tr>
            <tr>
                <td>
                    <label>So dien thoai:</label>
                    </td>
                    <td>
                        <input type="text" name="phone">
                    </td>
            </tr>
            <tr>
                <td>
                    <label>San pham:</label>
                </td>
                <td>
                   <select name="product" id="">
                    <option value="0">Vui long chon san pham</option>
                    <option value="cam" price="40000">cam</option>
                    <option value="dua" price="50000">dua</option>
                    <option value="xoai" price="60000">xoai</option>
                   </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Gia:</label>
                </td>
                <td>
                    <input type="text" name="price" readonly>
                </td>
            </tr>
            <tr>
                <td>
                    <label>So luong:</label>
                </td>
                <td>
                    <input type="number" name="quantity" value="0" min="0">
                </td>
            </tr>
        </table>
        <button type="submit" name="tt" class="">Thanh toan</button>
    </form>
    <?php

    if (isset($_POST['tt'])) {
        $ten = $_POST['name'];
        $sdt = $_POST['phone'];
        $sp = $_POST['product'];
        $gia = $_POST['price'];
        $sl = $_POST['quantity'];

        echo "Thong tin don hang <br>";
        echo "Ho ten: $ten <br>";
        echo "So dien thoai: $sdt <br>";
        echo "San pham: $sp <br>";
        echo "Gia: $gia <br>";
        echo "So luong: $sl <br>";
    }
    if(isset($_POST['product'])){
        $sp=$_POST['product'];
        switch ($sp){
            case '1':
              echo'cam';
              if(1==$gia){
                echo"$gia";
              }
              break;

              case '2':
                echo'dua';
                break;
        }
    }
    if (empty($ten) || empty($sdt) || empty($sp) || empty($gia) || empty($sl)) {
        echo "nhap thieu du lieu";
        exit();
    }
    if (!is_numeric($sdt) || !is_numeric($gia)) {
        echo "ki tu khong phai la so<br>";
        exit();
    }
    if ($sl >= 200) {
        echo "giam gia 20% <br>";
        $p = 0.2;
        $deal1 = ($gia * $sl);
        echo "Tong tien:$deal1 <br>";
    } else if ($sl >= 100) {
        echo "giam gia 10% <br>";
        $s = "10%";
        $deal2 = ($gia * $sl) - floatval($s);
    } else {
        echo "khong duoc giam gia <br>";
        $total = ($gia * $sl);
        echo "Tong tien:$total <br>";
    }
    ?>
    </center>
</body>

</html>