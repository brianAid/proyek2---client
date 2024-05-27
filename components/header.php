<?php
date_default_timezone_set('Asia/Jakarta');
?>
<!DOCTYPE html>
<html style="height: auto; min-height: 100%;">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Website Kelompok 1">
  <link rel="icon" type="image/x-icon" href="./img/icon.png">
  <title><?= $judul ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="prefetch">
  <link rel="stylesheet" href="./src/style/bootstrap.min.css">
  <link rel="stylesheet" href="./src/style/AdminLTE.min.css">
  <link rel="stylesheet" href="./src/style/output.css">
  <link rel="stylesheet" href="./src/style/style.css">
  <link rel="stylesheet" href="./src/style/_all-skins.min.css"> <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
  <script src="./src/chart.js/dist/chart.umd.js"></script>

<body class=" skin-black sidebar-mini sidebar-open" style="height: auto; min-height: 100%;">
  <div class="wrapper" style="height: auto; min-height: 100%;">
    <header class=" main-header">
      <a class="translate-y-48 logo md:fixed" onclick="toggler()" data-toggle="push-menu" role="button" style="background: var(--sidebar-bg);
    color: inherit;" href="#" role="button">
        <span class="logo-mini"><ion-icon class="h-10 mt-2 text-white " name="menu"></ion-icon></span>
        <h2 class="logo-lg m-0 text-center">Akutansi</h2>
      </a>
      <nav class=" navbar navbar-static-top">
        <div>
          <a href="#" class="ml-10 " onclick="toggler()" data-toggle="push-menu" role="button">
            <ion-icon class="text-black " name="menu"></ion-icon>
          </a>
          <h1><?= $judul ?>
          </h1>
        </div>
        <div class="right-navbar pr-6">
          <?php if (isset($rightnavbar)) {
            echo $rightnavbar;
          } ?>
        </div>
      </nav>
    </header>
    <aside class="main-sidebar fixed">
      <section class="sidebar" style="height: auto;">
        <ul class=" sidebar-menu tree" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <li>
            <a href="./index.php"><ion-icon class="" name="folder"></ion-icon>
              <span>DASHBOARD</span>
            </a>
          </li>
          <li>
            <a href="./menu.php"><ion-icon class="" name="fast-food"></ion-icon>
              <span>MENU</span>
            </a>
          </li>
          <li class="treeview">
            <a href="#">
              <ion-icon name="cart"></ion-icon> <span>TRANSAKSI</span>
              <span class="pull-right-container">
                <ion-icon class="dropdown" name="chevron-back"></ion-icon>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class=""><a href="transaksi.php"><ion-icon style="font-size: smaller;margin-right:0.3em;" name="radio-button-off"></ion-icon> PEMASUKAN</a></li>
              <li><a href="transaksi_pengeluaran.php"><ion-icon style="font-size: smaller;margin-right:0.3em;" name="radio-button-off"></ion-icon> PENGELUARAN</a></li>
            </ul>
          </li>
          <li>
            <a href="./laporan.php"><ion-icon class="" name="document"></ion-icon>
              <span>LAPORAN</span>
            </a>
          </li>
        </ul>
      </section>
    </aside>