<?php
    require '../util/loginCheck.php';
?>

<!DOCTYPE html >
<html>
<head>
    <meta charset="utf-8">

    <title>Administrator</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
</head>
<body>

<div role="navigation">
    <div class="navbar navbar-inverse">
        <a href="#" class="navbar-brand"><span class="glyphicon glyphicon-home"></span></a>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="../game/game.php"><span class="glyphicon glyphicon-sort-by-alphabet"></span>  Game</a></li>
                <li><a href="../fame/showTable.php"><span class="glyphicon glyphicon-align-right"></span>  Hall of Fame</a></li>
                <li><a href="../logare/logout.php"><span class="glyphicon glyphicon-log-out"></span>  Logout</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="container text-center" style="width: 30%">
    <div id="tableManager" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Add word</h2>
                </div>

                <div class="modal-body" style="padding: 10px">
                    <div class="input-group form-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-alphabet"></i></span>
                        <input type="text" class="form-control" id="word" placeholder="Word" />
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="button" onclick="addRow()" value="Save" class="btn btn-success">
                </div>
            </div>
        </div>
    </div>

    <h3>Table Words</h3>
    <input id="adauga" type="button" class="btn btn-succes" style="float: right; margin-bottom: 10px" value="Adauga">
    <table class="table table-bordered table-hover" id="myTable">
        <tr>
            <td style="font-weight: bold">Word</td>
        </tr>
    </table>
</div>

<script src="http://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#adauga').on('click',function () {
            $('#tableManager').modal('show');
        });

        findAll();
    });

    function findAll() {
        $.ajax({
            url: 'repository.php',
            method: 'POST',
            dataType: 'text',
            data: {
                key:'findAll'
            },
            success: function (response) {
                $('#myTable').append(response);
            }
        });
    }

    function addRow(){
        $.ajax({
            url: 'repository.php',
            method: 'POST',
            dataType: 'text',
            data:{
                key: 'addRow',
                cuvant: $('#word').val()
            },
            success: function (response) {
                $('#tbodyid').empty();
                $('#word').val("");
                findAll();
            }
        });
    }
</script>

</body>
</html>
