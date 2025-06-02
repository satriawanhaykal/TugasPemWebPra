<?php
$connection = mysqli_connect("localhost", "root", "", "kuliah");
if(!$connection){
    $_SESSION['message'] = "Connection Failed: " . mysqli_connect_error();
    $_SESSION['message_type'] = "error";
}else{
    $_SESSION['message'] = "Connection Successfully!";
    $_SESSION['message_type'] = "success";
}
?>