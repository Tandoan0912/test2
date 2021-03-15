
<?php
    include('connect.php');
    $id = $_GET['id'];
    $sql="select * from profile WHERE user_id='$id'";
    $stmt = $conn->prepare($sql);
    $query = $stmt->execute();
    $result = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $result[] = $row;
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
    <div class="row">
        <div class="col-3 pt-5">
        <?php foreach($result as $item): ?>
            <img src='upload/<?php echo $item['image']?>' style="height:200px; width:200px;" class="rounded-circle">
        <?php endforeach ?>
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
            <?php foreach($result as $item): ?>
                <h1><?php echo $item['username']?></h1>
                    <a class="btn btn-primary" href="edit.php?id=<?php echo $item['id'];?>">Edit</a>
            </div>

            <div class="pt-5"><?php echo $item['title']?></div>
            <div class=""><?php echo $item['description']?></div>
            <?php endforeach ?>
        </div>
    </div>
    </div>
</body>
</html>