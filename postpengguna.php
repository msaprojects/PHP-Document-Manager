<?php
header('Location: datapengguna.php');
   $profile = "192.168.4.77:8989/useri";
    // $profile = "192.168.4.77:8989/userd";

    $ch = curl_init($profile);

    if ($_POST['aktif'] != ""){
        $value = 1;
    }else{
        $value =0 ;
    }

    $basedata = array(
        'iduser'=>(int)$_POST['id'],
        'nama'=> $_POST['nama'],
        'jabatan'=> $_POST['jabatan'],
        'password'=> $_POST['password'],
        'aktif'=> 1

        // 'aktif'=> 1
    );

    $de = json_encode($basedata);
    
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $de);
    //curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
    
    $server_output = curl_exec($ch);
    //echo $basedata;
    return $server_output;
    echo $server_output;

?>
