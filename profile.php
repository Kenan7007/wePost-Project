<?php
session_start();
include ('include/connection.php');
include ('public/header.php');

$nameUSR = $_SESSION['name'];
$person = $_SESSION['prs'];

    $change1 = $_POST['change1'];
    $change2 = $_POST['change2'];
    $save1 = $_POST['save1'];
    $save2 = $_POST['save2'];
    $Email = $_POST['email'];
    $Pass = $_POST['password'];
    $CPass = $_POST['current-password'];


if(!isset($nameUSR)) {
    echo "<div class='alert alert-danger'>" . "You must login/register to get a wePost profile! ..." . "</div>";
    header('REFRESH:3;URL=register.php');
}
else {
    if ($person == "author") {
        $query = "SELECT * FROM author WHERE name='$nameUSR'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        ?>
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="change">
                             <div class="profile">
                                <?php
                                if(isset($row)){
                                    ?>
                                    &nbsp &nbsp <a href="myPosts.php"><button class="btn-custom2" name="mine">View My Posts</button></a>
                                    <form action="<?php $_SERVER['PHP_SELF'];?>" class="form-control" method="post" enctype="multipart/form-data">

                                        <label for="id">ID:</label>
                                        <input type="text" id="id" name="id" value="<?php echo $row['id']; ?>" readonly class="form-control"><br>

                                        <label for="fname">Full name:</label>
                                        <input type="text" id="fname" name="fname" value="<?php echo $row['name']; ?>" readonly class="form-control"><br>

                                        <label for="email">Email:</label>
                                        <input type="text" id="email" name="emaill" value="<?php echo $row['email']; ?>" readonly class="form-control"><br>

                                        <label for="pass">Current Password:</label>
                                        <input type="text" id="password" name="passwordd" value="<?php echo $row['password']; ?>" readonly class="form-control"><br>

                                        <button class="btn-custom2" name="change1">Change E-mail</button>
                                        <button class="btn-custom2" name="change2">Change Password</button>
                                    </form>
                                    <?php
                                }

                                ?>
                            </div>
                            <?php
                            if(isset($change1)){
                                ?>
                                <form class="form-control" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                    <label for="current-email">Current Email:</label>
                                    <input type="text" id="current-email" name="current-email" value="<?php echo $row['email']; ?>" readonly class="form-control"><br>

                                    <label for="email">New Email:</label>
                                    <input type="text" id="email" name="email" class="form-control"><br>

                                    <button class="btn-custom2" name="save1">Save</button>
                                </form>
                                <?php
                            }elseif (isset($change2)){
                                ?>
                                <form class="form-control" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                    <label for="current-password">Current Password:</label>
                                    <input type="text" id="current-password" name="current-password" value="<?php echo $row['password']; ?>" readonly class="form-control"><br>

                                    <label for="password">New Password:</label>
                                    <input type="text" id="password" name="password" class="form-control"><br>

                                    <button class="btn-custom2" name="save2">Save</button>
                                </form>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                        if(isset($save1)){
                            $query2 ="SELECT * FROM author WHERE email='$Email'";
                            $rse2 = mysqli_query($conn,$query2);
                            $row2 = mysqli_fetch_row($rse2);

                            if(isset($row2)){
                                echo "<div class='alert alert-danger'>"."Email is already existed!"."</div>";
                            }elseif (empty($Email)){
                                echo "<div class='alert alert-danger'>"."Please fill the field!"."</div>";
                            }
                            else{
                                $query = "UPDATE author SET email='$Email' WHERE name='$nameUSR'";
                                $rst = mysqli_query($conn,$query);
                                echo "<div class='alert alert-success'>"."Done!..<br>Your Email is Updated.."."</div>";
                              //  header('REFRESH:2;URL=profile.php');
                                ?>
                                <script>location.replace("profile.php"); </script>
                                <?php
                            }
                        }
                        if(isset($save2)){
                            if (empty($Pass)){
                                echo "<div class='alert alert-danger'>"."Please fill the field!"."</div>";
                                header('REFRESH:2;URL=profile.php');
                            }elseif ($Pass == $CPass){
                                echo "<div class='alert alert-info'>"."Same Password !"."</div>";
                                header('REFRESH:2;URL=profile.php');
                            }
                            else{
                                $query = "UPDATE author SET password='$Pass' WHERE name='$nameUSR'";
                                $rst = mysqli_query($conn,$query);
                                echo "<div class='alert alert-success'>"."Done!..<br>Your Password is Updated.."."</div>";
                                header('REFRESH:2;URL=profile.php');
                                ?>
                                <!-- <script>location.replace("profile.php"); </script> -->
                                <?php
                            }
                        }

                        ?>
                    </div>
                    <div class="col-md-3">
                        <!-- categories -->
                        <div class="categories">
                            <h4>Categories</h4>
                            <ul>
                                <?php
                                $query = "SELECT * FROM categories ORDER BY id DESC";
                                $result = mysqli_query($conn,$query);
                                while ($row = mysqli_fetch_assoc($result)){
                                    ?>
                                    <li>
                                        <a href="category.php?name=<?php echo $row['categoryName']; ?>">
                                            <span><i class="fas fa-tags"></i></span>
                                            <span><?php echo $row['categoryName'];?></span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <!-- End categories -->

                        <!-- Start Latest Posts -->
                        <div class="last-posts">
                            <h4>Recently Published</h4>
                            <ul>
                                <?php
                                $query = "SELECT * FROM posts ORDER BY id DESC LIMIT 4";
                                $res = mysqli_query($conn, $query);
                                while($row = mysqli_fetch_assoc($res)){
                                    ?>
                                    <li>
                                        <a href="post.php?id=<?php echo $row['id'];?>">
                                            <span class="span-image"><img src="uploads/postImages/<?php echo $row['postImg'];?>" alt=""></span>
                                            <span><?php echo $row['postTitle'];?></span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <!-- End Latest Posts -->
                        <a href="allCtg.php"><button class="btn btn-custom2">View Categories</button></a>
                        <a href="allArticles.php"><button class="btn btn-custom2">View All Articles</button></a>
                        <a href="index.php"><button class="btn btn-custom2"><i>wePost --></i></button></a>

                    </div>
                </div>
            </div>
        </div>
        <!-- End content -->
    <?php
    } else {
        $query = "SELECT * FROM user WHERE name='$nameUSR'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        ?>
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="change">
                            <div class="profile">

                                <?php
                                if(isset($row)){
                                    ?>
                                    &nbsp &nbsp <a href="myPosts.php"><button class="btn-custom2" name="mine">View My Posts</button></a>
                                    <form action="<?php $_SERVER['PHP_SELF'];?>" class="form-control" method="post" enctype="multipart/form-data">

                                        <label for="id">ID:</label>
                                        <input type="text" id="id" name="id" value="<?php echo $row['id']; ?>" readonly class="form-control"><br>

                                        <label for="fname">Full name:</label>
                                        <input type="text" id="fname" name="fname" value="<?php echo $row['name']; ?>" readonly class="form-control"><br>

                                        <label for="email">Email:</label>
                                        <input type="text" id="email" name="emaill" value="<?php echo $row['email']; ?>" readonly class="form-control"><br>

                                        <label for="pass">Current Password:</label>
                                        <input type="text" id="password" name="passwordd" value="<?php echo $row['password']; ?>" readonly class="form-control"><br>


                                        <button class="btn-custom2" name="change1">Change E-mail</button>
                                        <button class="btn-custom2" name="change2">Change Password</button>
                                    </form>

                                    <?php
                                }
                                ?>
                            </div>
                             <?php
                             if(isset($change1)){
                                ?>
                                 <form class="form-control" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                     <label for="current-email">Current Email:</label>
                                     <input type="text" id="current-email" name="current-email" value="<?php echo $row['email']; ?>" readonly class="form-control"><br>

                                     <label for="email">New Email:</label>
                                     <input type="text" id="email" name="email" class="form-control"><br>

                                     <button class="btn-custom2" name="save1">Save</button>
                                 </form>
                                <?php
                            }elseif (isset($change2)){
                                 ?>
                                 <form class="form-control" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                     <label for="current-password">Current Password:</label>
                                     <input type="text" id="current-password" name="current-password" value="<?php echo $row['password']; ?>" readonly class="form-control"><br>

                                     <label for="password">New Password:</label>
                                     <input type="text" id="password" name="password" class="form-control"><br>

                                     <button class="btn-custom2" name="save2">Save</button>
                                 </form>
                                 <?php
                             }
                             ?>
                        </div>
                        <?php

                        if(isset($save1)){
                            $query2 ="SELECT * FROM user WHERE email='$Email'";
                            $rse2 = mysqli_query($conn,$query2);
                            $row2 = mysqli_fetch_row($rse2);

                            if(isset($row2)){
                                echo "<div class='alert alert-danger'>"."Email is already existed!"."</div>";
                            }elseif (empty($Email)){
                                echo "<div class='alert alert-danger'>"."Please fill the field!"."</div>";
                                //header('REFRESH:2;URL=profile.php');
                                ?>
                                <script>location.replace("profile.php"); </script>
                                <?php
                            }
                            else{
                                $query = "UPDATE user SET email='$Email' WHERE name='$nameUSR'";
                                $rst = mysqli_query($conn,$query);

                                echo "<div class='alert alert-success'>"."Done!..<br>Your Email is Updated.."."</div>";
                              //  header('REFRESH:2;URL=profile.php');
                                 ?>
                                 <script>location.replace("profile.php"); </script>
                                <?php
                            }
                        }
                        if(isset($save2)){
                            if (empty($Pass)){
                                echo "<div class='alert alert-danger'>"."Please fill the field!"."</div>";
                                header('REFRESH:2;URL=profile.php');
                            }elseif ($Pass == $CPass){
                                echo "<div class='alert alert-info'>"."Same Password !"."</div>";
                                header('REFRESH:2;URL=profile.php');
                            }
                            else{
                                $query = "UPDATE user SET password='$Pass' WHERE name='$nameUSR'";
                                $rst = mysqli_query($conn,$query);
                                echo "<div class='alert alert-success'>"."Done!..<br>Your Password is Updated.."."</div>";
                               // header('REFRESH:2;URL=profile.php');
                                ?>
                                <script>location.replace("profile.php"); </script>
                                <?php
                            }
                        }
                        ?>
                       </div>
                    <div class="col-md-3">
                        <!-- categories -->
                        <div class="categories">
                            <h4>Categories</h4>
                            <ul>
                                <?php
                                $query = "SELECT * FROM categories ORDER BY id DESC";
                                $result = mysqli_query($conn,$query);
                                while ($row = mysqli_fetch_assoc($result)){
                                    ?>
                                    <li>
                                        <a href="category.php?name=<?php echo $row['categoryName']; ?>">
                                            <span><i class="fas fa-tags"></i></span>
                                            <span><?php echo $row['categoryName'];?></span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <!-- End categories -->

                        <!-- Start Latest Posts -->
                        <div class="last-posts">
                            <h4>Recently Published</h4>
                            <ul>
                                <?php
                                $query = "SELECT * FROM posts ORDER BY id DESC LIMIT 4";
                                $res = mysqli_query($conn, $query);
                                while($row = mysqli_fetch_assoc($res)){
                                    ?>
                                    <li>
                                        <a href="post.php?id=<?php echo $row['id'];?>">
                                            <span class="span-image"><img src="uploads/postImages/<?php echo $row['postImg'];?>" alt=""></span>
                                            <span><?php echo $row['postTitle'];?></span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <!-- End Latest Posts -->
                        <a href="allCtg.php"><button class="btn btn-custom2">View Categories</button></a>
                        <a href="allArticles.php"><button class="btn btn-custom2">View All Articles</button></a>
                        <a href="index.php"><button class="btn btn-custom2"><i>wePost --></i></button></a>

                    </div>
                </div>
            </div>
        </div>
        <!-- End content -->
   <?php
    }
    ?>


    <?php
}
?>
    <?php
    include('public/footer.php')
    ?>



