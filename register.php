<?php
session_start();

if(isset($_SESSION['auth'])){
    if(!isset($_SESSION['message'])){
        $_SESSION['message'] = "You are already logged in.";
    }
    header("Location: index.php");
    exit(0);
}

include('includes/header.php');
include('includes/navbar.php');
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <?php include('message.php'); ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Register</h4>
                    </div>
                    <div class="card-body">
                        <form action="methods.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="">First Name</label>
                                <input required type="text" placeholder="Enter First Name" class="form-control" name="fname" id="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Last Name</label>
                                <input required type="text" placeholder="Enter Last Name" class="form-control" name="lname" id="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email Id</label>
                                <input required type="text" placeholder="Enter Email Address" class="form-control" name="email" id="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Password</label>
                                <input required type="password" placeholder="Enter Password" class="form-control" name="password" id="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Confirm Password</label>
                                <input required type="password" placeholder="Enter Password" class="form-control" name="confirm_password" id="">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="register_btn" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>