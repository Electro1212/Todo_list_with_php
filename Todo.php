<?php
   $conn= mysqli_connect("localhost","root","","todo");

   if(isset($_POST['add'])){
    $title = $_POST['title'];
    $desc = $_POST['desc'];
   if($title=="" || $desc==""){
    header("Location:Todo.php?error=1");
    die();
   }
    $sql ="INSERT INTO `input`(`Title`, `Description`) VALUES ('$title','$desc')";
    mysqli_query($conn,$sql);
    header("Location:Todo.php");
   }

   if(isset($_GET['delete_id'])){
     $id = $_GET['delete_id'];
     $sql = "DELETE FROM `input` WHERE Id = $id";
     mysqli_query($conn,$sql);
   }
   if(isset($_POST['clr'])){
    $clr = $_POST['clr'];
    $sql = "DELETE FROM `input`";
    mysqli_query($conn,$sql);
   }
   if(isset($_POST['updt'])){
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $id = $_POST['update_id'];
   if($title=="" || $desc==""){
    header("Location:Todo.php?error=1");
    die();
   }
    $sql ="UPDATE `input` SET `Title`='$title',`Description`='$desc' WHERE Id = $id";
    mysqli_query($conn,$sql);
    header("Location:Todo.php");
   }
   if(isset($_GET['edit_id'])){
    $id= $_GET['edit_id'];
    $fetch ="SELECT * FROM `input` WHERE Id = $id";
    $query = mysqli_query($conn,$fetch);
    $row = mysqli_fetch_assoc($query);
    $uname = $row['Title'];
    $sname = $row['Description'];
   }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="bg-info">
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container">
        <a class="navbar-brand " href="#">TODOs LIST</a>
        </div>
    </nav>
<?php
if(isset($_GET['error'])){
    echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
      i am pliz add something
    </div>';
   }
?>
 <div class="container-fluid bg-info">
    <div class="container">
            <form method="post">
<?php
if(isset($_GET['edit_id'])){?>
    <input type="hidden" name="update_id" value="<?php echo $_GET['edit_id']; ?>">
<?php }?>
<?php
if(isset($_GET['edit_id'])){?>
        <div class="mb-3">
            <label for="Title" class="form-label">Title</label>
            <input type="Title" class="form-control" id="exampleInputEmail1" value="<?php echo $uname ?>" aria-describedby="emailHelp" name="title">
            <div id="emailHelp" class="form-text">Title add koro bhai gulo</div>
        </div>
        <div class="mb-3">
            <label for="Description" class="form-label">Description</label>
            <textarea type="text" class="form-control" id="description" rows="3" name="desc" value="<?php echo $sname ?>"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="updt">Update List</button>
<?php }else{?>
    <div class="mb-3">
            <label for="Title" class="form-label">Title</label>
            <input type="Title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="title">
            <div id="emailHelp" class="form-text">Title add koro bhai gulo</div>
        </div>
        <div class="mb-3">
            <label for="Description" class="form-label">Description</label>
            <textarea class="form-control" id="description" rows="3" name="desc"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="add">Add to list</button>
<?php }?>
        <button type="submit" class="btn btn-primary" name="clr">Clear List</button>
    </form>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">Id</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
 <?php
    $fetch_sql = "SELECT * FROM `input`";
    $fetch_query =mysqli_query($conn,$fetch_sql);
    while($row=mysqli_fetch_assoc($fetch_query)){
        echo'  <tbody>
                <tr>
                <th scope="row">'.$row['Id'].'</th>
                <td>'.$row['Title'].'</td>
                <td>'.$row['Description'].'</td>
                <td><a href="Todo.php?delete_id='.$row['Id'].'"><button class="btn btn-sm btn-primary" type="submit">Delete</button></a>
                <a href="Todo.php?edit_id='.$row['Id'].'"><button class="btn btn-sm btn-primary" type="submit">Edit</button></a></td>
                </tr>
            </tbody>';
    }

?>   
            </table>

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>