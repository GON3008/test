<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>hien thi danh muc</h1>
    <table border="1">
        <tr>
            <td>ma danh muc</td>
            <td>ten danh muc</td>
        </tr>
   
    <?php
    include_once 'db.php';
    $sql="select* from product";
    
    ?>
     </table>
</body>
</html>