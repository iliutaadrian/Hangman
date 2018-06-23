<!DOCTYPE html >
<html>
<head>
    <meta charset="utf-8">

    <title>Spanzuratoarea</title>
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

<div class="container text-center" style="width: 80%">
    <h3>Table Hall of Fame</h3>
    <table class="table table-bordered table-striped" id="myTable">
        <tr>
            <th>Name</th>
            <th>Attempts</th>
            <th>Time</th>
        </tr>
    </table>
</div>

<script src="http://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $.ajax({
            url: 'repositoryFame.php',
            method: 'POST',
            dataType: 'text',
            data: {
                key:'findAll'
            },
            success: function (response) {
                $('#myTable').append(response);
            }
        });
    });
</script>

</body>
</html>
