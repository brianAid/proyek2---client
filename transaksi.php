<?php
$judul = "Transaksi";
require 'tugas.php';
?>
<?php
$rightnavbar = '
    <a id="menu_open" onclick="transaksiOpen()" class="btn w-24 bg-red-500 hover:bg-red-700 text-white m-1" onclick="toggleMenu()">Buy</a>
';

?>
<?php
include("./components/header.php")
?>
<div class="overlay d-none" id="overlay"></div>
<div id="alert" class="alert top-0 fixed right-0" style="z-index:100000 ;"></div>
<div class="content-wrapper">
  <div class="content">
    <div class="box-default mt-2 box py-6">
      <div class="searchpage mx-3 gap-1 content-center flex-wrap text-center sm:flex justify-evenly">
        <!-- search form -->
        <form action="">
          <input type="text" name="keyword" autocomplete="off" placeholder="masukan nama" id="keyword">
        </form>
        <!-- checklist -->
        <form action="">
          <label><input id="makanan" type="checkbox" name="kategori" checked value="makanan"> makanan</label>
          <label><input id="minuman" type="checkbox" name="kategori" checked value="minuman"> minuman</label>
        </form>
      </div>
      <script src="./src/js/alert.js"></script>
      <div id="container" class="py-4 container-fluid">
      </div>
    </div>
  </div>


  <?php
  include("./components/footer.php")
  ?>
  <script src="./src/js/ajax_transaksi.js"></script>