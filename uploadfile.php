<?php 

    include 'koneksi.php';
    $id = $_POST['id'];

    // $ekstensi_diperbolehkan	= array('pdf', 'jpg', 'jpeg');
    $nama = $_FILES['file']['name'];
    $x = explode('.', $nama);
    $ekstensi = strtolower(end($x));
    $ukuran	= $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];	

    // if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
        // if($ukuran < 10485760){			
            move_uploaded_file($file_tmp, 'file/'.$nama);
            $query = mysqli_query($con, "UPDATE transaksi set file = '$nama' WHERE idtransaksi=$id;");
            if($query){
                echo 'FILE BERHASIL DI UPLOAD';
                header('Location: datatransaksi.php');
            }else{
                echo 'GAGAL MENGUPLOAD GAMBAR';
                echo '<Ulangi Lagi>';
            }
        // }else{
        //     echo 'UKURAN FILE TERLALU BESAR';
        // }
    // }else{
    //     echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
    // }

?>