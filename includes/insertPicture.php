<?php
include("includes/connection.php");
$errors = "";
$newfilename = "newfilename";
$flag=0;
//echo $_FILES['image']['name'];
if(isset($_FILES['image'])){
$errors= array();
$file_name = $_FILES['image']['name'];
$newfilename =$file_name;
$file_size =$_FILES['image']['size'];
$file_tmp =$_FILES['image']['tmp_name'];
$file_type=$_FILES['image']['type'];
// echo $file_tmp,"/user_pictures/".$file_name;
// $ext = end((explode(".", $file_name)));
move_uploaded_file($file_tmp,"assets/user_pictures/".$file_name);

// $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

// $extensions= array("jpeg","jpg","png");
// if(file_exists($file_name)) {
// echo "Sorry, file already exists.";
// }
// if(in_array($file_ext,$extensions)=== false){
// $errors[]="file format not allowed, please choose a JPEG or PNG file.";
// }

// if($file_size > 2097152){
// $errors[]='File size must be less than 2 MB';
// }

// if(empty($errors)==true){
// move_uploaded_file($file_tmp,"user_pictures/".$newfilename.".".$file_ext);
// $flag=1;
// //echo "<script>window.close();</script>";

// }
}

// else{
// print_r($errors);
// }

?>