<?php

$conn = mysqli_connect('localhost', 'aarkayevf20', 'aezakmi0101', 'C354_aarkayevf20');

function change_UIN($UIN,$id){
    global $conn;
    if(!check_existence_UIN($UIN)){
        $sql = "update ProjectUsers Set UIN = '$UIN' where ID = '$id'";
        return mysqli_query($conn,$sql); 
    }
    else return false;
}
function change_handle($handle,$id){
    global $conn;
    if(!check_existence_handle($handle)){
        $sql = "update ProjectUsers Set Handle = '$handle' where ID = '$id'";
        return mysqli_query($conn,$sql); 
    }
    else{
        return false;
    }
}
function change_password($password,$confirm_password,$id){
    global $conn;
    if($password==$confirm_password){
        $hash_password = hash('SHA256',$password);
        $sql = "update ProjectUsers Set Password = '$hash_password' where ID = '$id'";
        return mysqli_query($conn,$sql); 
    }
    else{
        return false;
    }
}
function change_tel($tel,$id){
    global $conn;
    if(isTel($tel)){
        $sql = "update ProjectUsers Set Tel = '$tel' where ID = '$id'";
        return mysqli_query($conn,$sql); 
    }
    else{
        return false;
    }
}
?>