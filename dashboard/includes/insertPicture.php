<?php
$newfilename = "newfilename";

if(isset($_FILES['image'])){
$file_name = $_FILES['image']['name'];
$newfilename =$file_name;
$file_tmp =$_FILES['image']['tmp_name'];
$file_type=$_FILES['image']['type'];

move_uploaded_file($file_tmp,"../assets/user_pictures/".$file_name);
$_SESSION['student_picture'] = $newfilename;
}

?>