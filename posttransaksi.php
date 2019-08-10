<?php
header('Location: datatransaksi.php');
   $profile = "localhost:8989/transaksii";

    $ch = curl_init($profile);
    
    $basedata = array(
        'nama_tes'=> $_POST['nama_tes'],
        'keterangan'=> $_POST['keterangan'],
        'tgl_tes'=> $_POST['tgl_tes'],
        'lokasi'=> $_POST['lokasi'],
        'peminta_tes'=> $_POST['peminta_tes'],
        'idcustomer'=> (int)$_POST['customer'],
        'finance_tgl'=> $_POST['finance_tgl'],
        'finance_biaya'=> $_POST['finance_biaya'],
        'status'=> $_POST['status'],
        'iduser'=>1
    );

    print $_POST['nama_tes'].$_POST['keterangan'].$_POST['tgl_tes'].$_POST['lokasi'].$_POST['peminta_tes'].(int)$_POST['customer'].$_POST['finance_tgl'].$_POST['finance_biaya'].$_POST['status'];

    $de = json_encode($basedata);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $de);
    $server_output = curl_exec($ch);
    return $server_output;

?>