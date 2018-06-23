<?php

include '../util/mysqli_connect.php';

$afisare = '';

if(isset($_POST['register'])) {
    $stmt = $mysqli->prepare("INSERT INTO users (username, password) VALUES (?,?)");
    $username = strip_tags($mysqli->real_escape_string($_POST['username']));
    $password = strip_tags($mysqli->real_escape_string($_POST['password']));

    if($username == '' || $password == ''){
        $afisare = 'Numele si parola nu trebuie sa fie null';
    }

    $stmt->bind_param("ss",$username,$password);
    $result = $stmt->execute();

    if($result == true){
        $afisare = 'Inregistrare cu succes!';
    }
    $stmt->close();
}
?>
<!DOCTYPE html >
<html>
<head>
    <meta charset="utf-8">

    <title>Spanzuratoare</title>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
        <h3>Register</h3>
        <hr>
        <h3 style="color: red"><?php echo $afisare; ?></h3>

        <form class="form-horizontal" method="POST" action="register.php">
            <div class="input-group form-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" class="form-control" name="username" placeholder="Username" />
            </div>

            <div class="input-group form-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="password" class="form-control" name="password" placeholder="Password"/>

            </div>

            <div class="form-group ">
                <input type="submit" name="register" class="btn btn-primary" value="Register" />
            </div>
        </form>
    </div>

</body>
</html>
