<?php
require "../tugas.php";
if (!empty($_POST['jumlah'])) {
  $detail_transaksi = mysqli_query($koneksi, "Select * from detail_transaksi where dt_id = '$_POST[id]'");
  if (mysqli_num_rows($detail_transaksi) > 0) {
    mysqli_query($koneksi, "update detail_transaksi set jumlah='$_POST[jumlah]' where dt_id='$_POST[id]'");
    if (mysqli_affected_rows($koneksi) > 0) { ?>
    <script>
      alertP("success", "berhasil mengubah jumlah barang")
    </script>
  <?php }
  }
}