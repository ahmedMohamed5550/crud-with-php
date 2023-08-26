<?php

// test message
function testmessage($connection,$message){
    if($connection){
        // echo "<div class='alert alert-success col-md-5 mx-auto'>
        // $message succesfuly
        // </div>";
    }
    else{
        echo "<div class='alert alert-danger col-md-5 mx-auto'>
        $message failed
        </div>";
    }
    }

// connect to database
$host='localhost';
$user='root';
$password="";
$dbname="college";
$connection=mysqli_connect($host,$user,$password,$dbname);
testmessage($connection,"connection");


// insert data

if(isset($_POST['send'])){
$name=$_POST['name'];
$salary=$_POST['salary'];

$insert="INSERT INTO `teachers` VALUES(NULL,'$name',$salary)";
$i=mysqli_query($connection,$insert);

}


// display data

$select="SELECT * FROM `teachers`";
$s=mysqli_query($connection,$select);


// remove data

if(isset($_GET['delete'])){
$id=$_GET['delete'];

$remove="DELETE FROM `teachers` WHERE id=$id";
$r=mysqli_query($connection,$remove);
header("location:index.php");
}



// update data

$name=false;
$salary=false;
$update=false;

if(isset($_GET['edit'])){
    $update=true;
    $id=$_GET['edit'];
    $select="SELECT * FROM `teachers` WHERE id=$id";
    $ss=mysqli_query($connection,$select);
    $data=mysqli_fetch_assoc($ss);
    $name=$data['name'];
    $salary=$data['salary'];

    if(isset($_POST['update'])){
        $name=$_POST['name'];
        $salary=$_POST['salary'];

        $update="UPDATE `teachers` SET `name`='$name' , salary=$salary WHERE id=$id";
        $u=mysqli_query($connection,$update);
        header("location:index.php");

    }
    

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/main.css">
    <title>Document</title>
</head>
<body>
    <h1 class="text-center display-5 text-info">Crud opertation</h1>
    <div class="container col-md-6 text-center">
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="<?= $name ?>" class="form-control" placeholder="teacher name">
                    </div>
                    <div class="form-group">
                        <label>Salary</label>
                        <input type="text" name="salary" value="<?= $salary ?>" class="form-control" placeholder="salary">
                    </div>
                    <?php if($update):?>                    
                    <button class="btn btn-danger" name="update">Update Data</button>
                    <a class="btn btn-info" href="./index.php">GO Back</a>
                    <?php else: ?>
                    <button class="btn btn-info" name="send">Submit Data</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <div class="table">
        <div class="container col-md-8 text-center">
            <table class="table table-dark table-striped">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Salary</th>
                    <th colspan="2">Action</th>
                </tr>
            <?php foreach($s as $data): ?>
                <tr>
                    <th> <?= $data['id'] ?> </th>
                    <th> <?= $data['name'] ?> </th>
                    <th> <?= $data['salary'] ?> </th>
                    <th><a href="index.php? edit=<?= $data['id'] ?>" class="btn btn-info" name="edit">Edit</a></th>
                    <th><a onclick="return confirm('are you sure ?')" href="index.php? delete=<?= $data['id'] ?>" class="btn btn-danger">Remove</a></th>
                </tr>
            <?php endforeach; ?>
            </table>
        </div>
    </div>
    
</body>
</html>
