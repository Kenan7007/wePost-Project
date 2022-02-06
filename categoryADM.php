<?php
include ('public/headerADM.php');
include ('include/connection.php');

?>
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <?php
                    $name = $_GET['name'];
                    $query = "SELECT * FROM posts WHERE postCategory='$name' ORDER BY id DESC";
                    $result = mysqli_query($conn,$query);
                    while ($row = mysqli_fetch_assoc($result)){
                        ?>
                        <div class="post">
                            <div class="post-image">
                                <a href="postADM.php?id=<?php echo $row['id'];?>"><img src="uploads/postImages/<?php echo $row['postImg'];?>"></a>
                            </div>
                            <div class="post-title">
                                <h4><a href="postADM.php?id=<?php echo $row['id'];?>"><?php echo $row['postTitle']; ?></a></h4>
                            </div>
                            <div class="post-details">
                                <p class="post-info">
                                    <span><i class="fas fa-user"></i><?php echo $row['postAuthor']; ?></span>
                                    <span><i class="far fa-calendar-alt"></i><?php echo $row['postDate']; ?></span>
                                    <span><i class="fas fa-tags"></i><?php echo $row['postCategory']; ?></span>
                                </p>
                                <p class="postContent">
                                    <?php
                                    $postCnt = $row['postContent'];
                                    if (strlen($postCnt)>150){
                                        $postCnt = substr($postCnt,0,300)."...";
                                    }
                                    echo $postCnt;
                                    ?>
                                </p>
                                <a href="postADM.php?id=<?php echo $row['id'];?>"><button class="btn btn-custom">Read More</button></a>
                            </div>
                        </div>
                        <?php

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
                                    <a href="categoryADM.php?name=<?php echo $row['categoryName']; ?>">
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
                            $query = "SELECT * FROM posts ORDER BY id DESC LIMIT 5";
                            $res = mysqli_query($conn, $query);
                            while($row = mysqli_fetch_assoc($res)){
                                ?>
                                <li>
                                    <a href="postADM.php?id=<?php echo $row['id'];?>">
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

                    <a href="indexADM.php"><button class="btn btn-custom2"><i>wePost --></i></button></a>
                    <a href="categories.php"><button class="btn btn-custom2">Add/Delete Category</button></a>
                    <a href="allPosts.php"><button class="btn btn-custom2">Add/Delete Article</button></a>
                </div>
            </div>
        </div>
    </div>
    <!-- End content -->
<?php
include('public/footer.php')
?>