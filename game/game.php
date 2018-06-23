<!DOCTYPE html >
<html>
<head>
    <meta charset="utf-8">

    <title>Spanzuratoarea</title>
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

<div class="container text-center" style="width: 80%">
    <div id="modalWindow" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Save Hall of fame</h2>
                </div>

                <div class="modal-body" style="padding: 10px">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" placeholder="Name" />
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="time" readonly />
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="try" readonly />
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="button" onclick="save()" value="Save" class="btn btn-success">
                </div>
            </div>
        </div>
    </div>

<div class="container text-center" style="width: 50%">
    <h3>Spazuratoarea</h3>
    <hr>

    <div class="form-group ">
        <input type="button" id="start" class="btn btn-primary" value="Start joc" />
    </div>

    <div id="timer" style="margin: 10px"></div>

    <div id="incercari" style="margin: 10px;"></div>

    <form class="form-horizontal" method="POST" action="#">
        <div class="form-group">
            <input type="text" class="form-control" id="cuvant" value="WORD" style="text-align: center; font-size: larger; font-weight: bold" readonly/>
        </div>

        <div class="form-group">
            <input type="text" class="form-control" id="litera" placeholder="Complete the correct letter" maxlength="1" style="text-align: center"/>

        </div>

        <div class="form-group">
            <input type="button" id="ghiceste" class="btn btn-primary" value="Guess the letter" />
        </div>

        <div class="form-group">
            <input type="button" id="level" class="btn btn-danger" value="Next Level" style="visibility: hidden">
        </div>

        <div class="form-group">
            <input type="button" id="saveScore" class="btn btn-success" value="Save score" style="visibility: hidden">
        </div>
    </form>
</div>

<script src="http://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript">
    let cuvantOriginal;
    let cuvantModificat;
    let counter;
    let incercari;
    let wordSize;

    let Clock = {
        start: function () {
            this.interval = setInterval(function () {
                counter += 1;
                $('#timer').html('<b>Timer: </b>' + counter % 60);
            }, 1000);
        },

        pause: function () {
            clearInterval(this.interval);
            delete this.interval;
        },

        stop: function () {
            clearInterval(this.interval);
            delete this.interval;
            counter=0;
        }
    };

    $(document).ready(function () {
        $('#start').on('click', function () {
            incercari=0;
            wordSize=4;
            counter=0;

            newWord(wordSize);

            $('#timer').html('<b>Timer: </b>' + counter);
            $('#incercari').html('<b>Incercari: </b>'+incercari);

            $('#saveScore').css('visibility', 'hidden');
            $('#level').css('visibility', 'hidden');

            $('#start').val('Restart game');

            Clock.stop();
            Clock.start();
        });

        $('#ghiceste').on('click', function () {
            verifica();
        });

        $('#level').on('click', function () {
            nextLevel();
        });

        $('#saveScore').on('click', function () {
            $('#time').val('Timer: '+ counter);
            $('#try').val('Tryes: ' + incercari);
            $('#modalWindow').modal('show');
        });
    });

    function newWord(size) {
        $.ajax({
            url: 'gameRepository.php',
            method: 'POST',
            dataType: 'text',
            data: {
                key:'newWord',
                size: size
            },
            success: function (response) {
                cuvantModificat = response.toUpperCase().split('');
                cuvantOriginal = response.toUpperCase().split('');

                for(let i = 1; i<cuvantModificat.length-1; i++){
                    cuvantModificat[i] = '_';
                }
                $('#cuvant').val(cuvantModificat.join(" "));
            }
        });
    }

    function save() {
        $.ajax({
            url: 'gameRepository.php',
            method: 'POST',
            dataType: 'text',
            data: {
                key:'save',
                name: $('#name').val(),
                time: counter,
                try: incercari
            },
            success: function (response) {
                alert(response);
            }
        });
    }

    function verifica() {
        let ghicit = 0;
        let terminat = 1;
        let litera = $('#litera').val();

        if(cuvantModificat==null && cuvantOriginal==null){
            alert('Trebuie sa incepi jocul');
        }else {

            for(let i = 1; i<cuvantOriginal.length-1; i++){
                if(cuvantOriginal[i]===litera.toUpperCase()){
                    ghicit = 1;
                    cuvantModificat[i] = litera.toUpperCase();
                }
                if(cuvantModificat[i]==='_'){
                    terminat=0;
                }
            }

            if(ghicit === 1){
                $('#cuvant').val(cuvantModificat.join(" "));
            }
            else{
                incercari++;
                $('#incercari').html('<b>Incercari: </b>'+incercari);
            }
        }
        $('#litera').val('');

        if(terminat===1){
            $('#level').css('visibility', 'visible');
        }
    }

    function nextLevel() {
        if(wordSize===7){
            $('#start').val('Restart game');
            $('#saveScore').css('visibility', 'visible');
            Clock.pause();
        }
        else {
            wordSize++;
            newWord(wordSize);
            $('#level').css('visibility', 'hidden');
        }
    }
</script>

</body>
</html>
