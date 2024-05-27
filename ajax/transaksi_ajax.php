<?php
require "../tugas.php";
if (!empty($_GET)) {
  $keyword = $_GET['keyword'];
  $makanan = $_GET['makanan'];
  $minuman = $_GET['minuman'];
  $halaman = $_GET['halaman'];
  $datas = searchdataandpagination($keyword, $makanan, $minuman, $halaman);
  $jumlahHalaman = $datas['jumlahHalaman'];
  $data = $datas['data'];
  $halamanaktif = $halaman;
}

$idtransaksi = mysqli_fetch_column(mysqli_query($koneksi, "select transaksi_id from transaksi where status='progress'"));
$transaksi = query("select detail_transaksi.dt_id,detail_transaksi.jumlah,detail_transaksi.harga,menu.nama from detail_transaksi inner join menu on menu.menu_id =detail_transaksi.menu_id where transaksi_id='$idtransaksi'");

?>
<div class="gridwrapper content-stretch">
  <?php if (!empty($data)) {
    foreach ($data as $d) {
  ?>
      <div class="boxgrid boxgridBg w-56">
        <img class="img card-img-top" loading="lazy" src="./img/<?= $d['ikon'] ?>" alt="none" />
        <div class="px-3 py-2 card-body  container text-center">
          <h5 class=" h4 min-h-fit max-h-fit card-title" style="font-weight: bolder"><?= $d['nama'] ?></h5>
          <p class="h6 pt-1 card-text">Rp.<?= $d['harga'] ?></p>
        </div>
        <div class="px-2 mb-3">
          <a class=" p-3 h5 bg-blue-800 card-footer w-full rounded button"     onclick="ajaxBeli(<?= $d['menu_id'] ?>)"><ion-icon class="align-middle" name="cart"></ion-icon> buy now</a>
        </div>
      </div>
    <?php }
  } else { ?>
    <center>
      <h1>data tidak ditemukan</h1>
    </center>
  <?php } ?>
</div>
<nav class="mt-5 navigation" aria-label="Page navigation example">
  <ul class="justify-center pagination">
    <?php if ($halamanaktif > 1) { ?>
      <li onclick="paginate(<?= $halamanaktif - 1 ?>)" class="page-item"><a class="page-link" href="#">Previous</a></li>
    <?php } ?>

    <?php for ($i = 1; $i <= $jumlahHalaman; $i++) { ?>
      <?php if ($i == $halamanaktif) : ?>
        <li class="page-item active  font-bold" disabled onclick="paginate('<?= $i ?>')" type="button"><a class="page-link" href="#"><?= $i ?></a></li>
      <?php else : ?>
        <li class="page-item" onclick="paginate('<?= $i ?>')" type="button"><a class="page-link" href="#"><?= $i ?></a></li>
      <?php endif ?>
    <?php } ?>
    <?php if ($halamanaktif < $jumlahHalaman) { ?>
      <li onclick="paginate(<?= $halamanaktif + 1 ?>)" class="page-item"><a class="page-link" href="#">Next</a></li>
    <?php } ?>
  </ul>
</nav>

<div id="detailTransaksi" class="d-none bayar box-default box">
  <div onclick="hidetransaksi()" class="transaksi justify-between align-items-center px-4 flex">
    <h1>Detail transaksi</h1>
    <div class="">X</div>
  </div>
  <table class="table transaksitable table-bordered table-hover table-striped">
    <thead>
      <tr class="">
        <th width="5%">no</th>
        <th width="35%">nama</th>
        <th width="15%">harga</th>
        <th width="30%">jumlah</th>
        <th class="text-center" width="15%">aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1;
      foreach ($transaksi as $t) {
      ?>
        <tr class="">
          <td><?= $no ?></td>
          <td><?= $t['nama'] ?></td>
          <td><?= $t['harga'] ?></td>
          <td>
            <form action="" method="POST">
              <input type="text" name="id" value="<?= $t['dt_id'] ?>" hidden id="">
              <input class="w-14" type="number" name="jumlah" id="jumlah" placeholder="<?= $t['jumlah'] ?>" value="<?= $t['jumlah'] ?>" size="<?= strlen($t['jumlah']) ?>">
              <button type="button" onclick="ajaxUbah(<?= $t['dt_id'] ?>,jumlah)" class="w-min">ubah</button>
            </form>
          </td>
          <td class="text-center"><a href="./"   onclick="ajaxHapus(<?= $t['dt_id'] ?>,event)"><ion-icon class="text-red-600" size="large" name="trash"></ion-icon></a></td>
        </tr>
      <?php $no++;
      } ?>
      <tr>
        <td colspan="5" class="text-right">
          <form action="" method="get">
            <input type="text" name="id" value="<?= $t['dt_id'] ?>" hidden id="">
            <input type="datetime-local" name="tanggal" id="">
            <button type="submit" class="align-middle btn bg-blue-400 hover:bg-blue-600 time text-white m-1">Checkout</button>
          </form>
        </td>
      </tr>
    </tbody>
  </table>
</div>
<?php
if (!empty($_GET['idtransaksi'])) {
  $id = $_GET['idtransaksi'];
  // select harga
  $hargas = mysqli_query($koneksi, "Select harga from menu where menu_id='$id'");
  $harga = mysqli_fetch_column($hargas);
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
if (!empty($_POST['jumlah'])) {
  mysqli_query($koneksi, "update detail_transaksi set jumlah=$_POST[jumlah] where dt_id=$_POST[id]");
  if (mysqli_affected_rows($koneksi) > 0) { ?>
  <?php }
}
if (!empty($_GET['delete'])) {
  $d = mysqli_query($koneksi, "DELETE FROM detail_transaksi WHERE dt_id=$_GET[delete]");
  if (mysqli_affected_rows($koneksi) > 0) {
  ?>
    <script>
      alertP("error", "berhasil menghapus data")
    </script>
<?php
  }
}
