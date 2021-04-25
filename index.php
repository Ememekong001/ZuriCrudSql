<?php
include("action.php");
if(!isset($_SESSION["email"])){
    header("location:./login.php");
}
$email = $_SESSION["email"] ;

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css"/>
        <title>Dashboard | CRUD</title>
        <link rel="shortcut icon" href="./img/app3.jpg"/>
        <link rel="stylesheet" href="./css/style.css"/>
    </head>
    <body>
        <!--Navbar-->
  	    <nav>
    	    <ul class="nav-ul">
     	 	    <li class="nav-li">
	        	    <img src="img/app3.jpg" class="nav-img"/>
	    	    </li>
	      	    <li class="nav-li quiz-title">CRUD</li>
    	  	    <li class="nav-li right">
                  <a style="float:right;color:white;" href="logout.php"><i class="fa fa-sign-out"></i>Logout</a>
      		    </li>
    	    </ul>
	    </nav>
	    <br/>
        <div class="main">
            <span align="left">Dashboard/<a style="color:blue;cursor:pointer;">Courses</a></span>
            <br/>
            <br/>
        <div class="row">
            <div class="col-sm-8">
                    <h5><b>Courses</b></h5>
                <table class="table table-striped table-responsive table-hover" style="width: 100%;">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Course Code</td>
                            <td>Course Title</td>
                            <td>Credit units</td>
                            <td colspan="2">
                                <center>Action</center>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cnt = 0;
                        $q1 = mysqli_query($db, "SELECT * FROM courses ORDER BY id DESC");
                        while ($r1 = mysqli_fetch_array($q1)) {
                            $cnt++;
                            $id =$r1["id"];
                            $course_code =$r1["course_code"];
                            $title = $r1["title"];
                            $credit_unit = $r1["credit_unit"];
                        ?>
                        <tr>
                            <td><?php echo $cnt; ?></td>
                            <td><?php echo $course_code; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $credit_unit; ?></td>
                            <td>
                                <a href="index.php?edit_course=<?php echo $id; ?>">
                                    <i class="fa fa-edit" style="color:blue;"></i>
                                </a>
                            </td>
                            <td>
                                <a href="action.php?delete_course=<?php echo $id; ?>">
                                    <i class="fa fa-trash" style="color:red;"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                        }
                        if (mysqli_num_rows($q1) == 0) {
                        ?>
                        <tr>
                            <td colspan="4">
                                <center> 
                                    No courses added yet
                                </center>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-4">
                <?php
                if (isset($_GET["edit_course"])) {
                    $id = $_GET["edit_course"];
                    $q2 = mysqli_query($db, "SELECT * FROM courses WHERE id = '$id' ");
                    while ($r2 = mysqli_fetch_array($q2)) {
                ?>
                <center>
                    <h5>Edit Course</h5>
                </center>
                <form method="POST" action="">
                    <input type="hidden" name="id" value="<?php echo $id;?>"/>
                    <div class="form-group">
                        <label for="course_code">Course Code</label>
                        <input class="form-control form-control-md" value="<?php echo $r2["course_code"];?>" type="text" name="course_code" placeholder="Enter Course Code"/>
                    </div>
                    <div class="form-group">
                        <label for="title">Course Title</label>
                        <input class="form-control form-control-md" value="<?php echo $r2["title"];?>" type="text" name="title" placeholder="Enter Course Title"/>
                    </div>
                    <div class="form-group">
                        <label for="course_code">Course Credit Units</label>
                        <input class="form-control form-control-md" value="<?php echo $r2["credit_unit"];?>" type="number" name="credit_units" placeholder="Enter no of Credit units"/>
                    </div>
                    
                    <div class="form-group">
                        <button class="btn btn-md btn-success" type="submit" name="update_course">Update Course</button>
                    </div>
                </form>

                <?php
                    }
                } 
                else {
               ?>
                <center>
                    <h5>Add Courses</h5>
                </center>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="course_code">Course Code</label>
                        <input class="form-control form-control-md" type="text" name="course_code" placeholder="Enter Course Code"/>
                    </div>
                    <div class="form-group">
                        <label for="title">Course Title</label>
                        <input class="form-control form-control-md" type="text" name="title" placeholder="Enter Course Title"/>
                    </div>
                    <div class="form-group">
                        <label for="course_code">Course Credit Units</label>
                        <input class="form-control form-control-md" type="number" name="credit_units" placeholder="Enter no of Credit units"/>
                    </div>
                    <?php
                    if($success) {
                    ?>
                    <center>
                        <span class="text text-success">New course added</span>
                    </center>
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <button class="btn btn-md btn-primary" type="submit" name="add_course">Add Course</button>
                    </div>
                </form>
                <?php
                }
                ?>
            </div>
        </div>   
        </div>

        
        
    
    </body>
</html>