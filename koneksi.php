<?php 
define('HOST','192.168.4.77');
define('USER','root');
define('PASS','hanyaadminyangtau');
define('DB','document_manager');

$con = mysqli_connect(HOST,USER,PASS,DB) or die ('gagal konek ke database');

?>
