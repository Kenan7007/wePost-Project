<?php
session_start();
    include ("include/connection.php");
if(isset($_POST['email'])){
    $Mail = $_POST['email'];
    $Pass = $_POST['password'];
    $login = $_POST['log'];
    $person = $_POST['prs'];
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Google Material Icon Link -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Login</title>
    <!-- Booststrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dashboard.css">

<style>
.login{
    width: 300px;
    margin: 80px auto;
}

.login h3{
    color: #555555;
    margin-bottom: 20px;
    text-align: center;
}

.login button{
    background: #FFFFFF;
    color: var(--first-color);
    width: 285px;
    height: 35px;
    border: 1px solid var(--first-color);
    border-radius: 10px;
    box-shadow: 0 4px 16px rgba(0,0,0,.25);
    margin: 10px;
}
.login button:hover{
    background: var(--first-color);
    color: #FFFFFF ;
    transition: all 0.5s ease-in-out;
    cursor: default;
}
.login .line{
    color: var(--first-color);
}
.lbl{
    color: var(--first-color);
    margin: 20px 12px;
}

</style>

</head>
<body>
<div class="login">
    <?php
        if(isset($login)){
            if(empty($Mail) || empty($Pass)){
                echo "<div class='alert alert-danger'>"."Please fill the fields below!"."</div>";
            }
            else{
                    if($person == 'User'){
                                $query = "SELECT * FROM user WHERE email='$Mail' AND password='$Pass'";
                                $rslt = mysqli_query($conn,$query);
                                $row = mysqli_fetch_assoc($rslt);

                                if(in_array($Mail,$row) && in_array($Pass,$row)){
                                    echo "<div class='alert alert-success'>"."Identical Data, wePost Loading..."."</div>";
                                    $_SESSION['name']=$row['name'];
                                    $_SESSION['prs'] = "user";
                                    header('REFRESH:3;URL=index.php');
                                }
                                else{
                                    echo "<div class='alert alert-danger'>"."Not Identical Data!"."</div>";
                                }
                    }
                    elseif($person == 'Admin'){
                                $query = "SELECT * FROM admin WHERE email='$Mail' AND password='$Pass'";
                                $rslt = mysqli_query($conn,$query);
                                $row = mysqli_fetch_assoc($rslt);

                                if(in_array($Mail,$row) && in_array($Pass,$row)){
                                    echo "<div class='alert alert-success'>"."Identical Data, You will be directed to the control panel..."."</div>";
                                    $_SESSION['id']=$row['id'];
                                    header('REFRESH:3;URL=categories.php');
                                }
                                else{
                                    echo "<div class='alert alert-danger'>"."Not Identical Data!"."</div>";
                                }
                    }
                    elseif ($person == 'Author'){
                                $query = "SELECT * FROM author WHERE email='$Mail' AND password='$Pass'";
                                $rslt = mysqli_query($conn,$query);
                                $row = mysqli_fetch_assoc($rslt);

                                if(in_array($Mail,$row) && in_array($Pass,$row)){
                                    echo "<div class='alert alert-success'>"."Identical Data, wePost Loading..."."</div>";
                                    $_SESSION['name']=$row['name'];
                                    $_SESSION['prs'] = "author";
                                    header('REFRESH:3;URL=index.php');
                                }
                                else{
                                    echo "<div class='alert alert-danger'>"."Not Identical Data!"."</div>";
                                }
                    }
                }
        }

    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h3>Login To wePost</h3>
        <div>
            <select name="prs" id="slc" class="form-control">
                <option>User</option>
                <option>Admin</option>
                <option>Author</option>
            </select>
            <label class="line"> _____________________________________________ </label>
        </div>

        <div>
            <label for="mail">Email</label>
            <input type="text" class="form-control" id="mail" name="email">
        </div>

        <div>
            <label for="pass">Password</label>
            <input type="text" class="form-control" id="pass" name="password">
        </div>

        <button class="btn-custom2" name="log">Sign In</button>
    </form>

    <label class="lbl">Or ..if you dont have an account yet ...</label>
    <a href="register.php"><button class="btn btn-custom2">Register Now</button></a>
</div>

<!-- Jquery and Bootstrap.js -->
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/9e9c80fe8e.js" crossorigin="anonymous"></script>
</body>
</html>