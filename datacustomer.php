<?php
    session_start();
    if (!$_SESSION['logged_in']) {
        header("Location: login.php");
        exit;
    }

function http_request($url){
    // persiapkan curl
    $ch = curl_init(); 

    // set url 
    curl_setopt($ch, CURLOPT_URL, $url);
    
    // set user agent    
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

    // return the transfer as a string 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $output = curl_exec($ch); 
    if ($output===FALSE)
        echo curl_error($ch);
    else
    curl_close($ch);      

    return $output;
}

$profile = http_request("192.168.4.77:8989/customer");
$de = json_decode($profile, true);
$de1 = json_decode($profile, true);


if($_SESSION['sesi_jabatan'] == "User"){ 
    $finance = "DISABLED";
    $admin = "DISABLED";
    $user = "";
    $menupengguna = "#";
    $menucustomer = "datacustomer.php";
    $menutransaksi = "datatransaksi.php"; 
} 
elseif ($_SESSION['sesi_jabatan'] == "Finance") { 
    $finance = "";
    $admin = "DISABLED";
    $user = "DISABLED";
    $menupengguna = "#";
    $menucustomer = "#";
    $menutransaksi = "datatransaksi.php"; 
} 
elseif ($_SESSION['sesi_jabatan'] == "Admin") { 
    $finance = "";
    $admin = "";
    $user = ""; 
    $menupengguna = "datapengguna.php";
    $menucustomer = "datacustomer.php";
    $menutransaksi = "datatransaksi.php"; 
}
    
?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Data Tabel Customer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Tables are the backbone of almost all web applications.">
    <meta name="msapplication-tap-highlight" content="no">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
<link href="./main.css" rel="stylesheet">
<script src="https://cdn.zinggrid.com/zinggrid.min.js"></script>
</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>    <div class="app-header__content">
                <div class="app-header-left">
                    <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Cari">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div>
                    </div>
                <div class="app-header-right">
                <div class="header-btn-lg pr-0">
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="btn-group">
                                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                        <img width="42" class="rounded-circle" src="assets/images/avatars/logo.jpg" alt="">
                                        <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                    </a>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                        <div tabindex="-1" class="dropdown-divider"></div>
                                        <button type="button" tabindex="0" class="dropdown-item" onclick="location.href='logout.php'">Logout</button>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-cont ent-left  ml-3 header-user-info">
                                <div class="widget-heading">
                                    <?php
                                        echo $_SESSION['sesi_nama'];
                                        //echo $_SESSION['logged_in'];
                                    ?>
                                </div>
                                <div class="widget-subheading">
                                    <?php echo $_SESSION['sesi_jabatan']; ?>
                                </div>
                            </div>
                            <div class="widget-content-right header-user-info ml-3">
                                <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
                                    <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                                </button>
                            </div>
                        </div>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>    
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">Dashboards</li>
                            <li>
                                <a href="dashboard.php">
                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $menupengguna;?>">
                                    <i class="metismenu-icon pe-7s-user"></i>
                                    Data Pengguna
                                </a>
                            </li>
                            <li class="mm-active">
                            <a href="<?php echo $menucustomer;?>">
                                    <i class="metismenu-icon pe-7s-display2"></i>
                                    Data Customer
                                </a>
                            </li>
                            <li>
                            <a href="<?php echo $menutransaksi;?>">
                                    <i class="metismenu-icon pe-7s-display2"></i>
                                    Document Manager
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>    
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <i class="pe-7s-drawer icon-gradient bg-happy-itmeo">
                                        </i>
                                    </div>
                                    <div>Data Tabel Customer
                                        <div class="page-title-subheading">List Customer
                                        </div>
                                    </div>
                                </div>
                                <div class="page-title-actions">
                                    <div class="d-inline-block dropdown">
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a href="javascript:void(0);" class="nav-link">
                                                        <i class="nav-link-icon lnr-inbox"></i>
                                                        <span>
                                                            Inbox
                                                        </span>
                                                        <div class="ml-auto badge badge-pill badge-secondary">86</div>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="javascript:void(0);" class="nav-link">
                                                        <i class="nav-link-icon lnr-book"></i>
                                                        <span>
                                                            Book
                                                        </span>
                                                        <div class="ml-auto badge badge-pill badge-danger">5</div>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="javascript:void(0);" class="nav-link">
                                                        <i class="nav-link-icon lnr-picture"></i>
                                                        <span>
                                                            Picture
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a disabled href="javascript:void(0);" class="nav-link disabled">
                                                        <i class="nav-link-icon lnr-file-empty"></i>
                                                        <span>
                                                            File Disabled
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div>            
                        <div class="row">
                            <div class="col-lg-12">
                            <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
                                <li class="nav-item">
                                        <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Data Customer</button>
                                </li>
                            </ul>
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title">Data Customer</h5>
                                        <table class="mb-0 table">
                                            <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Alamat</th>
                                                <th class="text-center">No. Telp</th>
                                                <th class="text-center">CP</th>
                                                <th class="text-center">Aktif</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>    
                                            <?php
                                                $i=1;
                                                foreach ($de["Result"] as $data => $d) :
                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo $i; $i++ ?></th>
                                                <td class="text-left"><?php echo $d["nama"]?></td>
                                                <td class="text-left"><?php echo $d["alamat"] ?></td>
                                                <td class="text-left"><?php echo $d["notelp"] ?></td>
                                                <td class="text-left"><?php echo $d["cp"] ?></td>
                                                <td class="text-center">
                                                    <div name="aktif" class="custom-checkbox custom-control">
                                                    <input name="aktif" value="1" type="checkbox" id="exampleCustomCheckbox2" class="custom-control-input" <?php if($d["aktif"]==1){?>checked="checked"<?php } ?> disabled>
                                                        <label class="custom-control-label" for="exampleCustomCheckbox2">Aktif</label>
                                                    </div>
                                                </td>
                                                <th>
                                                    <form method="post">
                                                        <button type="button" data-toggle="modal" class="btn btn-primary" name="iduser" type="submit"  data-target=".modal-edit<?php echo $d["idcustomer"]; ?>">Edit</button>
                                                    </form>
                                                    <form action="deletecustomer.php" method="post">
                                                        <button class="btn btn-danger" name="idcustomer" value="<?php echo $d["idcustomer"]?>" type="submit">Hapus</button>
                                                    </form>
                                                </th>

                                            </tr>
                                            <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
