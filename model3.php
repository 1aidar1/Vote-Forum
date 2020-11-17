<?php

$conn = mysqli_connect('localhost', 'aarkayevf20', 'aezakmi0101', 'C354_aarkayevf20');

function create_post($post_name,$post_text,$user_id){
    global $conn;
    $current_date = date('Ymd');
    $sql = "insert into ProjectPosts value(NULL,'$post_name','$post_text','$user_id','$current_date')";
    return mysqli_query($conn,$sql);
}

?>  