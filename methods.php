<?php
session_start();
include('admin/config/dbcon.php');

if(isset($_POST['login_btn'])){
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $login_query = "SELECT * FROM `users` WHERE email = '$email' AND password = '$password' LIMIT 1";
    $login_query_run = mysqli_query($con, $login_query);

    if(mysqli_num_rows($login_query_run) > 0){

        foreach($login_query_run as $data){
            $user_id = $data['id'];
            $user_name = $data['fname'] . " " . $data['lname'];
            $user_email = $data['email'];
            $user_role = $data['role'];
        }

        $_SESSION['auth'] = true;
        $_SESSION['auth_role'] = "$user_role"; //1 - admin, 0 - user
        $_SESSION['auth_user'] = [
            'user_id' => $user_id,
            'user_name' => $user_name,
            'user_email' => $user_email
        ];

        if($_SESSION['auth_role'] == '1'){
            $_SESSION['message'] = "Welcome to dashboard";
            header("Location: admin/index.php");
            exit(0);
        } elseif($_SESSION['auth_role'] == '0') {
            $_SESSION['message'] = "You are Logged In.";
            header("Location: index.php");
            exit(0);
        }

    } else {

        $_SESSION['message'] = "Invalid Email/Password";
        header("Location: login.php");
        exit(0);

    }
} else {

    $_SESSION['message'] = "You are not allowed to access this page.";
    header("Location: login.php");
    exit(0);

}


if(isset($_POST['register_btn'])) {
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);;
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

    if($password == $confirm_password) {
        //Check Email
        $checkemail = "SELECT email FROM `users` WHERE email ='$email'";
        $checkemail_run = mysqli_query($con, $checkemail);

        if(mysqli_num_rows($checkemail_run) > 0){
            // Email already exists
            $_SESSION['message'] = 'Email already exists';
            header('Location: register.php');
            exit(0);
        } else{
            $user_query = "INSERT INTO users (fname, lname, email, password) VALUES('$fname', '$lname', '$email', '$password')";
            $user_query_run = mysqli_query($con, $user_query);

            if($user_query_run){
                $_SESSION['message'] = "Registered Successfully";
                header('Location: login.php');
                exit(0);
            } else {
                $_SESSION['message'] = "Something went wrong!";
                header('Location: login.php');
                exit(0);
            }
        }
    } else {
        $_SESSION['message'] = "Password and Confirm Password does not match";
        header('Location: register.php');
        exit(0);
    }

} else {
    header('Location: register.php');
    exit(0);
}


if(isset($_POST['logout_btn'])){
    // session destroy
    unset($_SESSION['auth']);
    unset($_SESSION['auth_role']);
    unset($_SESSION['auth_user']);

    $_SESSION['message'] = "Logged out successfully";
    header("Location: index.php");
    exit(0);
}

?>