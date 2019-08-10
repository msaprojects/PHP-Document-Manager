<?php
    header('Location: datatransaksi.php');
    $profile = "localhost:8989/transaksid";

    $ch = curl_init($profile);

    $basedata = array(
        'idtransaksi'=>$_POST['idtransaksi']
    );

    $de = json_encode($basedata);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $de);
    
    $server_output = curl_exec($ch);
    
    return $server_output;
    
?>