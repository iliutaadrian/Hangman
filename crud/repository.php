<?php

include '../util/mysqli_connect.php';

if(isset($_POST['key'])){
    if($_POST['key']=='findAll'){
        $stmt = $mysqli->query("SELECT * FROM cuvant");

        if($stmt->num_rows > 0){
            $response = '<tbody id="tbodyid">';
            while($data = $stmt->fetch_array()){
                $response .= '
                    <tr>
                        <td>'.$data['cuvant'].'</td>
                    </tr>
                ';
            }
            $response .='</tbody>';
            exit($response);
        }
    }

    if($_POST['key']=='addRow'){
        $stmt = $mysqli->prepare("INSERT INTO cuvant (cuvant, dimensiune) VALUES (?, ?)");
        $word = strip_tags($mysqli->real_escape_string($_POST['cuvant']));
        $stmt->bind_param("si",$word,strlen($word));
        $stmt->execute();
    }
}