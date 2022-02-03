
<?php
include "connect.php";
if(isset($_GET['deleteid'])){
        $id=$_GET['deleteid'];
        $result = mysqli_query($conn, "select name from uploaded_files where id=$id");
        $filename = mysqli_fetch_array($result);
        $filepath=unlink('uploads/'.$filename["name"]);    
        $sql="delete from uploaded_files where id=$id";
        $result=mysqli_query($conn,$sql);
        if($result){
            header('location:process.php');
        } else {
            die(mysqli_error($conn));
        }
    }

?>