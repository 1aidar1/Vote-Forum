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
$error = '';


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
                    $error = 'Wrong Handle or password';
                    include 'MainPage.php';
                }
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
            switch ($command) {
                case 'GetPosts':
                    $ans = get_posts();

                    foreach ($ans as $key => $value) {
                        $ans[$key]['CreatorID'] = get_user_name($ans[$key]['CreatorID']);
                    }
                    echo json_encode($ans);
                    exit;

                case 'OpenPost':
                    $post_id = $_POST['post_id'];
                    $post_id = (int) filter_var($post_id, FILTER_SANITIZE_NUMBER_INT);
                    $ans = get_post_content($post_id);
                    $_SESSION['current_post'] = $post_id;
                    /*foreach ($ans as $key => $value) {
                        $ans[$key]['CreatorID'] = get_user_name($ans[$key]['CreatorID']);
                    }*/
                    echo json_encode($ans);
                    exit;
                case 'CreatePost':
                    $ans = array(
                        "id" => -1,
                        "display" => 'register'
                    );
                    echo json_encode($ans);
                    exit;
                case 'Vote':
                    echo -1;
                    exit;
            }
        }
        //IF SIGNED
        $id = $_SESSION['id'];
        switch ($command) {
            case 'CreatePost':
                $ans = array(
                    "id" => $id,
                    "display" => 'CreatePost'
                );
                echo json_encode($ans);
                exit;

            case 'Vote': 
                $vote = $_POST['vote'];
                $v = (int) hasVoted($id);
                if($v!=0){
                    echo 0;
                }
                else{
                    vote($id,$vote);
                    echo 1;
                }
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
                exit;
            case 'OpenPost':
                $post_id = $_POST['post_id'];
                $post_id = (int) filter_var($post_id, FILTER_SANITIZE_NUMBER_INT);
                $ans = get_post_content($post_id);
                $_SESSION['current_post'] = $post_id;
                foreach ($ans as $key => $value) {
                    if (isset($ans[$key]['CreatorID'])) {
                        $ans[$key]['CreatorID'] = get_user_name($ans[$key]['CreatorID']);
                    }
                }
                echo json_encode($ans);
                exit;
            case 'SubmitComment':
                $id = $_SESSION['id'];
                $comment_text = $_POST['comment_text'];
                //echo $comment_text;
                //echo $_SESSION['current_post'];
                echo comment_post($_SESSION['current_post'], $comment_text, $id);
                exit;
            case 'GetComments':
                $ans = get_comments($_SESSION['current_post']);

                foreach ($ans as $key => $value) {
                    if (isset($ans[$key]['UserID'])) {
                        $ans[$key]['UserID'] = get_user_name($ans[$key]['UserID']);
                    }
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