<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Registered Users</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">Users</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <?php include('../message.php'); ?>
            <div class="card">
                <div class="card-header">
                    <h4>Registered Users
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#add_user_modal">Add User</button>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            
                            $query = "SELECT * FROM users";
                            $query_run = mysqli_query($con, $query);
                            
                            if(mysqli_num_rows($query_run) > 0) { 
                                
                                foreach($query_run as $row){
                                    ?>
                                    <tr>
                                        <td><?= $row['id']; ?></td>
                                        <td><?= $row['fname']; ?></td>
                                        <td><?= $row['lname']; ?></td>
                                        <td><?= $row['email']; ?></td>
                                        <td>
                                        <?php 
                                        if($row['role'] == '1') {
                                            echo "Admin";
                                        } else {
                                            echo "User";
                                        }   
                                        ?>
                                        </td>
                                        <!-- <td><a href="user_update.php" class="btn btn-success">Edit</a></td> -->
                                        <td>
                                            <button type="button" class="btn btn-success editbtn" data-bs-toggle="modal" data-bs-target="#edit_user_modal">Edit</button>
                                        </td>
                                        <td>
                                            <form action="methods.php" method="POST">
                                                <button type="submit" class="btn btn-danger" name="delete_user" value="<?= $row['id']; ?>">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                
                            ?>

                                

                            <?php } else { ?>

                                <tr>
                                    <td colspan="7">No record found</td>
                                </tr>    

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="add_user_modal" tabindex="-1" role="dialog" aria-labelledby="add_user_modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_user_modalLabel">Add User </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="methods.php" method="POST">
                <div class="modal-body">
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
                        <label for="">Role</label>
                        <select required name="role" class="form-control">
                            <option value="">--Select Role--</option>
                            <option value="0">User</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Password</label>
                        <input required type="password" placeholder="Enter Password" class="form-control" name="password" id="">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Confirm Password</label>
                        <input required type="password" placeholder="Enter Password" class="form-control" name="confirm_password" id="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add_user" class="btn btn-primary">Add User</button>
                </div>
            </form>

        </div>
    </div>
</div>


<!-- Edit User Modal -->
<div class="modal fade" id="edit_user_modal" tabindex="-1" role="dialog" aria-labelledby="edit_user_modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_user_modalLabel">Add User </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="methods.php" method="POST">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <input type="hidden" class="form-control" name="user_id" id="user_id">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">First Name</label>
                        <input required type="text" placeholder="Enter First Name" class="form-control" name="fname" id="fname">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Last Name</label>
                        <input required type="text" placeholder="Enter Last Name" class="form-control" name="lname" id="lname">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Email Id</label>
                        <input required type="text" placeholder="Enter Email Address" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Role</label>
                        <select required name="role" class="form-control" id="role">
                            <option value="">--Select Role--</option>
                            <option value="0">User</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="update_user" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.editbtn').on('click', function(){
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
            });

            console.log(data);

            $('#user_id').val(data[0]);
            $('#fname').val(data[1]);
            $('#lname').val(data[2]);
            $('#email').val(data[3]);
            $('#role').val(data[4]);
        });
    })
</script>

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>