<?php
if(isset($_POST['btn-post']))//edit an existing post
{
    $target_dir = "../img/";
    $target_file = $target_dir . basename($_FILES['image']['name']);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    //getimagesize when image is not empty
    $uid = trim($_POST['uid']);
	$title = trim($_POST['title']);
	$text = trim($_POST['text']);
    $views = trim($_POST['views']);
	$date = date("d/m/Y");
    $uid = base64_decode($uid);//decode uid
    if(empty($image))//if a new image was not selected
    {
        $stmt = $actionParam->runQuery("SELECT * FROM tbl_blog WHERE userID=:id");
        $stmt->execute(array(":id"=>$uid));
        $blogRow=$stmt->fetch(PDO::FETCH_ASSOC);
	    $image = $blogRow['image'];//get the existing image
        if($actionParam->edit_post($uid,$image,$title,$text,$views,$date))
        {
                header("Location: viewpost?edited");
                exit;
        }
    }
    else
    {
        $image_data = getimagesize($_FILES['image']['tmp_name']);
        list($width, $height) = getimagesize($_FILES['image']['tmp_name']);
        //check image dimension, must be width 800 x height 570
	    if($width == 800 && $height == 570)
	    {
           // Check size of the image
           if ($_FILES["image"]["size"] > 2000000) {//2MB max size
               header("Location: viewpost?large-image-size");
               exit;
           }
           // Allow certain image formats
           if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
              header("Location: viewpost?invalid-image-format");
              exit;
           }
           //check if file is an image
           if(is_array($image_data) && strpos($image_data['mime'],'image') !== false)
           {
              if($actionParam->edit_post($uid,$image,$title,$text,$views,$date))
              {
                 if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    header("Location: viewpost?edited");
                    exit;
                  }
              }
           }
           else
           {
              header("Location: viewpost?invalid-image-data");
              exit;
           }
	
        } 
        else
        {
          header("Location: viewpost?invalid-image-dimension");
          exit;
        }
        
    }

}
?>