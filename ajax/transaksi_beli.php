<?php
require "../tugas.php";
if (!empty($_GET['tanggal'])) {
  bayar($_GET['tanggal']);
  if (mysqli_affected_rows($koneksi) > 0) {
?>
    <script>
      alertP("success", "berhasil menambah transaksi")
    </script>
  <?php
  }
} elseif (isset($_GET['tanggal'])) { ?>
  <script>
    alertP("error", "Masukan tanggal terlebih dahulu")
  </script>
<?php }
?>