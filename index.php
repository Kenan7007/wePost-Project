<?php
session_start();

include ('public/header.php');
include ('include/connection.php');
if(isset($_SESSION['name']) || isset($_SESSION['prs'])){
    $nameUSR = $_SESSION['name'];
    $person = $_SESSION['prs'];
}else{
    $nameUSR = $_SESSION['name'];
    $person = $_SESSION['prs'];
}

if(!isset($_SESSION['name'])) {
    echo "<div class='alert alert-danger'>" . "You need authentication to get to this page! ..." . "</div>";
    header('REFRESH:3;URL=login.php');
}
else{
?>
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <h4><i class="fas fa-user">  Welcome <?php echo $nameUSR ?></i></h4>
                <h6><i><?php echo "__".$person ?></i></h6>
                <div class="col-md-9">
                    <?php
                        $query = "SELECT * FROM posts ORDER BY id DESC";
                        $result = mysqli_query($conn,$query);
                        while ($row = mysqli_fetch_assoc($result)){
                            ?>
                                <div class="post">
                                    <div class="post-title">
                                        <h4><a href="post.php?id=<?php echo $row['id'];?>"><?php echo $row['postTitle']; ?></a></h4>
                                    </div>
                                    <div class="post-image">
                                        <a href="post.php?id=<?php echo $row['id'];?>"><img src="uploads/postImages/<?php echo $row['postImg'];?>"></a>
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
                                        <a href="post.php?id=<?php echo $row['id'];?>"><button class="btn btn-custom">Read More</button></a>
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
                    <?php
                    if(isset($nameUSR)){
                        ?>
                        <a href="allCtg.php"><button class="btn btn-custom2">View Categories</button></a>
                        <a href="allArticles.php"><button class="btn btn-custom2">View All Articles</button></a>
                    <?php
                    }
                    else{
                        ?>
                        <a href="register.php"><button class="btn btn-custom2">Register Now</button></a>
                        <a href="login.php"><label class="lbl">I already have an account..login --></label></a>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
    <!-- End content -->
<?php
}
include('public/footer.php')
?>

