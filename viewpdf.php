<?php
session_start();
if (!$_SESSION['logged_in']) {
    header("Location: login.php");
    exit;
}
echo '<iframe src="https://docs.google.com/gview?url=http://103.31.46.133/dmanager/file/"'.$_POST['file'].'"&embedded=true" style="width:100%; height:760px;" frameborder="0"></iframe>';
// echo 'https://docs.google.com/gview?url=http://103.31.46.133/dmanager/file/'.$_POST['file'];
?>