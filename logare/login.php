<?php

include '../util/mysqli_connect.php';
include '../util/redirect.php';

session_start();

if(isset($_SESSION['username'])){
    redirect('../crud/administrator.php');
}

if(isset($_POST['login'])) {
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ? and password = ?");
    $stmt->bind_param("ss", $_POST['username'], $_POST['password']);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        redirect('../util/error.html');
    } else {
        $row = $result->fetch_assoc();

        $_SESSION['username'] = $row['username'];
        redirect('../crud/administrator.php');
    }
    $stmt->close();
}
?>

<!DOCTYPE html >
<html>
<head>
    <meta charset="utf-8">

    <title>Spanzuratoarea</title>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="checkbox.css">
</head>
<body>

<div role="navigation">
    <div class="navbar navbar-inverse">
        <a href="#" class="navbar-brand"><span class="glyphicon glyphicon-home"></span></a>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="../game/game.php"><span class="glyphicon glyphicon-sort-by-alphabet"></span>  Game</a></li>
                <li><a href="../fame/showTable.php"><span class="glyphicon glyphicon-align-right"></span>  Hall of Fame</a></li>
                <li><a href="../logare/login.php"><span class="glyphicon glyphicon-log-in"></span>  Login</a></li>
                <li><a href="../inregistrare/register.php"><span class="glyphicon glyphicon-user"></span>  Register</a></li>
            </ul>
        </div>
    </div>
</div>

    <div class="container text-center" style="width: 50%">
        <h3>Login</h3>
        <hr>

        <form class="form-horizontal" method="POST" action="login.php">
            <div class="input-group form-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" class="form-control" name="username" placeholder="Username"/>
            </div>

            <div class="input-group form-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password"/>

            </div>

            <div class="checkbox" style="margin-bottom: 15px">
                <label>
                    <input type="checkbox" onclick="f()">
                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Show password
                </label>
            </div>

            <script>
                function f() {
                    let x = document.getElementById("password");
                    if (x.type === 'password') {
                        x.type = 'text';
                    } else {
                        x.type = 'password';
                    }}
            </script>

            <div class="form-group ">
                <input type="submit" name="login" class="btn btn-primary" value="Login" />
            </div>
        </form>
    </div>

</body>
</html>
