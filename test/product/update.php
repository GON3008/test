<?php
require("../db.php");

$stmt=$conn ->prepare("SELECT id,name FROM category");
$stmt ->execute();
$categorys = $stmt ->fetchAll();


if($_SERVER['REQUEST_METHOD'] =="GET"){
    $proID= $_GET["id"];
    if(intval($proID) <=0){
        echo"";
    }
    $stmt = $conn ->prepare("SELECT id, name, description, image, cate_id, price FROM product where id=$proID");
    $stmt ->execute();
    $products = $stmt ->fetch();
    if(!$products){
        echo"";
    }
    ?>
     <form action method="post" enctype="multipart/form-data">
        <h3>Update category <?php echo $products["name"]?></h3>
        <input type="hidden" id="pro_id" name="pro_id" value="<?php echo $products["id"];?>"/>
        <table>
            <tr>
                <td><label for="pro_name">category name</label></td>
                <td>
                    <input type="text" id="pro_name" name="pro_name" value="<?php echo $products["name"];?>"/>
                </td>
            </tr>

            <tr>
            <td><label for="cate_id">category:</label>
        </td>
        <td>
           <select name="cate_id" id="cate_id">
            <?php
            if(count($categorys) >0){
                foreach ($categorys as $value){
                    ?>
                    <option value="<?php echo $value ["id"]; ?>"> <?php echo $value ["name"]; ?></option>
                    <?php
                }
            }
            ?>
           </select>
           </td>
        </tr>

            <tr>
            <td><label for="pro_price">product price</label>
        </td>
            <td>
                <input type="number" step="0.01" id="pro_price" name="pro_price" value="<?php echo $products["price"];?>"/>
            </td>
        </tr>

            <tr>
                <td>
                    <label for="pro_img">category image</label>
                </td>
                <td>
                    <input type="file" id="pro_img" name="pro_img" value="<?php echo $products["image"];?>"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="pro_desc">Description</label>
                </td>
                <td>
                   <textarea name="pro_desc" id="pro_desc" cols="100" rows="10" <?php echo $products["description"];?>></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <button type="submit">Create product</button>
                </td>
                <td>
                    <button type="reset">Clear</button>
                </td>
            </tr>
        </table>
    </form>
    <?php
}else{
$name= $_POST["pro_name"];
$desc= $_POST["pro_desc"];
$id= $_POST["pro_id"];
$price= $_POST["pro_price"];
$cate_id= $_POST["cate_id"];


$micro_time= microtime();
$micro_time= str_replace("","_",$micro_time);
$micro_time= str_replace(".","_",$micro_time);


$target_dir="../upload/productIMG";
$extension= pathinfo($_FILES["pro_img"] ["name"], PATHINFO_EXTENSION);


$file_name= $target_dir.$micro_time.".".$extension;

$upload= move_uploaded_file($_FILES ["pro_img"] ["tmp_name"], $file_name);

$file_name= str_replace("../","",$file_name);


if($upload){
    $stmt= $conn ->prepare("UPDATE product SET name=:name, description=:description, image=:image,price=:price,cate_id=:cate_id WHERE id=:id");
    // $stmt= $conn ->prepare("INSERT INTO product(cate_id) VALUE (:cate_id)");
    $stmt ->bindParam(':image',$file_name);
}else{
    $stmt= $conn ->prepare("UPDATE product SET name=:name, description=:description,price=:price,cate_id=:cate_id WHERE id=:id ");
    // $stmt= $conn ->prepare("INSERT INTO product(cate_id) VALUE (:cate_id)");
}

$stmt ->  bindParam(':name', $name);
$stmt -> bindParam(':description',$desc);
$stmt -> bindParam(':price', $price);
$stmt -> bindParam(':id',$id);
$stmt -> bindParam(':cate_id',$cate_id);
$stmt ->execute();
header('Location:../product/index.php');
}