<?php
require("db.php");
$stmt = $conn->prepare("SELECT id, name, description,image FROM category");
$stmt->execute();

$catergorys = $stmt->fetchAll();
?>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>DESCRIPTION</th>
            <th>IMAGE</th>
            <th>SETTING</th>
    
        </tr>
    </thead>
    <tbody>
        <?php
        if (count($catergorys) > 0) {
            foreach ($catergorys as $value) {
                ?>
                <tr>
                    <td>
                        <?php echo $value["id"]; ?>
                    </td>
                    <td>
                       <a href="product/index.php? cate_id=<?php echo $value["id"];?>"> <?php echo $value["name"];?> </a>
                    </td>
                    <td>
                        <?php echo $value["description"]; ?>
                    </td>
                    <td>
                        <img style="width: 120px; height: 120px;" src="<?php echo $value["image"];  ?>" alt="">
                    </td>
                    <td>
                        <a href="cate/update.php?id=<?php echo $value["id"]; ?>">Update</a>
                        <a href="cate/remove.php?id=<?php echo $value["id"]; ?>">Remove</a>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
        <td colspan="5">
            <a href="cate/create.php">Create new</a>
        </td>
    </tbody>
</table>
