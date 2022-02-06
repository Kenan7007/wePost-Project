<?php
session_start();
include ('public/header.php');
include ('include/connection.php');
$nameUSR = $_SESSION['name'];
?>
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <?php
                    $id = $_GET['id'];
                    $query = "SELECT * FROM posts WHERE id ='$id'";
                    $result = mysqli_query($conn,$query);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <div class="post">
                        <div class="post-image">
                            <img src="uploads/postImages/<?php echo $row['postImg'];?>">
                        </div>
                        <div class="post-title">
                            <h4><?php echo $row['postTitle']; ?></h4>
                        </div>
                        <div class="post-details">
                            <p class="post-info">
                                <span><i class="fas fa-user"></i><?php echo $row['postAuthor']; ?></span>
                                <span><i class="far fa-calendar-alt"></i><?php echo $row['postDate']; ?></span>
                                <span><i class="fas fa-tags"></i><?php echo $row['postCategory']; ?></span>
                            </p>
                            <p class="postContent">
                                <?php echo $row['postContent']; ?>
                            </p>
                        </div>
                        <a href="editPost.php?id=<?php echo $row['id']; ?>"><button class="btn-custom4">Edit</button></a>
                    </div>
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
include('public/footer.php')
?>