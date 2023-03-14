<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form  action="" method="POST">
        <h1>THONG TIN</h1>
        <p>ho ten</p> <input type="text" name="name">
        <p>tuoi</p> <input type="text" name="age">
        <br>
        <input type="submit" value="gui len sever" name="btn-send">
    </form>
    
    <?php
    if (isset($_POST['btn-send'])){
        $ten=$_POST['name'];
        $tuoi=$_POST['age'];
        echo "chao ban $ten hien nay ban $tuoi";
    }
    ?>
</body> 
</html>