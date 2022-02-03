<?php session_start();
    include "access.php";
    include "header.php"; 
    include "connect.php"; 
    $email = $_SESSION['email'];
    $filename = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file ".$filename." already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000000000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "mdb" ) {
  echo "Sorry, only mdb are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". $filename. " has been uploaded.<br> <h4 class='ui red header'><a href='index.php'>Back</a></h4>";

    $sql="insert into uploaded_files (name, email) values ('$filename','$email')";
    $conn->query($sql);
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>

