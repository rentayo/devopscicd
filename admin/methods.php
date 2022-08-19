<?php
include('authentication.php');


if(isset($_POST['add_user'])){
    
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $role = mysqli_real_escape_string($con, $_POST['role']);

    $query = "INSERT INTO users (fname, lname, email, password, role) VALUES ('$fname', '$lname', '$email', '$password', '$role')";
    $query_run = mysqli_query($con, $query);

    if($query_run) {

        $_SESSION['message'] = "Admin/User Added Successfully.";
        header("Location: view-users.php");
        exit(0);

    }
    else {

        $_SESSION['message'] = "Something went wrong!";
        header("Location: view-users.php");
        exit(0);

    }
}


if(isset($_POST['update_user'])){

    $id = mysqli_real_escape_string($con, $_POST['user_id']);
    
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $role = mysqli_real_escape_string($con, $_POST['role']);

    $update_query = "UPDATE users SET fname='$fname', lname='$lname', email='$email', role='$role' WHERE id='$id'  ";
    $query_run = mysqli_query($con, $update_query);

    if($query_run) {

        $_SESSION['message'] = "Admin/User Updated Successfully.";
        header("Location: view-users.php");
        exit(0);
    }
    else
    {

        $_SESSION['message'] = "Something went wrong!";
        header("Location: view-users.php");
        exit(0);
    }
}


if(isset($_POST['delete_user'])){

    $user_id = $_POST['delete_user'];

    $query = "DELETE FROM `users` WHERE id = '$user_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run) {
        $_SESSION['message'] = 'User successfully deleted.';
        header("Location: view-users.php");
        exit(0);
    }
    else {
        $_SESSION['message'] = 'Failed to delete user.';
        header("Location: view-users.php");
        exit(0);
    }
}


if(isset($_POST['logout_btn'])){
    // session destroy
    unset($_SESSION['auth']);
    unset($_SESSION['auth_role']);
    unset($_SESSION['auth_user']);

    $_SESSION['message'] = "Logged out successfully";
    header("Location: ../index.php");
    exit(0);
}
?>