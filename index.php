<?php
$_ENV = parse_ini_file('.env');
if(!array_key_exists('con', $_ENV)){
$_ENV['con'] = mysqli_connect($_ENV['host'],$_ENV['username'],$_ENV['password'],$_ENV['dbname']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FEST WEBSITE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet">
    <link href="/static/css/main.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<?php
// ENV VARIABLES
$error="";
// ROUTE HANDLERS
function login(){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT password FROM users WHERE email='$email'";
    $query = mysqli_query($_ENV['con'],$sql);
    $res = mysqli_fetch_assoc($query);
    if($res){
        if($res['password']==$password){
            setcookie('email',$email,0,'/');
            header('location: /');
        }
        else{
            $error = "wrong password";
            include "static/templates/login.php";
        }
    }
    else {
        $error = "email does not exist";
        include "static/templates/login.php";
    }
}
function signup(){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $con_password = $_POST['con_password'];
    if($con_password!=$password)$error="password inconsistent";
    else{
    $sql = "SELECT * FROM users WHERE email='$email'";
    $query = mysqli_query($_ENV['con'],$sql);
    $res = mysqli_fetch_assoc($query);
    if ($res){
        $error = "user exists";
    }
    else{
        $sql = "INSERT INTO users VALUES('$email','$password')";
        mysqli_query($_ENV['con'],$sql);
        setcookie('email',$email,0,'/');
        header('location: /');
        exit;
    }}
    include "static/templates/signup.php";
}
function logout(){
    setcookie('email', "",time() - 3600,'/');
    header('location: /');
}

function create(){
    $type = $_POST['type'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $fee = $_POST['fee'];
    $sql = "INSERT INTO {$type}s VALUES(
        '$title',
        '$description',
        '$image',
        '$fee'
    )";
    try{
        mysqli_query($_ENV['con'],$sql);
        header('location: /dashboard');}
    catch(Exception $e){echo "<h1>$type : $title already exists</h1>";}
}
function update(){
    $type = $_POST['type'];
    $oldTitle= $_POST['old_title'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $fee = $_POST['fee'];
    $sql = "
    UPDATE {$type}s
    SET 
    title='$title',
    description='$description',
    image='$image',
    fee='$fee'
    WHERE title='$oldTitle'
    ";
    try{
    mysqli_query($_ENV['con'],$sql);
    header('location: /dashboard');}
    catch(Exception $e){echo "<h1>$type : $title already exists</h1>";}
}
function add(){
    $type = $_POST['type'];
    $title = $_POST['title'];
    $email = $_COOKIE['email'];
    $sql = "INSERT INTO {$type}_registrations VALUES(
        '$email',
        '$title'
    )";
    try{
    mysqli_query($_ENV['con'],$sql);}
    catch(Exception $e){}
}
function del(){
    $type = $_POST['type'];
    $title = $_POST['title'];
    $email = $_COOKIE['email'];
    if($email=='admin'){
        $sql="DELETE FROM {$type}s WHERE title='$title'";}
    else{
        $sql = "DELETE FROM {$type}_registrations
    WHERE user_email='$email' AND $type='$title'";}
    mysqli_query($_ENV['con'],$sql);
}
function isLoggedIn(){
    if(isset($_COOKIE['email']))return 1;
    else return 0;
}
function isAdmin(){
    if(isset($_COOKIE['email'])){
        if($_COOKIE['email']=='admin')return 1;}
    else return 0;
}
// ROUTING
$uri = $_SERVER['REQUEST_URI'];
switch($uri){
    case '/':
        $LoggedIn = isLoggedIn();
        if($LoggedIn)$email = $_COOKIE['email'];
        $admin=isAdmin();
        include "static/templates/home.php";
        break;
    case '/login':
        include "static/templates/login.php";
        break;
    case '/signup':
        include "static/templates/signup.php";
        break;
    case '/dashboard':
        $LoggedIn = isLoggedIn();
        $admin = isAdmin();
        if($LoggedIn){
            $email = $_COOKIE['email'];
            if($admin)include "static/templates/admin.php";
            else include "static/templates/dashboard.php";}
        else header("Location: /login");//redirect to login
        break;
    case '/api/login':
        login();
        break;
    case '/api/signup':
        signup();
        break;
    case '/api/logout':
        logout();
        break;
    case '/api/add':
        add();
        break;
    case '/api/del':
        del();
        break;
    case '/api/create':
        if(!isAdmin())echo "ACCESS DENIED";
        else{
        create();}
        break;
    case '/api/update':
        if(!isAdmin())echo "ACCESS DENIED";
        else{
        update();}
        break;
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</html>