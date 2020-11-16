<?php

$conn = mysqli_connect('localhost', 'aarkayevf20', 'aezakmi0101', 'C354_aarkayevf20');

function check_existence_handle($handle)
{
    global $conn;
    $sql = "select Handle from ProjectUsers where Handle = '$handle'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}
function check_existence_UIN($UIN)
{
    global $conn;
    $sql = "select UIN from ProjectUsers where UIN = '$UIN'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}
function check_existence_tel($tel)
{
    global $conn;
    $sql = "select Tel from ProjectUsers where Tel = '$tel'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}

function get_user_id($handle)
{
    global $conn;
    $sql = "select ID,Handle from ProjectUsers where Handle = '$handle'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['ID'];
    } else
        return -1;
}

function check_validity($handle, $password)
{
    global $conn;
    $hash_password = hash('SHA256',$password);

    $sql = "select Handle,Password from ProjectUsers where Handle = '$handle' and Password ='$hash_password'";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}
function isTel($tel){
    $tel = str_replace(' ','',$tel);;
     if($tel[0]=='1' && strlen($tel)==11 && is_numeric($tel)==1){
         return true;
     }
     else{
         return false;
     }
}

function join_a_user($UIN, $handle, $password, $tel)
{
    global $conn;
    $current_date = date('Ymd');
    if (check_existence_handle($handle) || check_existence_UIN($UIN) || !isTel($tel)) {
        return false;
    } else {
        $hash_password = hash('SHA256',$password);
        $sql = "insert into ProjectUsers value (NULL,'$UIN','$handle','$hash_password', '$tel','$current_date')";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else return false;
    }
}
?>