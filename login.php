<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">  
</head>
  <body>

<?php 
    session_start();
    $error = "";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        #print_r($_POST); this is to display submit output
        if(!$DB = new PDO("mysql:host=localhost;dbname=picpacaba","root","")){
            die("x boleh connect database");
        };

        $arr['email'] = $_POST['email'];
        $arr['password'] = hash('sha1', $_POST['password']);

        $query = "select * from user where email =:email && password =:password limit 1";
        $stm = $DB->prepare($query);
        if($stm){
            $check = $stm->execute($arr);
            if($check){
                $data = $stm->fetchAll(PDO::FETCH_ASSOC);
                if(is_array($data) && count($data) > 0){
                    $_SESSION['myid'] = $data[0]['id'];
                    $_SESSION['myname'] = $data[0]['name'];
                    $_SESSION['myrank'] = $data[0]['role'];
                    $_SESSION['email'] = $data[0]['email'];
                }else{
                    $error = "wrong username or password";
                }
            }
            if($error == ""){
                header("Location: index.php");
                die;
            }
        }
    }
?>
<?php 
    if($error!=""){
        echo $error."<br>";
    }
?>
<div class="ui segment"><div class="ui raised very padded text container segment">
  <div class="ui right internal attached rail">
    <div class="ui segment">
      Please insert information carefully before PIC Admin confirm your registration process
    </div>
  </div>
  <h1 class="ui header">Login page</h1>
  <h4 class="ui red header"><a href="index.php">Back</a></h4>
  <form class="ui form" method="post">
  <div class="field">
    <label>Email</label>
    <input type="email" name="email" placeholder="Email" required>
  </div>
  <div class="field">
    <label>Password</label>
    <input type="password" name="password" placeholder="password" required>
  </div>
  <button class="ui button" type="submit"  value="Login">Login</button>
    </form>
    </div></div>

<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src="semantic/dist/semantic.min.js"></script>
  </body>
</html>