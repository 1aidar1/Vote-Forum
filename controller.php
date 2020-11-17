<?php


if (!isset($_SERVER['HTTPS'])) {
    $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: " . $url);
    exit;
}

require('model.php');
require('model2.php');
require('model3.php');

session_start();

$isSigned = false;


if (empty($_POST['page'])) {
    if (isset($_SESSION['id'])) {
        if (check_validity($_SESSION['handle'], $_SESSION['password'])) {
            include 'SignedPage.php';
            exit;
        }
    } else
        include('MainPage.php');
} else {
    $page = $_POST['page'];
    if ($page == 'Header') {
        if (isset($_POST['command'])) {
            $command = $_POST['command'];
        }
        switch ($command) {
            case 'SignIn':
                if (isset($_POST['handle']) && isset($_POST['password'])) {
                    $handle = $_POST['handle'];
                    $password = $_POST['password'];
                }
                if (check_validity($handle, $password)) {
                    $_SESSION['handle'] = $handle;
                    $_SESSION['password'] = $password;
                    $isSigned = true;
                    $display_type = 'no-sign-in';
                    $id = get_user_id($handle);
                    $_SESSION['id'] = $id;
                    include 'SignedPage.php';
                    exit;
                } else {
                    $isSigned = false;
                    $display_type = 'sign-in';
                }
                $ans = array(
                    "isSigned" => $isSigned,
                    "display" => $display_type
                );
                echo json_encode($ans);
                //include 'SignedPage.php';
                exit;
            case 'Register':
                $UIN = $_POST['UIN'];
                $handle = $_POST['handle'];
                $password = $_POST['password'];
                $tel = $_POST['tel'];
                if (join_a_user($UIN, $handle, $password, $tel)) {
                    $display_type = 'registered';
                } else {
                    $display_type = 'register';
                }
                $ans = array(
                    "isSigned" => $isSigned,
                    "display" => $display_type
                );
                echo json_encode($ans);
                exit;
        }
    } else if ($page == 'Content') {
        if (isset($_POST['command'])) {
            $command = $_POST['command'];
        }
        if (!isset($_SESSION['id'])) {
            $ans = array(
                "id" => -1,
                "display" => 'none'
            );
            echo json_encode($ans);
            exit;
        }
        $id = $_SESSION['id'];
        switch ($command) {
            case 'CreatePost':
                $ans = array(
                    "id" => $id,
                    "display" => 'CreatePost'
                );
                echo json_encode($ans);
                exit;

            case 'SendVote':
                $ans = array(
                    "id" => $id,
                    "display" => 'SendVote'
                );
                echo json_encode($ans);
                exit;
            case 'SubmitPost':
                $post_name = $_POST['post_name'];
                $post_text = $_POST['post_text'];
                echo create_post($post_name, $post_text, $_SESSION['id']);
                exit;
            case 'GetPosts':
                $ans = get_posts();
                
                foreach ($ans as $key => $value) {
                    
                    $ans[$key]['CreatorID'] = get_user_name($ans[$key]['CreatorID']);
                    
                }   
                echo json_encode($ans);
        }
    } else if ($page == 'SettingsPage') {
        if (isset($_POST['command'])) {
            $command = $_POST['command'];
        }
        $id = $_SESSION['id'];
        switch ($command) {
            case 'ChangeUIN':
                if (isset($_POST['new_UIN'])) {
                    $UIN = $_POST['new_UIN'];
                }
                echo change_UIN($UIN, $id);
                break;
            case 'ChangeHandle':
                if (isset($_POST['new_handle'])) {
                    $handle = $_POST['new_handle'];
                }
                echo change_handle($handle, $id);
                break;
            case 'ChangePassword':
                if (isset($_POST['new_password'])) {
                    $password = $_POST['new_password'];
                    $confirm_password = $_POST['confirm_password'];
                }
                echo change_password($password, $confirm_password, $id);
                break;
            case 'ChangeTel':
                if (isset($_POST['new_tel'])) {
                    $tel = $_POST['new_tel'];
                }
                echo change_tel($tel, $id);
                break;
        }
    } else if ($page == 'SignedHeader') {
        if (isset($_POST['command'])) {
            $command = $_POST['command'];
        }
        switch ($command) {
            case 'SignOut':
                session_unset();
                session_destroy();
                include 'MainPage.php';
                break;
            case 'Settings':
                include 'SettingsPage.php';
                exit;
            case 'Home':
                include 'SignedPage.php';
                exit;
        }
    }
}
?>