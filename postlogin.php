<?php
    session_start();
   $profile = "192.168.4.77:8989/login";       
    $ch = curl_init($profile);

    $basedata = array(
        'nama'=> $_POST['nama'],
        'password'=> $_POST['password']
    );

   
    $de = json_encode($basedata);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $de);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
    
    $response = curl_exec($ch);
    $dee = json_decode($response, true);
    // die($dee[0]['nama']);

    // echo $server_output[0]["iduser"];
    // echo "----".$dee;
    // echo "----".$dee[0]['message'];
    if ($dee[0]['nama']!=""){
        $_SESSION['sesi_nama'] = $dee[0]['nama'];
        $_SESSION['sesi_jabatan'] = $dee[0]['jabatan'];
        $_SESSION['logged_in'] = "true";
        header('Location: dashboard.php');
    }else{
        header('Location: login.php');
    }
    // echo "-----".json_decode($server_output, TRUE);
    // return $server_output;

?>