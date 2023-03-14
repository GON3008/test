<?php 
 require("../db.php");


 $stmt = $conn -> prepare("SELECT id, name FROM category ");


 $stmt -> execute();
 $categorys= $stmt -> fetchAll();

if ($_SERVER ['REQUEST_METHOD'] == 'GET'){
    ?>
<form action method="post" enctype="multipart/form-data">
    <h3>Create new product</h3>
    <table>
        <tr>
            <td><label for="pro_name">product name</label>
        </td>
            <td>
                <input type="text" id="pro_name" name="pro_name"/>
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
                <input type="number" step="0.01" id="pro_price" name="pro_price"/>
            </td>
        </tr>

        <tr>
            <td><label for="pro_img">product image</label>
        </td>
            <td>
                <input type="file" id="pro_img" name="pro_img"/>
            </td>
        </tr>

        <tr>
            <td><label for="pro_desc">product description</label>
        </td>
        <td>
            <textarea name="pro_desc" id="pro_desc" cols="100" rows="10"></textarea>
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
   
    //thuc hien lay du lieu va save xuong database
    //lay du lieu name va description
    $name= $_POST["pro_name"];
    $desc= $_POST["pro_desc"];
    $cate_id = $_POST["cate_id"];
    $price= $_POST["pro_price"];
  
  //bat dau xu ly anh
  //lay ra cai ten duy nhat tu thoi gian
    $micro_time= microtime();
    $micro_time= str_replace(" ","_",$micro_time);
    $micro_time= str_replace(".","_",$micro_time);
  
    $target_dir="../upload/productIMG/";   //thu muc chua anh tren sever
    $extension= pathinfo($_FILES["pro_img"] ["name"] , PATHINFO_EXTENSION);  //lay ra duoi cua anh
  
    $file_name= $target_dir .$micro_time.".".$extension;   //lay ra ten anh anh dua tren thu muc + thoi gian + duoi anh
  
   
    $upload= move_uploaded_file($_FILES ["pro_img"] ["tmp_name"], $file_name);  //chuyen anh tu thu muc tmp cua sever sang thu muc gan den (upload/categoryIMG)

    $file_name= str_replace("../","",$file_name); //xoa ../ khi save anh xuong database
 
 
    
   
    if($upload){  //neu upload thanh  cong thi se save anh xuong database
        $stmt= $conn -> prepare("INSERT INTO product (name,description,image,cate_id,price) VALUE (:name, :description,:image,:cate_id,:price)");
        $stmt ->bindParam(':image', $file_name);
       
    }else{  //neu upload khong thanh cong thi se bo qua thong tin cua anh
        $stmt= $conn -> prepare("INSERT INTO product(name,description,cate_id,price) VALUE (:name, :description,:cate_id,:price)");
    }
 
   
    $stmt ->bindParam(':name', $name);
    $stmt ->bindParam(':description', $desc);
    $stmt ->bindParam(':cate_id', $cate_id);
    $stmt ->bindParam(':price', $price);

    $stmt ->execute();

    header('Location: ../product/index.php');
}