<?php
require("../db.php");
if($_SERVER['REQUEST_METHOD'] =="GET"){
    //1 lay du lieu tu db voi id cua request
    //2 hien thi form voi du lieu da lAY duoc

    $cateID= $_GET["id"];
    // var_dump($cateID);die;
    if(intval($cateID) <=0){
        echo"Invalid category id";die;
    }
    $stmt=$conn->prepare("SELECT id, name, description,image FROM category where id=$cateID");
    $stmt ->execute();
    $category= $stmt -> fetch();
    if(!$category){
        echo"category not existed";die;
    }
    // var_dump($category); die;
    ?>
    <form action method="post" enctype="multipart/form-data">
        <h3>Update category <?php echo $category["name"]?></h3>
        <input type="hidden" id="cate_id" name="cate_id" value="<?php echo $category["id"];?>"/>
        <table>
            <tr>
                <td><label for="cate_name">category name</label></td>
                <td>
                    <input type="text" id="cate_name" name="cate_name" value="<?php echo $category["name"];?>"/>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="cate_img">category image</label>
                </td>
                <td>
                    <input type="file" id="cate_img" name="cate_img" value="<?php echo $category["image"];?>"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="cate_desc">Description</label>
                </td>
                <td>
                   <textarea name="cate_desc" id="cate_desc" cols="100" rows="10" <?php echo $category["description"];?>></textarea>
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
    $name= $_POST["cate_name"];
    $desc= $_POST["cate_desc"];
    $id= $_POST["cate_id"];
    

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



  if($upload){
    $stmt= $conn->prepare("UPDATE category SET name=:name, description=:description,image=:image WHERE id=:id ");
    $stmt -> bindParam(':image',$file_name);
  }else{
    $stmt= $conn->prepare("UPDATE category SET name=:name, description=:description WHERE id=:id ");
  }



    
    $stmt ->bindParam(':name',$name );
    $stmt ->bindParam(':description', $desc);
    $stmt -> bindParam(':id', $id);
    
    $stmt ->execute();
    header('Location: ../index.php');
}