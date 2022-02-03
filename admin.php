<?php session_start(); 
    include "access.php";
    access('ADMIN');
    include "header.php"; 
    include "connect.php"; 

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
  a,a:hover,a:link{
  color: white;
  color
  text-decoration: none; 
  }
  </style>
</head>
  <body>
  <div class="ui segment"><div class="ui raised very padded text container segment">
  <h1 class="ui header">Admin Page</h1>
  <div class="ui top attached tabular menu">
  <a class="item active" data-tab="first">User Management</a>
  <a class="item" data-tab="second">Upload</a>
  <a class="item" data-tab="third">Process</a>
</div>
<div class="ui bottom attached tab segment active" data-tab="first">
  <table class="ui blue table">
  <thead>
    <tr><th scope="col">id</th>
    <th scope="col">name</th>
    <th scope="col">email</th>
    <th scope="col">role</th>
    <th scope="col">action</th>
  </tr></thead><tbody>
  <?php 
$sql = "Select * from user";
$result=mysqli_query($conn,$sql);
        if($result){
            while($row=mysqli_fetch_assoc($result)){
              $id=$row['id'];
              $name=$row['name'];
              $email=$row['email'];
              $role=$row['role'];
              echo '<tr>
              <td scope="row">'.$id.'</td>
              <td>'.$name.'</td>
              <td>'.$email.'</td>
              <td>'.$role.'</td>
              <td>
                <div class="ui buttons">
                <button class="ui positive button"><a href="update.php?updateid='.$id.'">Update</a></button>
                <div class="or"></div>
                <button class="ui red button"><a href="delete.php?deleteid='.$id.'">Delete</a></button>
                </div>
              </td>
            </tr>';
            }
        }
    ?>
  </tbody>
  </table>

</div>
<div class="ui bottom attached tab segment" data-tab="second">
<form action="upload.php" method="post" enctype="multipart/form-data">
  Select DATA SPR to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload .MDB FILE" name="submit">
</form>
</div>
<div class="ui bottom attached tab segment" data-tab="third">

<table class="ui yellow table">
  <thead>
    <tr><th scope="col">id</th>
    <th scope="col">name</th>
    <th scope="col">email</th>
    <th scope="col">dateupload</th>
    <th scope="col">action</th>
  </tr></thead><tbody>
  <?php 
  $sql = "Select * from uploaded_files";
    $result=mysqli_query($conn,$sql);
    if($result){
        while($row=mysqli_fetch_assoc($result)){
          $id=$row['id'];
          $email=$row['email'];
          $name=$row['name'];
          $dateupload=$row['dateupload'];
          echo '<tr>
          <th scope="row">'.$id.'</th>
          <td>'.$email.'</td>
          <td>'.$name.'</td>
          <td>'.$dateupload.'</td>
          <td>
                <div class="ui buttons">
                <button class="ui positive button"><a href="updateDataPolitic.php?updateid='.$id.'" class="text-light">Process</a></button>
                <div class="or"></div>
                <button class="ui red button"><a href="deleteDataPolitic.php?deleteid='.$id.'" class="text-light">Delete</a></button>
                </div>
          </td>
        </tr>';
        }
    }
?>
  </tbody>
</table>

</div>
</div></div>
<script>$('.menu .item')
  .tab()
;
</script>

<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src="semantic/dist/semantic.min.js"></script>
  </body>
</html>