<?php

$conn = mysqli_connect('localhost', 'aarkayevf20', 'aezakmi0101', 'C354_aarkayevf20');

function change_UIN($UIN,$id){
    global $conn;
    $sql = "update ProjectUsers Set UIN = '$UIN' where ID = '$id'";
    return mysqli_query($conn,$sql); 
}
function change_handle($handle,$id){
    global $conn;
    $sql = "update ProjectUsers Set Handle = '$handle' where ID = '$id'";
    return mysqli_query($conn,$sql); 
}
function change_password($password,$id){
    global $conn;
    $sql = "update ProjectUsers Set Password = '$password' where ID = '$id'";
    return mysqli_query($conn,$sql); 
}
function change_tel($tel,$id){
    global $conn;
    $sql = "update ProjectUsers Set Tel = '$tel' where ID = '$id'";
    return mysqli_query($conn,$sql); 
}
?>