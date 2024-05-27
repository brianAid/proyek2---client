<?php
require "../tugas.php";
if (!empty($_POST['idtransaksi'])) {
  $id = $_POST['idtransaksi'];
  // select harga
  $hargas = mysqli_query($koneksi, "Select harga from menu where menu_id='$id'");
  $harga = mysqli_fetch_column($hargas);
  if (empty($harga)) {
  } else {
    // if ada transaksi
    $transaksi = mysqli_query($koneksi, "select * from transaksi where status = 'progress'");
    $dt = mysqli_fetch_assoc($transaksi);
    if ($transaksi->num_rows == 1) {
      $exist = mysqli_query($koneksi, "select * from detail_transaksi where transaksi_id = '$dt[transaksi_id]' and menu_id='$id'");
      if ($exist->num_rows == 1) {
        mysqli_query($koneksi, "update detail_transaksi SET jumlah = jumlah +1 where transaksi_id = '$dt[transaksi_id]' and menu_id='$id'");
        if (mysqli_affected_rows($koneksi) > 0) {
          ?>
        <script>
          alertP("success", "berhasil menambah transaksi")
        </script>
      <?php
        }
      } else {
        $query = mysqli_query($koneksi, "INSERT INTO detail_transaksi(transaksi_id,menu_id,jumlah ,harga) VALUES ($dt[transaksi_id], $id, 1, $harga)");
        if (mysqli_affected_rows($koneksi) > 0) {
          ?>
        <script>
          alertP("success", "berhasil menambah transaksi")
        </script>
      <?php
        }
      }
      // tidak ada transaksi
    } else {
      $query = mysqli_query($koneksi, "INSERT INTO transaksi(total_harga,tanggal_transaksi,status) VALUES('','','progress')");
      $transaksi = mysqli_query($koneksi, "select * from transaksi where status = 'progress'");
      $dt = mysqli_fetch_assoc($transaksi);
      mysqli_query($koneksi, "INSERT INTO detail_transaksi(transaksi_id,menu_id,jumlah ,harga) VALUES ($dt[transaksi_id], $id, 1, $harga)");
      if (mysqli_affected_rows($koneksi) > 0) {
        ?>
      <script>
        alertP("success", "berhasil menambah transaksi")
      </script>
    <?php
      }
    }
  }
}