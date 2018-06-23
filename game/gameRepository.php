<?php

include '../util/mysqli_connect.php';

if(isset($_POST['key'])) {

    if ($_POST['key'] == 'newWord') {
        $size = $_POST['size'];
        $stmt = $mysqli->query("SELECT cuvant FROM cuvant where dimensiune=$size ORDER BY RAND() LIMIT 1");

        $data = $stmt->fetch_assoc();

        exit($data['cuvant']);
    }

    if($_POST['key']=='save'){
        $stmt = $mysqli->prepare("INSERT INTO clasament (nume, timp, incercari) VALUES (?,?,?)");
        $name = strip_tags($mysqli->real_escape_string($_POST['name']));
        $timp = strip_tags($mysqli->real_escape_string($_POST['time']));
        $incercari = strip_tags($mysqli->real_escape_string($_POST['try']));

        $stmt->bind_param("sss",$name,$timp, $incercari);
        $stmt->execute();

        exit('Saved successfully!');
    }
}
