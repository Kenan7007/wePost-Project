<?php
session_start();
    include ('include/header.php');
    include ('include/connection.php');
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
                    if(isset($id)){
                        $query = "DELETE FROM posts WHERE id='$id'";
                        $delete = mysqli_query($conn,$query);
                        if(isset($delete)){
                            echo "<div class='alert alert-success'>"."Article Deleted Successfully"."</div>";
                        }
                        else{
                            echo "<div class='alert alert-danger'>"."Something Went Wrong"."</div>";
                        }
                    }
                    ?>

                    <table class="table table-bordered">
                        <tr>
                            <th>Article Number</th>
                            <th>Article Title</th>
                            <th>Author Name</th>
                            <th>Category</th>
                            <th>Article Image</th>
                            <th>Post-Date</th>
                        </tr>
                        <?php
                        $query = "SELECT * FROM posts ORDER BY id DESC";
                        $res = mysqli_query($conn,$query);
                        $n = 0;
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
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include ('include/footer.php');
?>