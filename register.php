<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<?php
    require_once("connect.php");
    if(isset($_POST['submit'])){
        include('connect.php');
        $user=$_POST['user'];
        $pass=md5($_POST['pass']);
        $sql="INSERT INTO user(user,pass) VALUES ('$user','$pass')";
        $sql1="SELECT * FROM user ORDER BY id DESC LIMIT 1";
        $stmt = $conn->prepare($sql);
		$query = $stmt->execute();
        $stmt1 = $conn->prepare($sql1);
		$query1 = $stmt1->execute();
        $row = $stmt1->fetch(PDO::FETCH_ASSOC);
        $uid = $row['id'];
        var_dump($uid);
        $sql2 = "INSERT INTO profile(user_id) VALUES ('$uid')";
        $stmt2 = $conn->prepare($sql2);
		$query2= $stmt2->execute();
        header('location:index.php');
    }
?>
<body>
    <div class="container">
        <h1>DangKy</h1>
        <form method="POST">
            <div class=" orm-group">
                <label>User</label>
                <input type="text" class="form-control" id="text" name="user">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="password" name="pass">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-default">
            </div>
        </form>
    </div>
</body>
</html>