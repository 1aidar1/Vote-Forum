<?php


if (!isset($_SERVER['HTTPS'])) {
    $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: " . $url);
    exit;
}

require('model.php');
require('model2.php');

if (empty($_POST['page'])) {
    include('MainPage.php');
}
else {
    $page = $_POST['page'];
    if ($page == 'MainPage') {
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
                } else {
                    $isSigned = false;
                    $display_type = 'sign-in';
                }
                $ans = array(
                    "isSigned" => $isSigned,
                    "display" => $display_type
                );
                echo json_encode($ans);
                break;
            case 'Register':
                $UIN = $_POST['UIN'];
                $handle = $_POST['handle'];
                $password = $_POST['password'];
                $tel = $_POST['tel'];
                if (join_a_user($UIN, $handle, $password, $tel)) {
                    $display_type = 'no-sign-in';
                } else {
                    $display_type = 'register';
                }
                $ans = array(
                    "isSigned" => $isSigned,
                    "display" => $display_type
                );
                echo json_encode($ans);
                break;
        }
    }
}

?>