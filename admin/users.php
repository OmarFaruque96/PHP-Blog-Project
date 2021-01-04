<?php 
	include "inc/header.php";
?>

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <!-- <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">All User Information</li>
                        </ol> -->   
                         
                        <!-- page content start from here -->
                        
                        <!-- user read, create, delete, update -->

                        <?php 

                            $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';


                            // if(isset($_GET['do'])){
                            //     $do = $_GET['do'];
                            // }else{
                            //     $do = 'Manage';
                            // }

                            if($do == 'Manage'){
                                // view all users
                                ?>

                                <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                All Users Information
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Serial</th>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th>Mail</th>
                                                <th>Phone No</th>
                                                <th>Address</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Serial</th>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th>Mail</th>
                                                <th>Phone No</th>
                                                <th>Address</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                            <!-- read all user info -->
                                            <?php 

                                                // 3 step
                                            $query = "SELECT * FROM users";
                                            $result = mysqli_query($db,$query);
                                            $i = 0;
                                            while($row = mysqli_fetch_assoc($result)){
                                                $u_id       = $row['u_id'];
                                                $u_name     = $row['u_name'];
                                                $u_mail     = $row['u_mail'];
                                                $u_phone    = $row['u_phone'];
                                                $u_pass     = $row['u_pass'];
                                                $u_address  = $row['u_address'];
                                                $u_photo    = $row['u_photo'];
                                                $u_role     = $row['u_role'];
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td><?php echo $i;?></td>
                                                    <td>
                                                        <img src="img/users/<?php echo $u_photo;?>" width="80">
                                                    </td>
                                                    <td><?php echo $u_name;?></td>
                                                    <td><?php echo $u_mail;?></td>
                                                    <td><?php echo $u_phone;?></td>
                                                    <td><?php echo $u_address;?></td>
                                                    <td>
                                                        <?php 
                                                            if($u_role == 1){
                                                                echo "<span class='badge badge-danger'>administrator</span>";
                                                            }
                                                            if($u_role == 0){
                                                                echo "<span class='badge badge-info'>subscriber</span>";
                                                            }
                                                            if($u_role == 2){
                                                                echo "<span class='badge badge-success'>Editor</span>";
                                                            }
                                                        ?>
                                                            
                                                    </td>
                                                    <td>
                                                        <a href="users.php?do=edit&editUser=<?php echo $u_id;?>" type="button" class="btn btn-primary" >
                                                            Edit
                                                        </a>
                                                        <a href="" type="button" class="btn btn-info" data-toggle="modal" data-target="#delete<?php echo $u_id;?>">
                                                            Delete
                                                        </a>
                                                    </td>

                                                    <!-- modal code -->
                                                    <!-- The Modal -->
        <div class="modal" id="delete<?php echo $u_id;?>">
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h5 class="modal-title">Confirm Your Action</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <center>
                    <a href="users.php?do=delete&&deleteId=<?php echo $u_id;?>">
                        <button class="btn btn-md btn-danger">YES</button>
                    </a>
                    <a href="#"><button class="btn btn-md btn-success">NO</button></a>
                </center>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>

            </div>
          </div>
        </div>

                                                </tr>
                                            <?php
                                            }


                                            ?>

                                            
                                            
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                                <?php
                            }
                            else if($do == 'add'){
                                ?>
                            <div class="card">
                                <div class="card-body">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="text">Full Name:</label>
                                                    <input type="text" class="form-control" placeholder="Enter Name" name="username">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="email">Email address:</label>
                                                    <input type="email" class="form-control" placeholder="Enter email" id="email" name="useremail">
                                                  </div>
                                                  <div class="form-group">
                                                    <label>Password:</label>
                                                    <input type="password" class="form-control" placeholder="Enter password" name="password">
                                                  </div>
                                                  <div class="form-group">
                                                    <label>Repeat Password:</label>
                                                    <input type="password" class="form-control" placeholder="Repeat password" name="repeatPassword">
                                                  </div>
                                                  
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Address:</label>
                                                    <input type="text" class="form-control" placeholder="Address" name="address">
                                                  </div>
                                                  <div class="form-group">
                                                    <label>Phone:</label>
                                                    <input type="text" class="form-control" placeholder="Phone" name="phone">
                                                  </div>
                                                  <div class="form-group">
                                                    <label>User Photo:</label>
                                                    <input type="file" class="form-control" name="image">
                                                  </div>
                                                  <div class="form-group">
                                                    <label>User Role:</label>
                                                    <select name="user_role" class="form-control">
                                                        <option value="1">Administrator</option>
                                                        <option value="0" selected>Subscriber</option>
                                                        <option value="2">Editor</option>
                                                    </select>
                                                  </div>
                                                  <div class="form-group form-check">
                                                    <label class="form-check-label">
                                                      <input class="form-check-input" type="checkbox"> Remember me
                                                    </label>
                                                  </div>
                                                  <button type="submit" class="btn btn-primary" name="addUser">Add New User</button>
                                            </div>
                                        </div>
                                    </form>

                                    <!-- add new user -->
                                    <?php 

                                        if(isset($_POST['addUser'])){
                                            $username       = $_POST['username'];
                                            $useremail      = $_POST['useremail'];
                                            $password       = $_POST['password'];
                                            $repeatPassword = $_POST['repeatPassword'];
                                            $phone          = $_POST['phone'];
                                            $address        = $_POST['address'];
                                            $user_role      = $_POST['user_role'];
                                            // file 
                                            $file_name      = $_FILES['image']['name'];
                                            $tmp_name       = $_FILES['image']['tmp_name'];
                                            //$file_size      = $_FILES['image']['size'];

                                            $extn = strtolower(end(explode('.', $_FILES['image']['name'])));

                                            // universal image type array

                                            $extensions = array("jpeg","png","jpg");


                                            // form validation
                                            if(empty($username) || empty($useremail) || empty($password) || empty($repeatPassword) || empty($phone) || empty($address) || empty($file_name)){
                                                echo '<div class="alert alert-danger">Please Fill All the information</div>';
                                            }else{
                                                // user fill all the info
                                                // check passoword
                                                if($password == $repeatPassword){
                                                    // insert the data
                                                    $hasspassword = sha1($password);
                                                    // step 3
                                                    // if file type is an image
                                                    if(in_array($extn, $extensions) === false){
                                                        // not an image

                                                        echo '<div class="alert alert-danger">Please Select any jpg,jpeg or png format image!</div>';
                                                    }else{

                                                        // move the image into a folder
                                                        $random = rand();
                                                        $updateName = $random.$file_name;
                                                        // img/users/imagename
                                                        move_uploaded_file($tmp_name, "img/users/".$updateName);

                                                    $sql = "INSERT INTO users (u_name,u_mail,u_phone,   u_pass,u_address,u_photo,u_role) VALUES ('$username','$useremail','$phone','$hasspassword','$address','$updateName','$user_role')";

                                                    $result = mysqli_query($db,$sql);

                                                    if($result){
                                                        header('Location: users.php');
                                                    }else{
                                                        die("Insert User Error!".mysqli_error($db));
                                                    }

                                                    }

                                                }else{
                                                    echo '<div class="alert alert-danger">Password Not Matched!</div>';
                                                }
                                            }

                                        }

                                    ?>
                                </div>
                            </div>


                                <?php

                            }
                            else if($do == 'edit'){
                                
                                if(isset($_GET['editUser'])){
                                    $edit_id = $_GET['editUser'];


                                    $query = "SELECT * FROM users WHERE u_id='$edit_id'";
                                    $result = mysqli_query($db,$query);
                                   
                                    while($row = mysqli_fetch_assoc($result)){
                                        $u_name     = $row['u_name'];
                                        $u_mail     = $row['u_mail'];
                                        $u_phone    = $row['u_phone'];
                                        $u_pass     = $row['u_pass'];
                                        $u_address  = $row['u_address'];
                                        $u_photo    = $row['u_photo'];
                                        $u_role     = $row['u_role'];
                                        
                                    }
                                    ?>

                            <div class="card">
                                <div class="card-body">
                                    <form action="users.php?do=update" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="text">Full Name:</label>
                                                    <input type="text" class="form-control" placeholder="Enter Name" name="username" value="<?php echo $u_name;?>">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="email">Email address:</label>
                                                    <input type="email" class="form-control" placeholder="Enter email" id="email" name="useremail" value="<?php echo $u_mail;?>">
                                                  </div>
                                                  <div class="form-group">
                                                    <label>Reset Password:</label>
                                                    <input type="password" class="form-control" placeholder="Enter password" name="password">
                                                  </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Address:</label>
                                                    <input type="text" class="form-control" placeholder="Address" name="address" value="<?php echo $u_address;?>">
                                                  </div>
                                                  <div class="form-group">
                                                    <label>Phone:</label>
                                                    <input type="text" class="form-control" placeholder="Phone" name="phone" value="<?php echo $u_phone;?>">
                                                  </div>
                                                  <div class="form-group">
                                                    <label>User Photo:</label>


                                                    <?php 

                                                    if(empty($u_photo)){
                                                        ?>
                                                        <img src="img/users/default.jpg" width="100" class="rounded">
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <img src="img/users/<?php echo $u_photo;?>" width="100" class="rounded">
                                                        <?php
                                                    }

                                                    ?>

                                                    
                                                    <input type="file" class="form-control" name="image">
                                                  </div>
                                                  <div class="form-group">
                                                    <label>User Role:</label>
                                                    <select name="user_role" class="form-control">
                                                        <option value="1" <?php if($u_role == 1){
                                                            echo 'selected';}?>>Administrator</option>
                                                        <option value="0" <?php if($u_role == 0){
                                                            echo 'selected';}?>>Subscriber</option>
                                                        <option value="2" <?php if($u_role == 2){
                                                            echo 'selected';}?>>Editor</option>
                                                    </select>
                                                  </div>
                                                  <div class="form-group form-check">
                                                    <label class="form-check-label">
                                                      <input class="form-check-input" type="checkbox"> Remember me
                                                    </label>
                                                  </div>

                                                  <div class="form-group">
                                                      <input type="hidden" name="updateUserId" value="<?php echo $edit_id;?>">
                                                      <input type="submit" class="btn btn-primary" name="updateUser" value="Update User">
                                                  </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                                <?php
                                }
                            

                            }
                            else if($do == 'update'){
                                // update user

                                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                                    // edit user id
                                    $edit_id = $_POST['updateUserId'];

                                    $username       = $_POST['username'];
                                    $useremail      = $_POST['useremail'];
                                    $password       = $_POST['password'];
                                    $phone          = $_POST['phone'];
                                    $address        = $_POST['address'];
                                    $user_role      = $_POST['user_role'];
                                    // file 
                                    $file_name      = $_FILES['image']['name'];
                                    $tmp_name       = $_FILES['image']['tmp_name'];


                                    // user password update 
                                    // user only image update
                                    // user update both

                                    // update image and password
                                    if(!empty($password) && !empty($file_name)){

                                        $hassPass       = sha1($password);
                                        // generate a random number
                                        $random         = rand();
                                        $updateImgName  = $random.$file_name;

                                        move_uploaded_file($tmp_name, "img/users/".$updateImgName);

                                        // delete existing image
                                        $sql = "SELECT u_photo FROM users WHERE u_id = '$edit_id'";

                                        $result = mysqli_query($db,$sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $photo = $row['u_photo'];
                                        }
                                        unlink("img/users/".$photo);



                                        $sql = "UPDATE users SET u_name='$username', u_mail='$useremail',u_phone='$phone',u_pass='$hassPass',u_address='$address',u_photo='$updateImgName',u_role='$user_role' WHERE u_id='$edit_id'";
                                        $result = mysqli_query($db,$sql);

                                        if($result){
                                            header('Location: users.php');
                                        }else{
                                            die("Insert User Error!".mysqli_error($db));
                                        }

                                    }
                                    // user only change the password not image
                                    else if(!empty($password) && empty($file_name)){
                                        $hassPass       = sha1($password);
                                        $sql = "UPDATE users SET u_name='$username', u_mail='$useremail',u_phone='$phone',u_pass='$hassPass',u_address='$address',u_role='$user_role' WHERE u_id='$edit_id'";
                                        $result = mysqli_query($db,$sql);

                                        if($result){
                                            header('Location: users.php');
                                        }else{
                                            die("Insert User Error!".mysqli_error($db));
                                        }
                                    }
                                    // user change the image not password

                                    else if(empty($password) && !empty($file_name)){
                                        
                                        $random         = rand();
                                        $updateImgName  = $random.$file_name;

                                        move_uploaded_file($tmp_name, "img/users/".$updateImgName);

                                        // delete existing image
                                        $sql = "SELECT u_photo FROM users WHERE u_id = '$edit_id'";

                                        $result = mysqli_query($db,$sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $photo = $row['u_photo'];
                                        }
                                        unlink("img/users/".$photo);



                                        $sql = "UPDATE users SET u_name='$username', u_mail='$useremail',u_phone='$phone',u_address='$address',u_photo='$updateImgName',u_role='$user_role' WHERE u_id='$edit_id'";
                                        $result = mysqli_query($db,$sql);

                                        if($result){
                                            header('Location: users.php');
                                        }else{
                                            die("Insert User Error!".mysqli_error($db));
                                        }

                                    }
                                    else{
                                        $sql = "UPDATE users SET u_name='$username', u_mail='$useremail',u_phone='$phone',u_address='$address',u_role='$user_role' WHERE u_id='$edit_id'";
                                        $result = mysqli_query($db,$sql);

                                        if($result){
                                            header('Location: users.php');
                                        }else{
                                            die("Insert User Error!".mysqli_error($db));
                                        }
                                    }

                                }

                            }
                            else if($do == 'delete'){
                                // delete
                                if(isset($_GET['deleteId'])){
                                    $delete_user_id = $_GET['deleteId'];
                                    
                                    // image delete first
                                    $sql = "SELECT u_photo FROM users WHERE u_id = '$delete_user_id'";

                                    $result = mysqli_query($db,$sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $photo = $row['u_photo'];
                                    }

                                    // delete photo
                                    unlink("img/users/".$photo);


                                    $table = 'users';
                                    $table_id = 'u_id';
                                    $item_id = $delete_user_id;
                                    $url = 'users.php';

                                    delete($table,$table_id,$item_id,$url);
                                }
                            }


                        ?>
                        
                    </div>
                </main>

<?php 
	include "inc/footer.php";
?>