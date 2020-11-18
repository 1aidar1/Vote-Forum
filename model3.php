<?php

$conn = mysqli_connect('localhost', 'aarkayevf20', 'aezakmi0101', 'C354_aarkayevf20');

function create_post($post_name,$post_text,$user_id){
    global $conn;
    $current_date = date('Ymd');
    $sql = "insert into ProjectPosts value(NULL,'$post_name','$post_text','$user_id','$current_date')";
    return mysqli_query($conn,$sql);
}
function get_posts() 
{
    global $conn;
    
    $sql = "select ID,PostName,CreatorID,Date from ProjectPosts order by ID desc";
    $result = mysqli_query($conn, $sql);
    $data = [];
    $i=0;
    while($row = mysqli_fetch_assoc($result)){
        $data[$i++] = $row;
    }
    return $data;
}

function get_comments($post_id){   
    global $conn;
    $post_id = (int) $post_id;
    $sql = "select * from ProjectComments where PostID=$post_id";
    $result = mysqli_query($conn, $sql);
    $data = [];
    $i=0;
    while($row = mysqli_fetch_assoc($result)){
        //$row['CreatorID'] = get_user_name($row['CreatorID']);
        $data[$i++] = $row;
    }
    return $data;
}

function get_post_content($id) 
{
    global $conn;
    $id = (int) $id;
    
    $sql = "select * from ProjectPosts where ID = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    } else
        return -1;
}

function comment_post($post_id,$comment_text,$user_id){
    global $conn;
    $current_date = date('Ymd');
    $sql = "insert into ProjectComments value(NULL,'$post_id','$comment_text','$user_id','$current_date')";
    return mysqli_query($conn,$sql);
}

function get_user_name($user_id)
{
    global $conn;
    $id = (int) $user_id;
    $sql = "select Handle from ProjectUsers where ID = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['Handle'];
    } else
        return -1;
}
?>  