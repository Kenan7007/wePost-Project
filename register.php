<?php
session_start();

include ('include/header.php');
include ('include/connection.php');

if(isset($_POST['name'])){
    $Name = $_POST['name'];
    $Mail = $_POST['email'];
    $Pass = $_POST['password'];
    $CPass = $_POST['cpassword'];
    $join = $_POST['join'];
}

$person = $_SESSION['prs'];

?>



    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2" id="side-area">
                    <h4>Control Panel</h4>
                    <ul>
                        <li>
                            <a href="allCtg.php">
                                <span><i class="fas fa-tags"></i></span>
                                <span>Categories</span>
                            </a>
                        </li>
                        <?php
                        if($person == "author"){
                            ?>
                            <li>
                                <a href="allAuthorsA.php">
                                    <span><i class="fas fa-th-large"></i></span>
                                    <span>Author's Ranking</span>
                                </a>
                            </li>
                            <?php
                        }else{
                            ?>
                            <li>
                                <a href="allUsersU.php">
                                    <span><i class="fas fa-users"></i></span>
                                    <span>User's Ranking</span>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                        <li data-bs-toggle="collapse" data-bs-target="#menu">
                            <a href="#">
                                <span><i class="far fa-newspaper"></i></span>
                                <span>Articles</span>
                            </a>
                        </li>
                        <ul class="collapse" id="menu">
                            <li>
                                <a href="addArticle.php">
                                    <span><i class="far fa-edit"></i></span>
                                    <span>New Article</span>
                                </a>
                            </li>

                            <li>
                                <a href="allArticles.php">
                                    <span><i class="fas fa-th-large"></i></span>
                                    <span>All Articles</span>
                                </a>
                            </li>
                        </ul>
                        <li>
                            <a href="index.php" target="_blank">
                                <span><i class="fas fa-window-restore"></i></span>
                                <span>Back to wePost</span>
                            </a>
                        </li>

                        <li>
                            <a href="logout.php">
                                <span><i class="fas fa-sign-out-alt"></i></span>
                                <span>Login</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-10" id="main-aria">
                    <label><b><i>Welcome To wePost.. To become a member of our family please Register here..</i></b></label>

                    <div class="display-posts mt-4">
                        <div class = 'register'>
                            <?php
                            if(isset($join)){
                                $query = "SELECT * FROM user WHERE email='$Mail'";
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
                                    $query2 = "INSERT INTO user(name,email,password) VALUES('$Name','$Mail','$Pass')";
                                    $res = mysqli_query($conn,$query2);
                                    if(isset($res)){
                                        echo "<div class='alert alert-success'>"."Success!\n Congratulations ".$Name.".. Now you can share your ideas and write articles with us as a registered user by e-mail(".$Mail.")"."</div>";
                                        $_SESSION['name']= $Name;
                                        $_SESSION['prs'] = "user";
                                        header('REFRESH:5;URL=index.php');
                                    }else{
                                        echo "<div class='alert alert-danger'>"."Something Went Wrong!"."</div>";
                                    }
                                }
                            }
                            ?>
                           <a href="login.php"><button class="btn-custom3">Login To My Account</button></a>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <div>
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control" id="mail" name="name">
                                </div>
                                <label class="line"> _______________________________________________________________________________________________________________________________________ </label>
                                <div>
                                    <label for="mail">Email Address</label>
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

                                <button class="btn-custom3" name="join">JOIN US</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include ('include/footer.php');
?>