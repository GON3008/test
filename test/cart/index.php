<?php
session_start();
$sessionValue= isset($_SESSION["cart"]) ==true ? $_SESSION["cart"] :[];
?>

<table>
    <thead>
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Image</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total Unit Price</th>
        <th>Edit</th>
        <th><a href="../index.php">HOME</a></th>
        </tr>
    </thead>
    <tbody>
        <?php
          $totalCartPrice=0;
        if(count($sessionValue) >0){
              //tinh tong so tien phai tra
            foreach($sessionValue as $value){
                $totalCartPrice += ($value ["quantity"] * $value["price"]);
              }
            foreach($sessionValue as $value){
                ?>
                <tr>
                    <td>
                        <?php echo $value["id"]; ?>
                    </td>
                    <td>
                       <?php echo $value["name"];?> 
                    </td>
                    <td>
                        <img style="width: 120px; height: 120px;" src="<?php echo "../". $value["image"];  ?>" alt="">
                    </td>
                 

                    <td>
                    <?php echo $value["price"]; ?>
                </td>
                 
                    <td>
                    <?php echo $value["quantity"]; ?>
                    </td>

                    <td>
                    <?php echo ($value["price"] * $value["quantity"]); ?>
                    </td>

                    <td>
                        <a href="add.php?id=<?php echo $value["id"]; ?>">+1</a>
                        <a href="minus.php?id=<?php echo $value["id"]; ?>">-1</a>
                    </td>

                </tr>
                <?php
            }
        }
        ?>

        <tr>
            <td colspan="5">Total cart price</td>
            <td colspan="2"><?php echo $totalCartPrice ;?></td>
        </tr>
    </tbody>
</table>