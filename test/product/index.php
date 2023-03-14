<?php
require("../db.php");
if (isset($_GET["cate_id"])) {
    $cate_id = $_GET["cate_id"];
    $stmt = $conn->prepare("SELECT p.id as product_id ,p.name as product_name,p.description as product_description,p.image as product_image ,p.price as product_price, c.name as cate_name
    FROM product p
    LEFT JOIN category c
    ON p.cate_id = c.id
     WHERE p.cate_id =:cate_id");
    $stmt->bindParam(':cate_id', $cate_id);
} else {
    $stmt = $conn->prepare("SELECT p.id as product_id, p.name as product_name , p.description as product_description , p.image as product_image, p.price as product_price , c.name as cate_name
    FROM product p
    LEFT JOIN category c
    ON p.cate_id = c.id");

}
$stmt->execute();
$products = $stmt->fetchAll();
?>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>IMAGE</th>
            <th>CATEGORY NAME</th>
            <th>DESCRIPTION</th>
            <th>PRICE</th>
            <th>SETTING</th>
            <th>ADD TO CART</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (count($products) > 0) {
            foreach ($products as $value) {
                ?>
                <tr>
                    <td>
                        <?php echo $value["product_id"]; ?>
                    </td>
                    <td>
                       <?php echo $value["product_name"];?> 
                    </td>
                    <td>
                        <img style="width: 120px; height: 120px;" src="<?php echo "../". $value["product_image"];  ?>" alt="">
                    </td>
                    <td>
                    <?php echo $value["cate_name"]; ?>
                </td>
                    <td>
                        <?php echo $value["product_description"]; ?>
                    </td>
                    <td>
                    <?php echo $value["product_price"]; ?>
                </td>
                 
                    <td>
                        <a href="../product/update.php?id=<?php echo $value["product_id"]; ?>">Update</a>
                        <a href="../product/remove.php?id=<?php echo $value["product_id"]; ?>">Remove</a>
                    </td>

                    <td>
                        <a href="../cart/add.php?id=<?php echo $value["product_id"]; ?>">Buy now</a>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
        <td colspan="5">
            <a href="create.php">Create new</a>
        </td>
    </tbody>
</table>
