<?php
require "../tugas.php";

if (!empty($_POST['delete'])) {
  $d = mysqli_query($koneksi, "DELETE FROM detail_transaksi WHERE dt_id=$_POST[delete]");
  if (mysqli_affected_rows($koneksi) > 0) {
?>
    <script>
      alertP("error", "berhasil menghapus data");
    </script>
<?php
  }
}
?>