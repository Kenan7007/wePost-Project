<?php
session_start();
include ('include/connection.php');
include ('include/header.php');

$nameUSR = $_SESSION['name'];
$person = $_SESSION['prs'];
if(isset($_POST['title'])){
    $pTitle = $_POST['title'];
    $pCat = $_POST['category'];
    $pContent = $_POST['content'];
    $pAdd = $_POST['add'];
    //Image
    $imageName = $_FILES['postImg']['name'];
    $imageTmp = $_FILES['postImg']['tmp_name'];
}
$pAuthor = $nameUSR;

if(!isset($_SESSION['name'])) {
    echo "<div class='alert alert-info'>" . "You need to Login or to register to be able to publish articles!.. \nRegister Now ..." . "</div>";
    header('REFRESH:3;URL=register.php');
}
else{
?>

    <!-- Start Content -->
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
                    <?php

                    $queryA = "SELECT * FROM author WHERE name='$pAuthor'";
                    $resA = mysqli_query($conn,$queryA);
                    $rowA = mysqli_fetch_assoc($resA);
                    if(isset($rowA)){
                        $pp = $rowA['published_posts'];
                    }else{
                        $queryU = "SELECT * FROM user WHERE name='$pAuthor'";
                        $resU = mysqli_query($conn,$queryU);
                        $rowU = mysqli_fetch_assoc($resU);
                        $pp = $rowU['publishedPosts'];
                    }

                    ?>
                    <label><b><i>New Article</i></b></label>
                    <div class="add-category">
                        <?php
                        if(isset($pAdd)){
                            if(empty($pTitle) || empty($pContent)){
                                echo "<div class='alert alert-danger'>"."Please fill all fields below!"."</div>";
                            }
                            elseif($pContent > 65534){
                                echo "<div class='alert alert-danger'>"."Article content is too large!"."</div>";
                            }
                            else{
                                $postImg = rand(0,1000)."_".$imageName;
                                move_uploaded_file($imageTmp, "uploads\postImages\\".$postImg);
                                $query = "INSERT INTO posts(postTitle,postCategory,postImg,postContent,postAuthor) 
                          VALUES ('$pTitle','$pCat','$postImg','$pContent','$pAuthor')";

                                $res = mysqli_query($conn,$query);
                                if(isset($res)){
                                    echo "<div class='alert alert-success'>"."Article Published Successfully! .."."</div>";
                                        if (isset($rowA)){
                                            $ppN = $pp+1;
                                            $queryAA = "UPDATE author SET published_posts = '$ppN' WHERE name='$pAuthor' ";
                                            $resAA = mysqli_query($conn,$queryAA);
                                        }elseif (isset($rowU)){
                                            $ppN = $pp+1;
                                            $queryUU = "UPDATE user SET publishedPosts = '$ppN' WHERE name='$pAuthor'";
                                            $resUU = mysqli_query($conn,$queryUU);
                                        }
                                    ?>
                                    <script> location.replace("index.php"); </script>
                                    <?php
                                }
                                else{
                                    echo "<div class='alert alert-danger'>"."Something Went Wrong!"."</div>";
                                }

                            }
                        }

                        ?>
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                            <div>
                                <label for="title">Article Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>

                            <div>
                                <label for="ctg">Article Category</label>
                                <select name="category" id="ctg" class="form-control">
                                    <?php
                                    $query = "SELECT * FROM categories";
                                    $res = mysqli_query($conn,$query);
                                    while($row = mysqli_fetch_assoc($res)){
                                        ?>
                                        <option>
                                            <?php echo $row['categoryName']; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label for="image">Article Image</label>
                                <input type="file" id="image" class="form-control" name="postImg">
                            </div>
                            <div class="new">
                                <label for="content">Article Content</label>
                                <textarea id="" cols="30" rows="10" class="form-control" name="content"></textarea>
                            </div>
                            <button class="btn-custom" name="add">Publish</button>
                        </form>
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