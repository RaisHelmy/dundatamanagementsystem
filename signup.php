<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">  
</head>
  <body>

<?php 
    $error = "";
    function create_userid(){
        $length = rand (4,20);
        $number = "";
        for ($i=0;$i<$length;$i++){
            $new_rand = rand (0,9);
            $number = $number . $new_rand;
        }
        return $number;
    }

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        #print_r($_POST); this is to display submit output
        if(!$DB = new PDO("mysql:host=localhost;dbname=picpacaba","root","")){
            die("x boleh connect database");
        };

        $arr['userid'] = create_userid(); 
        $condition = true; #overengineer code start
        while($condition){
            $query = "select id from user where userid = :userid limit 1";
            $stm = $DB->prepare($query);
            if($stm){
                $check = $stm->execute($arr);
                if($check){
                    $data = $stm->fetchAll(PDO::FETCH_ASSOC);
                    if(is_array($data) && count($data) > 0){
                        $arr['userid'] = create_userid();
                        continue;
                    }
                }
            }
            $condition = false;
        } #overengineer finish

        $arr['name'] = $_POST['name'];
        $arr['email'] = $_POST['email'];
        $arr['password'] = hash('sha1', $_POST['password']);
        $arr['role'] = "normal";

        $query = "insert into user (userid, name, email, password, role) values (:userid, :name, :email, :password, :role)";
        $stm = $DB->prepare($query);
        if($stm){
            $check = $stm->execute($arr);
            if(!$check){
                $error = "could not save to database";
            }
            if($error == ""){
                header("Location: login.php");
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
  <h1 class="ui header">Signup page</h1>
  <form class="ui form" method="post">
  <div class="field">
    <label>Name</label>
    <input type="text" name="name" placeholder="Name" required>
  </div>
  <div class="field">
    <label>Email</label>
    <input type="email" name="email" placeholder="Email" required>
  </div>
  <div class="field">
    <label>Password</label>
    <input type="password" name="password" placeholder="password" required>
  </div>
  <button class="ui button" type="submit"  value="Signup">Submit</button>
    </form>
    </div></div>

<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src="semantic/dist/semantic.min.js"></script>
  </body>
</html>
