<?php
require "./tugas.php";
$data = query("select * from detail_transaksi detail_transaksi inner join menu where menu.menu_id = detail_transaksi.menu_id and transaksi_id=$_GET[id]");
?>
<?php $no = 1;
?>

<div class="box box-info col-md-12">
  <div class="box-header with-border">
    <h3 class="box-title">Tanggal detail : <?= $_GET['tanggal'] ?></h3>
    <div class="box-tools pull-right">
      <button class="bg-white border border-gray-300 p-2 rounded-full hover:bg-gray-100" id="clearContainer" onclick="document.getElementById('clearContainer').parentElement.parentElement.parentElement.parentElement.innerHTML='';"><ion-icon name="close"></ion-icon></button>
      </button>
    </div>
    <div class="box-body">
      <table class="table table-striped-columns ">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>jumlah</th>
            <th>Harga(satuan)</th>
            <th>Harga Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($data as $d) {
          ?>
            <tr>
              <td><?= $no; ?></td>
              <td><?= $d['nama'] ?></td>
              <td><?= $d['jumlah'] ?></td>
              <td><?= $d['harga'] ?></td>
              <td><?= $d['harga'] * $d['jumlah'] ?></td>
            </tr>
          <?php
            $no++;
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>