<script type="text/javascript" src="./assets/scripts/main.js"></script></body>
</html>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form method="post" action='postcustomer.php'>
                    <div class="position-relative form-group"><label for="exampleEmail" class="">Nama</label>
                        <input name="nama" placeholder="ketik nama anda disini..." type="text" class="form-control" required>
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Alamat</label>
                        <input name="alamat" placeholder="ketik Alamat anda disini..." type="text" class="form-control" required>
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">No Telp</label>
                        <input name="notelp" placeholder="ketik No.Telp anda disini..." type="number" class="form-control" required>
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Contact Person</label>
                        <input name="cp" placeholder="ketik Contact Person anda disini..." type="text" class="form-control" required>
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Kode Sistem</label>
                        <input name="kdsistem" placeholder="ketik Kode Sistem anda disini..." type="text" class="form-control" required>
                    </div>
                    <div class="position-relative form-group">
                        <div name="aktif" class="custom-checkbox custom-control">
                            <input name="aktif" value="1" type="checkbox" id="exampleCustomCheckbox2" class="custom-control-input">
                            <label class="custom-control-label" for="exampleCustomCheckbox2">Aktif</label>
                        </div>
                    </div>
                        <br>
                        <button class="mt-1 btn btn-primary" type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    foreach ($de["Result"] as $data => $d) :
?>

 <!-- MODAL PENGGUNA -->
 <div class="modal fade modal-edit<?php echo $d['idcustomer']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="editcustomer.php">    
                    <input name="id" value="<?php echo $d['idcustomer'] ?>" style="display:none">
                    <div class="position-relative form-group"><label for="exampleEmail" class="">Nama</label>
                        <input name="nama" value="<?php echo $d['nama'] ?>" placeholder="ketik nama anda disini..." type="text" class="form-control" required>
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Alamat</label>
                        <input name="alamat" value="<?php echo $d['alamat'] ?>" placeholder="ketik Alamat anda disini..." type="text" class="form-control" required>
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">No Telp</label>
                        <input name="notelp" value="<?php echo $d['notelp'] ?>" placeholder="ketik No.Telp anda disini..." type="number" class="form-control" required>
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Contact Person</label>
                        <input name="cp" value="<?php echo $d['cp'] ?>" placeholder="ketik Contact Person anda disini..." type="text" class="form-control" required>
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Kode Sistem</label>
                        <input name="kdsistem" value="<?php echo $d['kodesistem'] ?>" placeholder="ketik Kode Sistem anda disini..." type="text" class="form-control" required>
                    </div>
                    <div class="position-relative form-group">
                        <div name="aktif" class="custom-checkbox custom-control">
                            <input name="aktif" value="1" type="checkbox" id="exampleCustomCheckbox2" class="custom-control-input" checked>
                            <label class="custom-control-label" for="exampleCustomCheckbox2">Aktif</label>
                        </div>
                    </div>
                        <br>
                        <button class="mt-1 btn btn-primary" type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL PENGGUNA -->

<?php endforeach ?>
