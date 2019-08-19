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
    
    $profile = http_request("localhost:8989/dashboard");
    $profile2 = http_request("localhost:8989/transaksidashboard");
    $profile3 = http_request("localhost:8989/transaksiblmaccfinance");
    $de = json_decode($profile, true);
    $de2 = json_decode($profile2, true);
    $de3 = json_decode($profile3, true);


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
    <title>Analytics Dashboard - This is an example dashboard created using build-in elements and components.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
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
<link href="./main.css" rel="stylesheet"></head>
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
                            <input type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div>
                    <ul class="header-menu nav">
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-database"> </i>
                                Log
                            </a>
                        </li>
                        <li class="dropdown nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-cog"></i>
                                Pengaturan
                            </a>
                        </li>
                    </ul>        
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
                                        ?>
                                    </div>
                                    <div class="widget-subheading">
                                        <?php echo $_SESSION['sesi_jabatan']; ?>
                                    </div>
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
                </div>    <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">Dashboards</li>
                            <li class="mm-active">
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
                            <li>
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
                    <div class="row">
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-midnight-bloom">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Total Dokumen</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span><?php echo $de['Result'][0]['jmlberkas'] ?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-arielle-smile">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Total Dokumen Publish</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span><?php echo $de['Result'][0]['jmlpublish'] ?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-grow-early">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Total Dokumen Yang Belum Acc Finance</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span><?php echo $de['Result'][0]['jmltgsfinance'] ?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-header">Dokumen Yang Sudah Publish
                                    <div class="btn-actions-pane-right">
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nama Tes</th>
                                            <th class="text-center">Tanggal Tes</th>
                                            <th class="text-center">Peminta Tes</th>
                                            <th class="text-center">Biaya</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $i=1;
                                            foreach ($de2["Result"] as $data => $d) :
                                        ?>
                                        <tr>
                                        <td class="text-center text-muted"><?php echo $i; $i++?></td>
                                        <td class="text-left"><?php echo $d["nama_tes"]?></td>
                                        <td class="text-center"><?php echo $d["tgl_tes"]?></td>
                                        <td class="text-left"><?php echo $d["peminta_tes"]?></td>
                                        <td class="text-right"><?php echo $d["finance_biaya"]?></td>
                                        <?php if(!empty($d["file"]["String"])){ ?>
                                            <td class="text-center">
                                                <a href="./file/<?php echo $d['file']['String']?>">Download</a>
                                            </td>
                                        <?php } else { ?>
                                        <?php } ?>
                                        </tr>
                                        <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-block text-center card-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-header">Dokumen Yang Belum Acc Finance
                                    <div class="btn-actions-pane-right">
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nama Tes</th>
                                            <th class="text-center">Tanggal Tes</th>
                                            <th class="text-center">Peminta Tes</th>
                                            <th class="text-center">Biaya</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $i=1;
                                            foreach ($de3["Result"] as $data => $d) :
                                        ?>
                                        <tr>
                                        <td class="text-center text-muted"><?php echo $i; $i++?></td>
                                        <td class="text-left"><?php echo $d["nama_tes"]?></td>
                                        <td class="text-center"><?php echo $d["tgl_tes"]?></td>
                                        <td class="text-left"><?php echo $d["peminta_tes"]?></td>
                                        <td class="text-right"><?php echo $d["finance_biaya"]?></td>
                                        <td class="text-center">
                                            <button type="button" id="PopoverCustomT-4" onclick="datatransaksi.php" class="btn btn-danger btn-sm">Acc Sekarang</button>
                                        </td>
                                        </tr>
                                        <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-block text-center card-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
<script type="text/javascript" src="./assets/scripts/main.js"></script>
</body>
</html>
