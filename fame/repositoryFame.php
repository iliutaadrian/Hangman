<?php

include '../util/mysqli_connect.php';

if(isset($_POST['key'])) {
    if ($_POST['key'] == 'findAll') {
        $stmt = $mysqli->query("SELECT * FROM clasament order by timp");
        if ($stmt->num_rows > 0) {
            $response = '<tbody>';
            while ($data = $stmt->fetch_array()) {
                $response .= '
                    <tr>
                        <td>' . $data['nume'] . '</td>
                        <td>' . $data['timp'] . '</td>
                        <td>' . $data['incercari'] . '</td>
                    </tr>
                ';
            }
            $response .= '</tbody>';
            exit($response);
        }
    }
}