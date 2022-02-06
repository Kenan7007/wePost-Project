<?php
session_start();
include ('include/header.php');
include ('include/connection.php');

if (isset($_GET['id'])){
    $id = $_GET['id'];
}
if(isset($_POST['name'])){
    $Name = $_POST['name'];
    $Mail = $_POST['email'];
    $Pass = $_POST['password'];
    $CPass = $_POST['cpassword'];
    $add = $_POST['add'];
}

if(!isset($_SESSION['id'])) {
    echo "<div class='alert alert-danger'>" . "You need authentication to get to this page!" . "</div>";
    header('REFRESH:3;URL=login.php');
}
else{

?>



<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-area">
                <h4>Control Panel</h4>
                <ul>
                    <li>
                        <a href="categories.php">
                            <span><i class="fas fa-tags"></i></span>
                            <span>Categories</span>
                        </a>
                    </li>

                    <li data-bs-toggle="collapse" data-bs-target="#menu">
                        <a href="#">
                            <span><i class="far fa-newspaper"></i></span>
                            <span>Articles</span>
                        </a>
                    </li>
                    <ul class="collapse" id="menu">
                        <li>
                            <a href="newPost.php">
                                <span><i class="far fa-edit"></i></span>
                                <span>New Article</span>
                            </a>
                        </li>

                        <li>
                            <a href="allPosts.php">
                                <span><i class="fas fa-th-large"></i></span>
                                <span>All Articles</span>
                            </a>
                        </li>
                    </ul>
                    <li>
                        <a href="indexADM.php" target="_blank">
                            <span><i class="fas fa-window-restore"></i></span>
                            <span>View wePost</span>
                        </a>
                    </li>

                    <li data-bs-toggle="collapse" data-bs-target="#menu1">
                        <a href="#">
                            <span><i class="fas fa-users-cog"></i></span>
                            <span>Authors & Users</span>
                        </a>
                    </li>
                    <ul class="collapse" id="menu1">
                        <li>
                            <a href="newAuthor.php">
                                <span><i class="far fa-edit"></i></span>
                                <span>Add New Author</span>
                            </a>
                        </li>

                        <li>
                            <a href="allAuthors.php">
                                <span><i class="fas fa-th-large"></i></span>
                                <span>Author's Ranking</span>
                            </a>
                        </li>

                        <li>
                            <a href="allUsers.php">
                                <span><i class="fas fa-users"></i></span>
                                <span>User's Ranking</span>
                            </a>
                        </li>
                    </ul>

                    <li>
                        <a href="logout.php">
                            <span><i class="fas fa-sign-out-alt"></i></span>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10" id="main-aria">
                <label><b><i>Add an Author</i></b></label>

                <div class="display-posts mt-4">
                    <div class = new-author>
                        <?php
                            if(isset($add)){
                                $query = "SELECT * FROM author WHERE email='$Mail'";
                                $rst = mysqli_query($conn,$query);
                                $row = mysqli_fetch_row($rst);

                                if(empty($Name)||empty($Mail)||empty($Pass)||empty($CPass)){
                                    echo "<div class='alert alert-danger'>"."Please fill all fields below!"."</div>";
                                }
                                elseif ($Pass !== $CPass){
                                    echo "<div class='alert alert-danger'>"."Your password confirmation is not identical"."</div>";
                                }
                                elseif (isset($row)){
                                    echo "<div class='alert alert-danger'>"."The E-mail is already exist"."</div>";
                                }
                                else{
                                    $query2 = "INSERT INTO author(name,email,password) VALUES('$Name','$Mail','$Pass')";
                                    $res = mysqli_query($conn,$query2);
                                    if(isset($res)){
                                        echo "<div class='alert alert-success'>"."Author Added Successfully! .."."</div>";
                                        ?>
                                        <script> location.replace("allAuthors.php"); </script>
                                        <?php
                                    }
                                    else{
                                        echo "<div class='alert alert-danger'>"."Something Went Wrong!"."</div>";
                                    }
                                }
                            }
                        ?>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div>
                            <label for="name">Author Full Name</label>
                            <input type="text" class="form-control" id="mail" name="name">
                        </div>
                        <label class="line"> _______________________________________________________________________________________________________________________________________ </label>
                        <div>
                            <label for="mail">Email</label>
                            <input type="text" class="form-control" id="mail" name="email">
                        </div>
                        <label class="line"> _______________________________________________________________________________________________________________________________________ </label>
                        <div>
                            <label for="pass">Password</label>
                            <input type="text" class="form-control" id="pass" name="password">
                        </div>
                        <label class="line"> _______________________________________________________________________________________________________________________________________ </label>
                        <div>
                            <label for="cpass">Confirm Password</label>
                            <input type="text" class="form-control" id="pass" name="cpassword">
                        </div>

                        <button class="btn-custom3" name="add">ADD To Authors List</button>
                    </form>
                    </div>
            </div>
            </div>
        </div>
    </div>
</div>

    <?php
}
?>
<?php
include ('include/footer.php');
?>