<?php 
	include "inc/header.php";
?>

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        
                        <!-- page content start from here -->
                        
                        <?php 

                        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

                        if($do == 'Manage'){

                            // view all posts

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
                                                <th>Date</th>
                                                <th>Thumbnail</th>
                                                <th>Title</th>
                                                <th>Desc</th>
                                                <th>Category</th>
                                                <th>Author</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Serial</th>
                                                <th>Date</th>
                                                <th>Thumbnail</th>
                                                <th>Title</th>
                                                <th>Desc</th>
                                                <th>Category</th>
                                                <th>Author</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>


                                            <?php 

                                            $sql2 = "SELECT * FROM posts";
                                            $result2 = mysqli_query($db,$sql2);
                                            $i = 0;
                            while ($row = mysqli_fetch_assoc($result2)) {
                                $p_id           = $row['p_id'];
                                $p_title        = $row['p_title'];
                                $p_desc         = $row['p_desc'];
                                $p_date         = $row['p_date'];
                                $p_cat          = $row['p_cat'];
                                $p_author       = $row['p_author'];
                                $p_thumbnail    = $row['p_thumbnail'];
                                $p_status       = $row['p_status'];
                                $i++;


                                                ?>

                                                <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $p_date;?></td>
                                                <td>
                                                    <img src="img/posts/<?php echo $p_thumbnail;?>"width="120" class="rounded">
                                                </td>
                                                <td><?php echo $p_title ;?></td>
                                                <td>
                                                    <?php 

                                                    echo substr($p_desc, 0, 100);
                                                
                                                    ?>
                                                    
                                                </td>
                                                <td>
                                                    <?php 

                                                    $sql3 = "SELECT c_name from category WHERE c_id='$p_cat'";
                                                    $result3 = mysqli_query($db,$sql3);

                                                    while ($row = mysqli_fetch_assoc($result3)) {
                                                        $cat_name = $row['c_name'];
                                                    }

                                                    echo $cat_name;

                                                    ?>  
                                                </td>
                                                <td>
                                                    <?php 

                                                    $sql = "SELECT u_name from users WHERE u_id='$p_author'";
                                                    $result = mysqli_query($db,$sql);

                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $user_name = $row['u_name'];
                                                    }

                                                    echo $user_name;

                                                    
                                                    ?>
                                                
                                                </td>
                                                <td>
                                                    <?php 

                                                    if($p_status == 0){
                                                        echo '<span class="badge badge-danger">Pending</span>';
                                                    } 
                                                    else if($p_status == 1){
                                                        echo '<span class="badge badge-success">Active</span>';
                                                    }


                                                    ?>
                                                    
                                                </td>
                                                <td>
                                                    <a href="posts.php?do=edit&editPost=<?php echo $p_id;?>" type="button" class="btn btn-primary" >
                                                            Edit
                                                        </a>
                                                        <a href="" type="button" class="btn btn-info" data-toggle="modal" data-target="#delete<?php echo $p_id;?>">
                                                            Delete
                                                        </a>
                                                </td>
                                                    
                                                    <!-- modal code -->
                                                    <!-- The Modal -->
        <div class="modal" id="delete<?php echo $p_id;?>">
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
                    <a href="posts.php?do=delete&deleteId=<?php echo $p_id;?>">
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



                        }else if($do == 'add'){

                            ?>

            <div class="card">
                                <div class="card-body">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="text">Post Title:</label>
                                                    <input type="text" class="form-control" placeholder="Title" name="title">
                                                </div>
                                                <div class="form-group">
                                                    <label>Post Description:</label>
                                                    <textarea rows="10" cols="10" class="form-control" placeholder="Description" name="description"></textarea>
                                                </div>
                                                    
                                            </div>
                                            <div class="col-md-6">
                                                
                                                <div class="form-group">
                                                    <label>Select Post Thumbnail</label>
                                                    <input type="file" name="thumbnail">
                                                </div> 

                                            <div class="form-group">
                                                <span style="">Select Category</span>
                                                <div class="form-check" style="margin-top: 30px;">

                <?php 

                $sql = "SELECT * FROM category";
                $result = mysqli_query($db,$sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $cat_id         = $row['c_id'];
                    $cat_name       = $row['c_name'];
                    $cat_desc       = $row['c_desc'];
                    ?>

                    <label class="form-check-label">
                      <input class="form-check-input" name="category" type="checkbox" value="<?php echo $cat_id;?>"> <?php echo $cat_name;?>
                    </label><br>


                    <?php
                }

                ?>

                                                    
                                                </div>
                                            </div>
                                                  
                                                  
                                                  <button type="submit" class="btn btn-danger" name="addpost">Publish</button>
                                            </div>
                                        </div>
                                    </form>


<!-- add new post code -->
<?php 

    if(isset($_POST['addpost'])){
        $title          = $_POST['title'];
        $description    = $_POST['description'];
        $category       = $_POST['category'];
        // post img
        $file_name      = $_FILES['thumbnail']['name'];
        $file_tmp       = $_FILES['thumbnail']['tmp_name'];


        if(empty($title) || empty($description) || empty($category) || empty($file_name)){
            echo '<div class="alert alert-danger">Fill All the information!</div>';
        }else{

            $extn = strtolower(end(explode('.', $_FILES['thumbnail']['name'])));
            // universal image type array
            $extensions = array("jpeg","png","jpg");

            if(in_array($extn, $extensions) === false){
                // this file doesnot contain an image
                echo '<div class="alert alert-danger">Please Select an Image file!</div>';

            }else{

                $random     = rand();
                $updateName = $random."_".$file_name;

                move_uploaded_file($file_tmp, "img/posts/".$updateName);

            $sql = "INSERT INTO posts (p_title,p_desc,p_date,p_cat,p_author,p_thumbnail,p_status) VALUES ('$title', '$description', now(), '$category', 'admin', '$updateName', 0)";
            $result = mysqli_query($db,$sql);

            if($result){
                header('Location: posts.php');
            }else{
                die("Insert Post Error!".mysqli_error($db));
            }



        }

    }
}
?>



                                </div>
                            </div>


                            <?php


                        }else if($do == 'edit'){

                        if(isset($_GET['editPost'])){
                            $edit_post = $_GET['editPost'];

                            $sql5 = "SELECT * FROM posts WHERE p_id='$edit_post'";
                            $result5 = mysqli_query($db,$sql5);
                            
                            while ($row = mysqli_fetch_assoc($result5)) {
                                $p_id           = $row['p_id'];
                                $p_title        = $row['p_title'];
                                $p_desc         = $row['p_desc'];
                                $p_date         = $row['p_date'];
                                $p_cat          = $row['p_cat'];
                                $p_author       = $row['p_author'];
                                $p_thumbnail    = $row['p_thumbnail'];
                                $p_status       = $row['p_status'];
                            }
                            ?>

    <div class="card">
        <div class="card-body">
            <form action="posts.php?do=update" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="text">Post Title:</label>
                            <input type="text" class="form-control" placeholder="Title" name="title" value="<?php echo $p_title;?>">
                        </div>
                        <div class="form-group">
                            <label>Post Description:</label>
                            <textarea rows="10" cols="10" class="form-control" placeholder="Description" name="description" value="<?php echo $p_desc;?>"><?php echo $p_desc;?></textarea>
                        </div>
                            
                    </div>
                    <div class="col-md-6">
                        <div>
                            <img src="img/posts/<?php echo $p_thumbnail;?>" width="400px">
                        </div>
                        <div class="form-group">
                            <label>Select Post Thumbnail</label>
                            <input type="file" name="thumbnail">
                        </div> 

                    <div class="form-group">
                        <span style="">Select Category</span>
                        <div class="form-check" style="margin-top: 30px;">

<?php 

$sql = "SELECT * FROM category";
$result = mysqli_query($db,$sql);
while ($row = mysqli_fetch_assoc($result)) {
$cat_id         = $row['c_id'];
$cat_name       = $row['c_name'];
$cat_desc       = $row['c_desc'];
?>

<label class="form-check-label">
<input class="form-check-input" name="category" type="checkbox" value="<?php echo $cat_id;?>" <?php if($cat_id == $p_cat){echo "checked";}?>> <?php echo $cat_name;?>
</label><br>


<?php
}

?>

                            
                        </div>
                    </div>

                    <div class="form-group">
                        <span>Current Status</span>
                        <select class="form-control" name="status">
                            <option value="0" 
                            <?php 
                            if($p_status == 0){
                                echo "selected";}?>>Pending</option>
                            <option value="1" <?php if($p_status == 1){echo "selected";}?>>Active</option>
                        </select>
                    </div>
                          
                          <input type="hidden" name="post_id" value="<?php echo $edit_post;?>">
                          <button type="submit" class="btn btn-danger" name="editpost">Publish</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


                            <?php 
                        }

                        }else if($do == 'update'){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $title          = $_POST['title'];
            $post_id        = $_POST['post_id'];
            $description    = $_POST['description'];
            $category       = $_POST['category'];
            $status         = $_POST['status'];
            // post img
            $file_name      = $_FILES['thumbnail']['name'];
            $file_tmp       = $_FILES['thumbnail']['tmp_name'];

            if(!empty($file_name)){

                $extn = strtolower(end(explode('.', $_FILES['thumbnail']['name'])));
                // universal image type array
                $extensions = array("jpeg","png","jpg");

                if(in_array($extn, $extensions) === false){
                    // this file doesnot contain an image
                    echo '<div class="alert alert-danger">Please Select an Image file!</div>';
                }else{
                    $random     = rand();
                    $updateName = $random."_".$file_name;

                    move_uploaded_file($file_tmp, "img/posts/".$updateName);

                    $query = "UPDATE posts SET p_title='$title', p_desc='$description', p_cat='$category', p_thumbnail='$updateName', p_status='$status' WHERE p_id='$post_id'";
                    $result = mysqli_query($db,$query);
                    if($result){
                        header('Location: posts.php');
                    }else{
                        die("Insert Post Error!".mysqli_error($db));
                    }

                }

            }else{
                $query = "UPDATE posts SET   p_title='$title', p_desc='$description',p_cat='$category', p_status='$status' WHERE p_id='$post_id'";
                    $result = mysqli_query($db,$query);
                    if($result){
                        header('Location: posts.php');
                    }else{
                        die("Insert Post Error!".mysqli_error($db));
                    }
            }

        }

                        }elseif ($do == 'delete') {
                            // post delete from here

                            if(isset($_GET['deleteId'])){
                                $delete_post_id = $_GET['deleteId'];
                                // delete post images
                                // image delete first
                                    $sql = "SELECT p_thumbnail FROM posts WHERE p_id = '$delete_post_id'";

                                    $result = mysqli_query($db,$sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $photo = $row['p_thumbnail'];
                                    }

                                    // delete photo
                                    unlink("img/posts/".$photo);


                                $table = 'posts';
                                $table_id = 'p_id';
                                $item_id = $delete_post_id;
                                $url = 'posts.php';

                                delete($table,$table_id,$item_id,$url);
                            }
                        }


                        ?>
                        
                    </div>
                </main>

<?php 
	include "inc/footer.php";
?>