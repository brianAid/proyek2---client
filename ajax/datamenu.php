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
?>
<div class="gridwrapper">
  <?php if (!empty($data)) {
    foreach ($data as $d) {
  ?>
        <div class="boxgrid w-56 h-full card text-white bg-dark   ">
          <img class="img card-img-top" src="./img/<?= $d['ikon'] ?>" alt="none" />
          <div class="py-2 px-3 card-body d-flex justify-content-between align-items-center">
            <div>
              <h5 class="min-h-fit max-h-fit card-title" style="font-weight: bolder"><?= $d['nama'] ?></h5>
              <p class="card-text d-inline">Rp.<?= $d['harga'] ?>
              </p>
            </div>
            <!-- if -->
            <div class="right-icon h2">
              <?php
              if ($d['kategori'] == 'minuman') {
                echo '<ion-icon name="cafe"></ion-icon>';
              } elseif ($d['kategori'] == 'makanan') {
                echo '<ion-icon name="pizza"></ion-icon>';
              } elseif ($d['kategori'] == 'paket') {
                echo '<ion-icon name="fast-food"></ion-icon>';
              } else {
                echo '';
              }
              ?>
            </div>
            <!-- end if -->
          </div>
          <div class=" absolute top-0 right-0 flex flex-column">
            <a role="button" href="edit.php?id=<?= $d['menu_id'] ?>"><button aria-label="setting" class="SettingIcon icon"><ion-icon class=" m-0" name="settings">settings</ion-icon></button></a>
            <button class="deleteIcon icon" onclick="confirmDelete(<?= $d['menu_id'] ?>,'<?= $d['nama'] ?>')">
              <ion-icon class="m-0" name="trash">delete</ion-icon>
            </button>
          </div>
        </div>
    <?php }
  } else { ?>
    <center>
      <h1>data tidak ditemukan</h1>
    </center>
  <?php } ?>
</div>











<nav class=" absolute left-1/2  translate-middle-x align-middle" aria-label="Page navigation example">
  <ul class="pagination">
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
    <!-- <?php if ($halamanaktif < $jumlahHalaman) { ?>
    <button href="?halaman=<?= $halamanaktif + 1 ?>">&gt</button>
    <?php } ?> -->
    <?php if ($halamanaktif < $jumlahHalaman) { ?>
      <li onclick="paginate(<?= $halamanaktif + 1 ?>)" class="page-item"><a class="page-link" href="#">Next</a></li>
    <?php } ?>
  </ul>
</nav>