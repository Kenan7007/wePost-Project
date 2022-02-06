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
    $pUpdate = $_POST['update'];
    //Image
    $imageName = $_FILES['postImg']['name'];
    $imageTmp = $_FILES['postImg']['tmp_name'];
}

$pAuthor = $nameUSR;

if(!isset($_SESSION['name'])) {
    echo "<div class='alert alert-info'>" . "You need to Login or to register.. \nRegister Now ..." . "</div>";
    header('REFRESH:3;URL=register.php');
}
else{
    $id = $_GET['id'];
    $query = "SELECT * FROM posts WHERE id='$id'";
    $rst = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($rst);
    if(!isset($row)){
        echo "<div class='alert alert-danger'>"."Connection lost!"."</div>";
        header('REFRESH:3;URL=index.php');
    }
    else{
    ?>

    <!-- Start Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div id="main-aria">
                    <?php
                    for ($i = 1 ;$i<250;$i++){
                        ?>&nbsp
                    <?php
                    }
                    ?>
                    <label><b><i>Edit Your Article</i></b></label>
                    <div class="update-article">
                        <?php
                        if(isset($pUpdate)){
                            if(empty($pTitle) || empty($pContent)){
                                echo "<div class='alert alert-danger'>"."Please fill all fields below!"."</div>";
                            }
                            elseif($pContent > 65534){
                                echo "<div class='alert alert-danger'>"."Article content is too large!"."</div>";
                            }
                            else{
                                if(empty($imageName)){
                                    $postImg = $row['postImg'];
                                }else{
                                    $postImg = rand(0, 1000) . "_" . $imageName;
                                    move_uploaded_file($imageTmp, "uploads\postImages\\" . $postImg);
                                }
                                $query1 = "UPDATE posts SET postTitle='$pTitle',postCategory='$pCat',postImg='$postImg',postContent='$pContent' WHERE id = '$id'";
                                $res1 = mysqli_query($conn,$query1);
                                if(isset($res1)){
                                    echo "<div class='alert alert-success'>"."Article Updated Successfully! .."."</div>";
                                   // header('REFRESH:2;URL=myPosts.php');
                                    ?>
                                    <script> location.replace("myPosts.php"); </script>
                                    <?php
                                }
                                else{
                                    echo "<div class='alert alert-danger'>"."Something Went Wrong!"."</div>";
                                }
                            }
                        }

                        $ctgName = $row['postCategory'];
                        ?>
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                            <div>
                                <label for="title">Article Title</label>
                                <input type="text"  class="form-control" name="title" value="<?php echo $row['postTitle'] ?>">
                            </div>
                            <br><br>
                            <div>
                                <label for="ctg">Article Category</label>
                                <select name="category" id="ctg"  class="form-control">
                                    <option>
                                        <?php echo $ctgName; ?>
                                    </option>
                                    <?php
                                    $query2 = "SELECT * FROM categories WHERE categoryName != '$ctgName'";
                                    $res2 = mysqli_query($conn,$query2);
                                    while($row2 = mysqli_fetch_assoc($res2)){
                                        ?>
                                        <option>
                                            <?php echo $row2['categoryName']; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <br><br>
                            <div>
                                <label for="image">Choose New Image(or..the image will remain the same!)</label>
                                <input type="file" id="image" class="form-control" name="postImg">
                            </div>
                            <br><br>
                            <div class="new">
                                <label for="content">Article Content</label>
                                <textarea id="" cols="30" rows="10" class="form-control" name="content"><?php echo $row['postContent'] ?>"</textarea>
                            </div>
                            <br><br>
                            <button class="btn-custom" name="update">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
}
}
?>
<?php
include ('include/footer.php');
?>