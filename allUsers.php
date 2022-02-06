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
                    <label><b><i> User's Ranking</i></b></label>
                    <!-- Display All Users -->
                    <div class="display-authors mt-4">
                        <?php
                        if(isset($id)) {
                            $query = "DELETE FROM user WHERE id ='$id'";
                            $delete = mysqli_query($conn, $query);
                            if (isset($delete)) {
                                echo "<div class='alert alert-success'>" . "User Removed Successfully" . "</div>";
                            } else {
                                echo "<div class='alert alert-danger'>" . "Something Went Wrong" . "</div>";
                            }
                        }
                        ?>

                        <table class="table table-bordered">
                            <tr>
                                <th>User Rank</th>
                                <th>User Id</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Published Articles</th>
                                <th>Remove User</th>
                            </tr>
                            <?php
                            $query = "SELECT * FROM user ORDER BY publishedPosts desc ";
                            $res = mysqli_query($conn,$query);
                            $n = 0;
                            while ($row = mysqli_fetch_assoc($res)){
                                $n++;
                                ?>
                                <tr>
                                    <td><?php echo $n; ?></td>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['publishedPosts']; ?></td>
                                    <td><a href="allUsers.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to Remove User (<?php echo $row['name']; ?>) ?')"><button class="btn-custom">Remove</button></a></td>
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
    </div>

    <?php
}
?>
<?php
include ('include/footer.php');
?>