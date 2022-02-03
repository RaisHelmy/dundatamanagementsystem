<?php 
    function access($role){
        if(isset($_SESSION["ACCESS"]) && !$_SESSION["ACCESS"][$role]){
            header("Location: denied.php");
        }
    }
    $_SESSION["ACCESS"]["ADMIN"] = isset($_SESSION['myrank']) && trim($_SESSION['myrank']) == "admin";
    $_SESSION["ACCESS"]["CLIENT"] = isset($_SESSION['myrank']) && trim($_SESSION['myrank']) == "client";
    $_SESSION["ACCESS"]["NORMAL"] = isset($_SESSION['myrank']) && trim($_SESSION['myrank']) == "normal";

?>