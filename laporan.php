<?php
$judul = "Laporan";
require "./components/header.php";
include "./tugas.php";
?>
<?php

?>
<div id="alert" class="alert top-0 fixed right-0" style="z-index:100000 ;"></div>
<script src="src/js/alert.js">
</script>
<?php
if (!empty($_GET['deletetransaksi'])) {
  mysqli_query($koneksi, "delete from transaksi where transaksi_id='$_GET[deletetransaksi]'");
  if (mysqli_affected_rows($koneksi) > 0) { ?>
    <script>
      alertP("success", "berhasil menghapus transaksi")
    </script>
  <?php }
}
if (!empty($_GET['deletepengeluaran'])) {
  mysqli_query($koneksi, "delete from pengeluaran where pengeluaran_id = '$_GET[deletepengeluaran]'");
  if (mysqli_affected_rows($koneksi) > 0) { ?>
    <script>
      alertP("success", "berhasil menghapus transaksi")
    </script>
<?php }
}
?>
<div class="content-wrapper">
  <div class="content">
    <section class="content">
      <div class="row">
        <section class="col-lg-12">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Filter Laporan</h3>
            </div>
            <div class="box-body">
              <form method="get" action="">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Mulai Tanggal:</label>
                      <input autocomplete="off" type="date" id="tanggal_awal" name="tanggal_awal" class="form-control" required="required" value="<?= date('Y-m-d'); ?>">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group ">
                      <label>Sampai Tanggal:</label>
                      <input autocomplete="off" type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control" required="required" value="<?= date('Y-m-d', strtotime('tomorrow')); ?>">
                    </div>
                  </div>
                  <div class="col-md-4 text-center">
                    <div class="form-group">
                      <br>
                      <input type="submit" value="TAMPILKAN" class="btn btn-sm btn-primary btn-block">
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Laporan Pemasukan &amp; Pegeluaran</h3>
            </div>
            <div class="box-body">

              <?php
              if (!empty($_GET['tanggal_awal']) and !empty($_GET['tanggal_akhir'])) {
                $data = query("
                  (SELECT 'pemasukan' as type,transaksi_id as id,tanggal_transaksi as tanggal,total_harga as nominal,status FROM transaksi WHERE status='end' and tanggal_transaksi >= '$_GET[tanggal_awal]' and tanggal_transaksi <= '$_GET[tanggal_akhir]') UNION ALL
                  (SELECT 'pengeluaran' as type,pengeluaran_id as id,tanggal,nominal,deskripsi as status FROM pengeluaran WHERE tanggal >= '$_GET[tanggal_awal]' and tanggal <= '$_GET[tanggal_akhir]')
                  ORDER BY tanggal
                  ");
                  if($data !=null){
              ?>
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th width="1%" class="">NO</th>
                        <th class="text-center">TANGGAL</th>
                        <th class="text-center">KETERANGAN</th>
                        <th class="text-center">JENIS</th>
                        <th class="text-center">PEMASUKAN</th>
                        <th class="text-center">PENGELUARAN</th>
                        <th class="text-center">DELETE</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;
                      $pemasukan = 0;
                      $pengeluaran = 0;
                      foreach ($data as $d) { ?>
                        <tr>
                          <td class="text-center"><?= $no ?></td>
                          <td class="text-center"><?= $d['tanggal']; ?></td>
                          <?php if ($d['type'] == 'pemasukan') { ?>
                            <td class=''><a class="text-blue-600" onclick='ajax(<?= $d['id'] ?>, "<?= $d['tanggal'] ?>")' class='link'>Lihat detail</a></td>
                          <?php } elseif ($d['type'] == 'pengeluaran') { ?>
                            <td><?= $d['status'] ?></td>
                          <?php } ?>
                          <td class="text-center"><?= $d['type'] ?></td>
                          <?php
                          if ($d['type'] == "pemasukan") {
                            $pemasukan += $d['nominal'];
                          ?>
                            <td class="text-center"><?= "Rp. " . str_replace(',', '.', number_format($d['nominal'])); ?></td>
                            <td class="text-center">- </td>
                            <td class="text-center"><a href="laporan.php?deletetransaksi=<?= $d['id'] ?>&tanggal_awal=<?= $_GET['tanggal_awal'] ?>&tanggal_akhir=<?= $_GET['tanggal_akhir'] ?>"><ion-icon class="text-red-600" size="large" name="trash"></ion-icon></a></td>
                        </tr>
                      <?php } elseif ($d['type'] == "pengeluaran") {
                            $pengeluaran += $d['nominal']; ?>
                        <td class="text-center">- </td>
                        <td class="text-center"><?= "Rp. " . str_replace(',', '.', number_format($d['nominal'])); ?></td>
                        <td class="text-center"><a href="laporan.php?deletepengeluaran=<?= $d['id'] ?>&tanggal_awal=<?= $_GET['tanggal_awal'] ?>&tanggal_akhir=<?= $_GET['tanggal_akhir'] ?>"><ion-icon class="text-red-600" size="large" name="trash"></ion-icon></a></td>
                        </tr>
                      <?php }
                      ?>
                    <?php $no++;
                      } ?>
                    <tr>
                      <th colspan="4" class="text-right">TOTAL</th>
                      <td class="text-center text-bold text-success"><?= "Rp. " . str_replace(',', '.', number_format($pemasukan)); ?></td>
                      <td class="text-center text-bold text-danger"><?= "Rp. " . str_replace(',', '.', number_format($pengeluaran)); ?></td>
                    </tr>
                    <tr>
                      <th colspan="4" class="text-right">SALDO</th>
                      <td colspan="2" class="text-center text-bold text-white bg-primary"><?= "Rp. " . str_replace(',', '.', number_format($pemasukan - $pengeluaran)); ?></td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              <?php 
                }
                else{ ?>
                  <div class="alert text-center alert-link ">Tidak ada transaksi pada tanggal tersebut</div>
              <?php  }
              } else {
              ?>
                <div id="laporan" class="alert alert-info text-center">
                  Silahkan Filter Laporan Terlebih Dulu.
                <?php
              }
                ?>
                </div>

            </div>
          </div>
          <div id="container" class="card">
          </div>
      </div>
      <script>
        function ajax(id, tanggal) {
          var xhr = new XMLHttpRequest();
          xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
              document.getElementById('container').innerHTML = xhr.responseText;
            }
          };
          xhr.open('GET', 'detail.php?id=' + id + '&tanggal=' + tanggal, true);
          xhr.send();
        }

        function close() {
          document.getElementById("container").innerHTML = "";
        }
      </script>
    </section>
    </section>
  </div>
</div>
<?php
require "./components/footer.php"
?>