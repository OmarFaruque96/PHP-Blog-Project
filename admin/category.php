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
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header"><h5>View All Categories</h5></div>
                                    <div class="card-body">
                                        

                                    	<table class="table table-bordered">
										    <thead>
										      <tr>
										        <th>Serial</th>
										        <th>Name</th>
										        <th>Description</th>
										        <th>Action</th>
										      </tr>
										    </thead>
										    <tbody>

				    	<?php 

				    		// read info from database
				    		// 3 step (query, query->database, value ->accept)

				    	$query  = "SELECT * FROM category";
				    	$result = mysqli_query($db,$query);
				    	$i=0;
				    	while($row = mysqli_fetch_assoc($result)){
				    		$cat_id  		= $row['c_id'];
				    		$cat_name 		= $row['c_name'];
				    		$cat_desc 		= $row['c_desc'];
				    		$i++;
				    		?>
				    		<tr>
						        <td><?php echo $i;?></td>
						        <td><?php echo $cat_name; ?></td>
						        <td><?php echo $cat_desc;?></td>
						        <td>
						        	<!-- edit button -->
						        	<a href="category.php?editId=<?php echo $cat_id;?>"><i class="fa fa-edit"></i></a>
						        	<!-- delete button -->
						        	<a href="category.php?deleteId=<?php echo $cat_id;?>"><i class="fa fa-trash"></i></a>
						        </td>
						    </tr>
						<?php
				    	}


				    	?>



										      
										      
										    </tbody>
										  </table>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="card">
                                    <div class="card-header"><h5>Add New Category</h5></div>
                                    <div class="card-body ">
                                        
                                    	<form method="POST">
                                    		<div class="form-group">
                                    			<label>Category Name</label>
                                    			<input type="text" name="name" placeholder="Enter a Name*" class="form-control">
                                    		</div>
                                    		<div class="form-group">
                                    			<label>Category Description</label>
                                    			<input type="text" name="desc" placeholder="Description*" class="form-control">
                                    		</div>
                                    		<input type="submit" class="btn btn-md btn-danger" name="submit" value="Confirm">
                                    	</form>

                                    	<?php 

                                    		if(isset($_POST['submit'])){
                                    			$c_name = $_POST['name'];
                                    			$c_desc = $_POST['desc'];

                                    			// 
                                    			if(empty($c_name) || empty($c_desc)){
                                    				echo "<span class='alert alert-danger'>Please Fill All the Information</span>";
                                    			}else{
                                    				// query, q->db, 
                                    				$query = "INSERT INTO category(c_name,c_desc) VALUES ('$c_name','$c_desc')";
                                    				$result = mysqli_query($db,$query);

                                    				if($result){
                                    					header('Location: category.php');
                                    				}else{
                                    					die("Insert Category Error!".mysqli_error($db));
                                    				}
                                    			}

                                    		}

                                    	?>

                                    </div>
                                </div>

                                <!-- edit category -->
        <?php 

        	if(isset($_GET['editId'])){
        		$edit_id = $_GET['editId'];

        		// read from database
        		$query  = "SELECT * FROM category WHERE c_id='$edit_id'";
        		$result = mysqli_query($db,$query);

        		while($row = mysqli_fetch_assoc($result)){
		    		$cat_name 		= $row['c_name'];
		    		$cat_desc 		= $row['c_desc'];
				}

				?>

				<div class="card">
					<div class="card-header">
						<h3>Edit Information</h3>
					</div>
					<div class="card-body">
						<form method="POST">
                    		<div class="form-group">
                    			<label>Category Name</label>
                    			<input type="text" name="e_name" placeholder="Enter a Name*" value="<?php echo $cat_name;?>" class="form-control">
                    		</div>
                    		<div class="form-group">
                    			<label>Category Description</label>
                    			<input type="text" name="e_desc" placeholder="Description*" value="<?php echo $cat_desc;?>" class="form-control">
                    		</div>
                    		<input type="submit" class="btn btn-md btn-danger" name="edit" value="Confirm">
                    	</form>

                    	<!-- update -->

                    	<?php 

                    		if(isset($_POST['edit'])){
                    			$e_name = $_POST['e_name'];
                    			$e_desc = $_POST['e_desc'];

                    			// 3 step 

                    			$query = "UPDATE category SET c_name='$e_name', c_desc='$e_desc' WHERE c_id = '$edit_id'";
                    			$result = mysqli_query($db,$query);
                    			if($result){
                					header('Location: category.php');
                				}else{
                					die("Update Category Error!".mysqli_error($db));
                				}

                    		}

                    	?>

					</div>
				</div>



				<?php
			}
        ?>


                            </div>
                        </div>
                        
                    </div>
                </main>


                <!-- delete category item -->
                <?php 

                	if(isset($_GET['deleteId'])){

                		$delete_item = $_GET['deleteId'];
                		
                		$table = 'category';
						$table_id = 'c_id';
						$item_id = $delete_item;
						$url = 'category.php';

                		delete($table,$table_id,$item_id,$url);

                	}

                ?>




<?php 
	include "inc/footer.php";
?>