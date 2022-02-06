<?php
    session_start();
        include ('include/header.php');
        include ('include/connection.php');
if (isset($_GET['id'])){
    $id = $_GET['id'];
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
                <label><b><i>All Articles</i></b></label>
                <!-- Display All Articles -->
                <div class="display-posts mt-4">
                    <?php
                    $query = "SELECT * FROM posts ORDER BY id DESC";
                    $res = mysqli_query($conn,$query);
                    $n = 0;
                    ?>
                    <table class="table table-bordered">
                        <tr>
                            <th>Article Number</th>
                            <th>Article Title</th>
                            <th>Author Name</th>
                            <th>Category</th>
                            <th>Article Image</th>
                            <th>Post-Date</th>
                            <th>Delete Article</th>
                        </tr>
                        <?php

                        while ($row = mysqli_fetch_assoc($res)){
                            $n++;
                            ?>
                            <tr>
                                <td><?php echo $n; ?></td>
                                <td><a href="post.php?id=<?php echo $row['id'];?>"><?php echo $row['postTitle']; ?></a></td>
                                <td><?php echo $row['postAuthor']; ?></td>
                                <td><?php echo $row['postCategory']; ?></td>
                                <td><img src="uploads/postImages/<?php echo $row['postImg']; ?>" width="70px" height="50px"></td>
                                <td><?php echo $row['postDate']; ?></td>
                                <td><a href="allPosts.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete Article { <?php echo $row['postTitle']; ?> } ?')"><button class="btn-custom">Delete</button></a></td>
                            </tr>

                            <?php
                        }
                        ?>
                    </table>
                    <?php
                    if(isset($id)){
                        $queryN = "SELECT * FROM posts WHERE id='$id'";
                        $resN = mysqli_query($conn,$queryN);
                        $rowN = mysqli_fetch_assoc($resN);
                        if(isset($rowN)){
                          $nm = $rowN['postAuthor'];
                        }

                        $queryA = "SELECT * FROM author WHERE name='$nm'";
                        $resA = mysqli_query($conn,$queryA);
                        $rowA = mysqli_fetch_assoc($resA);
                        if(isset($rowA)){
                            $pp = $rowA['published_posts'];
                        }else{
                            $queryU = "SELECT * FROM user WHERE name='$nm'";
                            $resU = mysqli_query($conn,$queryU);
                            $rowU = mysqli_fetch_assoc($resU);
                            if (isset($rowU)){
                                $pp = $rowU['publishedPosts'];
                            }
                        }

                        $query = "DELETE FROM posts WHERE id='$id'";
                        $delete = mysqli_query($conn,$query);
                        if(isset($delete)){
                            echo "<div class='alert alert-success'>"."Article Deleted Successfully"."</div>";

                            if (isset($rowA)){
                                $ppN = $pp-1;
                                $queryAA = "UPDATE author SET published_posts = '$ppN' WHERE name='$nm' ";
                                $resAA = mysqli_query($conn,$queryAA);
                            }elseif (isset($rowU)){
                                $ppN = $pp-1;
                                $queryUU = "UPDATE user SET publishedPosts = '$ppN' WHERE name='$nm'";
                                $resUU = mysqli_query($conn,$queryUU);
                            }


                        }
                        else{
                            echo "<div class='alert alert-danger'>"."Something Went Wrong"."</div>";
                        }
                    }
                    ?>
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