<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">  
</head>
  <body>

<?php 
    include "connect.php"; 
    $id=$_GET['updateid'];
    $sql = "Select * from user where id='$id'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $email=$row['email'];

    if(isset($_POST['submit'])){
        $email=$_POST['email'];
        $role=$_POST['role'];
        echo $role;
        $sql="update user set email='$email', role='$role' where id='$id'";
        $result=mysqli_query($conn,$sql);
        if($result){
            //echo "success update";
          header('location:admin.php');
        } else {
            die(mysqli_error($conn));
        }
      }

?>



<div class="ui segment"><div class="ui raised very padded text container segment">
  <div class="ui right internal attached rail">
    <div class="ui segment">
    You may change the user role just by selecting the role radio button. After that you may click update to proceed.
    </div>
  </div>
  <h1 class="ui header">Update user page</h1>
  <form class="ui form" method="post">
  <div class="field">
    <label>Email</label>
    <input type="email" class="form-control" placeholder="Email" name="email" value=<?php echo $email;?>>
  </div>
  <div class="form-check">
            <input class="form-check-input" type="radio" name="role" value="normal">
            <label class="form-check-label" for="flexRadioDefault1">
                Normal role
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="role" value="client">
            <label class="form-check-label" for="flexRadioDefault1">
                Client role
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="role" value="admin">
            <label class="form-check-label" for="flexRadioDefault1">
                Admin role
            </label>
  </div>
  <button class="ui button" type="submit" name="submit">Update</button>
</div>
    </form>
    </div></div>

<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src="semantic/dist/semantic.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>