<?php
session_start();
    include ('include/connection.php');
    include ('include/header.php');

$idADM = $_SESSION['id'];
if (isset($_POST['title'])){
    $pTitle = $_POST['title'];
    $pCat = $_POST['category'];
    $pContent = $_POST['content'];
    $pAdd = $_POST['add'];
    //Image
    $imageName = $_FILES['postImg']['name'];
    $imageTmp = $_FILES['postImg']['tmp_name'];
}
    $pAuthor = "Admin".$idADM;

if(!isset($_SESSION['id'])) {
    echo "<div class='alert alert-danger'>" . "You need authentication to get to this page! ..." . "</div>";
    header('REFRESH:3;URL=login.php');
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
                                    ?>
                                    <script> location.replace("indexADM.php"); </script>
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