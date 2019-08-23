<?php
// header('Location: datatransaksi.php');
   $profile = "192.168.4.77:8989/transaksiu";

    $ch = curl_init($profile);
    
    $basedata = array(
        'idtransaksi'=> $_POST['id'],
        'nama_tes'=> $_POST['nama_tes'],
        'keterangan'=> $_POST['keterangan'],
        'tgl_tes'=> $_POST['tgl_tes'],
        'lokasi'=> $_POST['lokasi'],
        'peminta_tes'=> $_POST['peminta_tes'],
        'customer'=> $_POST['customer'],
        'finance_tgl'=> $_POST['finance_tgl'],
        'finance_biaya'=> $_POST['finance_biaya'],
        'status'=> $_POST['status'],
        'iduser'=> 1
    );
    
    $de = json_encode($basedata);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $de);
    $server_output = curl_exec($ch);
    return $server_output;

?>