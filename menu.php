<?php
$judul = "Menu";
include("./components/header.php");
require 'tugas.php';

?>
<div id="alert" class="alert top-0 fixed right-0" style="z-index:100000 ;"></div>
<div class="content-wrapper">
  <div class="content">
    <div class="box-default box py-6">
      <div class="searchpage mx-3 gap-1 content-center flex-wrap text-center sm:flex justify-between">
        <!-- search form -->
        <form action="">
          <input type="text" name="keyword" autocomplete="off" placeholder="masukan nama" id="keyword">
        </form>
        <!-- checklist -->
        <form action="">
          <label><input id="makanan" type="checkbox" name="kategori" checked value="makanan"> makanan</label>
          <label><input id="minuman" type="checkbox" name="kategori" checked value="minuman"> minuman</label>
        </form>
        <a id="menu_open" href="#" class=" btn bg-blue-400 hover:bg-blue-600 text-white m-1" onclick="toggleMenu()">Tambah menu <ion-icon class="center" name="add"></ion-icon> </a>
      </div>
      <div id="loading" class="loader"><img class="load" src="./img/refresh-icon.png" alt="loading...">loading...</div>
      <div id="container" class="py-4 container-fluid">
      </div>
    </div>

    <div class="popup">
      <div id="toggle_menu" style="background-color:rgb(247, 247, 249); z-index: 10000;" class="z-50 box w-max box-default d-none p-3 fixed toggle_menu card">
        <ion-icon id="close" name="close" class="m-0 border rounded-full  border-black position-absolute end-5 top-5 text-red h2"></ion-icon>
        <div class="card-body">
          <h4>Tambah Menu</h4>
          <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama">
            </div>
            <div class="mb-3">
              <label for="harga" class="form-label">Harga</label>
              <input type="text" class="form-control" id="harga" name="harga">
            </div>
            <div class="mb-3">
              <label for="kategori" class="form-label">Kategori</label>
              <select class="form-select" id="kategori" name="kategori">
                <option value="makanan">Makanan</option>
                <option value="minuman">Minuman</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="gambar" class="form-label">Gambar Ikon</label>
              <input type="file" class="form-control" id="gambar" name="gambar">
            </div>
            <button type="submit" class="btn btn-primary" name="tambah">Submit</button>
          </form>
        </div>
      </div>

      <!-- end menu_popup -->




      <!-- delete popup -->
      <div id="popup_delete" tabindex="-1" class="popup_delete w- d-none fixed inset-0 z-40 transition flex items-center">
      </div>
      <!-- end delete popup -->
    </div>
  </div>
</div>
<script src="src/js/alert.js">
</script>
<?php
if (!empty($_POST['nama']) && !empty($_POST['harga']) && !empty($_POST['kategori']) && !empty($_FILES['gambar']['name'])&& !empty($_FILES['gambar']['tmp_name'])) {
  //   if (tambahmenu($_POST, $_FILES['gambar']) > 0) {
  //     echo "
  //   <script>
  //   alertP('success', 'data berhasil ditambahkan!');
  // </script>";
  //   } else {
  //     echo "
  // 			<script>
  //   alertP('error', 'gagal menambahkan data!');
  // </script>";
  //   }
  $gambar_temp = $_FILES['gambar']["tmp_name"];

  $cek = getimagesize($gambar_temp);
  var_dump($cek);
} elseif (isset($_POST['nama']) && isset($_POST['harga']) && isset($_POST['kategori']) && isset($_FILES['gambar'])) {
  echo "
    <script>
  alertP('error', 'Data tidak lengkap');
  </script>";
}
include("./components/footer.php")
?>
<script src="./src/js/ajax_menu.js"></script>