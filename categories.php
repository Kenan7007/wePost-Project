<?php
session_start();
    include ('include/connection.php');
    include ('include/header.php');
if (isset($_POST['category']) || isset($_POST['add'])){
    $cName = $_POST['category'];
    $cAdd = $_POST['add'];

}
if (isset($_GET['id'])){
    $id = $_GET['id'];
}


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
                <label><b><i>Categories</i></b></label>
                <div class="add-category">
                    <?php
                        if(isset($cAdd)){
                            if(empty($cName)){
                                echo "<div class='alert alert-danger'>"."Nothing To Add"."</div>";
                            }
                            elseif ($cName > 100){
                                echo "<div class='alert alert-danger'>"."Too Large Category Name"."</div>";
                            }
                            else{
                                $query = "INSERT INTO categories(categoryName) VALUES ('$cName')";
                                mysqli_query($conn, $query);
                                echo "<div class='alert alert-success'>"."Category Added"."</div>";
                            }
                        }
                    ?>
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="new">
                            <label for="category">New Category</label>
                            <input type="text" name="category" class="form-control">
                        </div>
                        <button class="btn-custom" name="add">ADD</button>
                    </form>
                </div>
                <!-- Display Categories -->
                <div class="display-cat mt-5">
                    <?php
                        if(isset($id)){
                            $query = "DELETE FROM categories WHERE id='$id'";
                            $delete = mysqli_query($conn,$query);
                            if(isset($delete)){
                                echo "<div class='alert alert-success'>"."Category Deleted Successfully"."</div>";
                            }
                            else{
                                echo "<div class='alert alert-danger'>"."Something Went Wrong"."</div>";
                            }
                        }
                    ?>
                    <table class="table table-bordered">
                        <tr>
                            <th>Category Number</th>
                            <th>Category Name</th>
                            <th>Added Date</th>
                            <th>Delete Category</th>
                        </tr>
                        <?php
                        $query = "SELECT * FROM categories ORDER BY id DESC";
                        $res = mysqli_query($conn,$query);
                        $n = 0;
                        while ($row = mysqli_fetch_assoc($res)){
                            $n++;
                            ?>
                            <tr>
                                <td><?php echo $n; ?></td>
                                <td><?php echo $row['categoryName']; ?></td>
                                <td><?php echo $row['categoryDate']; ?></td>
                                <td><a href="categories.php?id=<?php echo $row['id']; ?>"><button class="btn-custom">Delete</button></a></td>
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
<!-- End Content -->
<?php
    }
?>
<?php
   include ('include/footer.php');
?>
