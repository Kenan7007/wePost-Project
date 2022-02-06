<?php
session_start();
include ('public/headerADM.php');
include ('include/connection.php');
$idADM = $_SESSION['id'];
$nameUSR1 = "Admin".$idADM;
$delete = $_POST['delete'];
$comment_btn = $_POST['comment-btn'];
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
                    $cat = $row['postCategory'];
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
                    </div>
                    <div class="comment">
                        <?php
                        $query1 = "SELECT * FROM comments WHERE post_id = '$id' ORDER BY com_nr ASC LIMIT 4";
                        $result1 = mysqli_query($conn,$query1);
                        ?>
                        <form class="form-control" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                            <label for="lst-comments"><i><b>comments :</b></i></label><br><br>
                            <?php
                            while($row1 = mysqli_fetch_assoc($result1)){
                                $cn = $row1['com_nr']
                                ?>

                                <label hidden><?php echo $cn; ?></label>
                                <label for="last-comments"><b><?php echo $row1['person']; ?> :</b></label><br>
                                <label for="date">at: <?php echo $row1['date']; ?></label>
                                <input type="text" id="content" name="content" value="<?php echo $row1['content']; ?>" readonly class="form-control">
                                <button class="sv-chg" name="delete">Delete</button><br>
                                <br>
                                <?php
                            }
                            if (isset($delete)){
                                $query = "DELETE FROM comments WHERE com_nr='$cn'";
                                $delete = mysqli_query($conn,$query);
                                if(isset($delete)){
                                    echo "<div class='alert alert-success'>"."Comment Deleted Successfully"."</div>";
                                    ?>   <script>location.replace("postADM.php?id=<?php echo $id?>"); </script> <?php
                                }
                                else{
                                    echo "<div class='alert alert-danger'>"."Something Went Wrong"."</div>";
                                ?>   <script>location.replace("postADM.php?id=<?php echo $id?>"); </script> <?php
                                }
                            }
                            ?>
                            <br>
                            <label class="line">  ___________________________________________________________________________________________________________________________________________ </label>
                            <br>
                            <label for="your_comment"><i>Add Your Comment:</i></label>
                            <input type="text" id="com" name="com" class="form-control"><br>

                            <button class="btn-custom2" name="comment-btn">post comment</button>
                        </form>

                    </div>
                    <?php
                    if(isset($comment_btn)){
                        $content = $_POST['com'];

                        if(empty($content)){
                            echo "<div class='alert alert-danger'>"."Nothing to post"."</div>";
                        }else{
                            $query2 = "INSERT INTO comments(person,post_id,content) VALUES('$nameUSR1','$id','$content')";
                            $res2 = mysqli_query($conn,$query2);
                            if(isset($res2)){
                                echo "<div class='alert alert-success'>"."Comment Added Successfully! .."."</div>";
                                ?>   <script>location.replace("postADM.php?id=<?php echo $id?>"); </script> <?php
                            }
                            else{
                                echo "<div class='alert alert-danger'>"."Something Went Wrong!"."</div>";
                            }
                        }
                    }
                    ?>
                    <br>
                    <br>
                    <br>
                    <br>
                    <label><i>Read more about (<?php echo $cat ?>) : </i></label>
                    <div class="similar-articles">
                        <?php
                        $query4 = "SELECT * FROM posts WHERE postCategory='$cat' AND id !='$id'";
                        $rst4 = mysqli_query($conn,$query4);
                        while ($row4=mysqli_fetch_assoc($rst4)){
                            ?>
                            <label><b><?php echo $row4['postAuthor']; ?>:</b></label>
                            <div class="S-post-title">
                                <h4><a href="postADM.php?id=<?php echo $row4['id'];?>"><?php echo $row4['postTitle']; ?></a></h4>
                            </div>
                            <div class="S-post-image">
                                <a href="postADM.php?id=<?php echo $row4['id'];?>"><img src="uploads/postImages/<?php echo $row4['postImg'];?>" width="300" height="150"></a>
                            </div><label><b><?php echo $row4['postDate']; ?></b></label>
                            <br>
                            <?php
                        }
                        ?>
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
                            $query = "SELECT * FROM posts ORDER BY id DESC LIMIT 4";
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