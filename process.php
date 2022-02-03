<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  </head>
  <body>
  <div class="container">

  <table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">email</th>
      <th scope="col">name</th>
      <th scope="col">dateupload</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>
<?php session_start();
    include "access.php";
    include "header.php"; 
    include "connect.php"; 
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
            <button class="btn btn-primary"><a href="updateDataPolitic.php?updateid='.$id.'" class="text-light">Process</a><button>
            <button class="btn btn-danger"><a href="deleteDataPolitic.php?deleteid='.$id.'" class="text-light">Delete</a><button>
          </td>
        </tr>';
        }
    }
?>
  </tbody>
</table>
</form>
</div>
  </body>
</html>