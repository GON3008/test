<?php
if ($_SERVER['REQUEST_METHOD'] == "GET"){
     // neu request dang get hien thi form dang
    ?>
   
    
    <form action method="post" enctype="multipart/form-data">
        <h3>Create new category</h3>
        <table>
            <tr>
                <td><label for="cate_name">category name</label></td>
                <td>
                    <input type="text" id="cate_name" name="cate_name"/>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="cate_img">category image</label>
                </td>
                <td>
                    <input type="file" id="cate_img" name="cate_img"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="cate_desc">Description</label>
                </td>
                <td>
                   <textarea name="cate_desc" id="cate_desc" cols="100" rows="10"></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <button type="submit">Create category</button>
                </td>
                <td>
                    <button type="reset">Clear</button>
                </td>
            </tr>
        </table>
    </form>
    <?php

}else{
    require("../db.php");
    //thuc hien lay du lieu va save xuong database
    //lay du lieu name va description
    $name= $_POST["cate_name"];
    $desc= $_POST["cate_desc"];
  //bat dau xu ly anh
  //lay ra cai ten duy nhat tu thoi gian
    $micro_time= microtime();
    $micro_time= str_replace(" ","_",$micro_time);
    $micro_time= str_replace(".","_",$micro_time);
  
    $target_dir="../upload/categoryIMG/";   //thu muc chua anh tren sever
    $extension= pathinfo($_FILES["cate_img"] ["name"] , PATHINFO_EXTENSION);  //lay ra duoi cua anh
  
    $file_name= $target_dir .$micro_time.".".$extension;   //lay ra ten anh anh dua tren thu muc + thoi gian + duoi anh
  
   
    $upload= move_uploaded_file($_FILES ["cate_img"] ["tmp_name"], $file_name);  //chuyen anh tu thu muc tmp cua sever sang thu muc gan den (upload/categoryIMG)

    $file_name= str_replace("../","",$file_name); //xoa ../ khi save anh xuong database
 
 
    
   
    if($upload){  //neu upload thanh  cong thi se save anh xuong database
        $stmt= $conn -> prepare("INSERT INTO category (name,description,image) VALUE (:name, :description,:image)");
        $stmt ->bindParam(':image', $file_name);
       
    }else{  //neu upload khong thanh cong thi se bo qua thong tin cua anh
        $stmt= $conn -> prepare("INSERT INTO category (name,description) VALUE (:name, :description)");
    }
 
   
    $stmt ->bindParam(':name', $name);
    $stmt ->bindParam(':description', $desc);

    $stmt ->execute();

    header('Location: ../index.php');
}

