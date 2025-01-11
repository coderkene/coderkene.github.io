<?php
if(isset($_POST['btn-post']))//create a new post
{
    $target_dir = "../img/";
    $target_file = $target_dir . basename($_FILES['image']['name']);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_data = getimagesize($_FILES['image']['tmp_name']);
	list($width, $height) = getimagesize($_FILES['image']['tmp_name']);
	$title = trim($_POST['title']);
	$text = trim($_POST['text']);
	$date = date("d/m/Y");
	//check image dimension, must be width 800 x height 570
	if($width == 800 && $height == 570)
	{
    // Check size of the image
    if ($_FILES["image"]["size"] > 2000000) {//2MB max size
        header("Location: createpost?large-image-size");
        exit;
    }
    // Allow certain image formats
    if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
        header("Location: createpost?invalid-image-format");
        exit;
    }
    //check if file is an image
    if(is_array($image_data) && strpos($image_data['mime'],'image') !== false)
    {
        if($actionParam->create_post($image,$title,$text,$date))
        {
            if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                header("Location: createpost?created");
                exit;
            }
        }
    }
    else
    {
        header("Location: createpost?invalid-image-data");
        exit;
    }
	
  } 
  else
  {
        header("Location: createpost?invalid-image-dimension");
        exit;
  }

}
?>