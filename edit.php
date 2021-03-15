<?php
    include('connect.php');
    $id = $_GET['id'];
    $sql="SELECT * FROM profile WHERE id='$id'";
    $stmt = $conn->prepare($sql);
	$query = $stmt->execute();
    $result = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $result[] = $row;
    }

    if(!empty($_POST['submit'])){
        $id = $_GET['id'];
        $sql1="SELECT * FROM profile WHERE id='$id'";
        $stmt1 = $conn->prepare($sql1);
        $query1 = $stmt1->execute();
        $row1 =  $stmt1->fetch(PDO::FETCH_ASSOC);
        $uid = $row1['user_id'];

        $name = $_POST['name'];
        $title = $_POST['title'];
        $des = $_POST['des'];
        $old = $_FILES['old']['name'];
        $image = $_FILES['image']['name'];
        $target = "upload/".basename($image);
        if ($image!="") {
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
        }
        else{
            $image = $old;
        }
        $sql1="UPDATE profile SET username='$name',title='$title',description='$des',image='$image' WHERE id='$id'";
        $stmt = $conn->prepare($sql1);
	    $query = $stmt->execute();
        if($query){
            header("location:profile.php?id=$uid");
        }
        else{
            echo "that bai";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <form method="POST" enctype="multipart/form-data">
            <h1>EDIT</h1>
            <div class=" form-group">
                <label>username</label>
                <?php foreach($result as $item): ?>
                    <input type="text" class="form-control" name="name" value="<?php echo $item['username'];?>">
                <?php endforeach ?>
            </div>
            <div class=" form-group">
                <label>title</label>
                <?php foreach($result as $item): ?>
                    <input type="text" class="form-control" name="title" value="<?php echo $item['title'];?>">
                <?php endforeach ?>
            </div>
            <div class=" form-group">
                <label>description</label>
                <?php foreach($result as $item): ?>
                    <input type="text" class="form-control" name="des" value="<?php echo $item['description'];?>">
                <?php endforeach ?>
            </div>
            <div class=" form-group">
                <label>image</label>
                <?php foreach($result as $item): ?>
                <input type="file" class="form-control-file" id="image" name="image"><span name="old" value="<?php echo $item['image'];?>"></span>
                <?php endforeach ?>
            </div>
            <div class="form-group">
                <input type="submit" value="save" name="submit" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>
</html>