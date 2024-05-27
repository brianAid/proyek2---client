<?php
require 'tugas.php';
$id = $_GET["id"];
$judul = "Edit menu";
$data = mysqli_query($koneksi, "SELECT * FROM menu WHERE menu_id = $id");
$data = mysqli_fetch_assoc($data);

if (
    isset($_POST["submit"])
) {
    var_dump($_FILES);
    if (editmenu($_POST, $_FILES['gambar']) > 0) {
        echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'menu.php';
			</script>
		";
    } else {
        echo "
			<script>
				alert('data gagal diubah!');
				document.location.href = 'menu.php';
			</script>
		";
    }
}

include("./components/header.php");
?>
<div class="content-wrapper">
    <div class="content m-lg-5 ">
        <div class="">
            <form action="" method="post" enctype="multipart/form-data" class="space-y-4">
                <input type="hidden" name="menu_id" value="<?= $data['menu_id'] ?>">
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama :</label>
                    <input type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="nama" name="nama" value="<?= $data['nama'] ?>">
                </div>
                <div>
                    <label for="harga" class="block text-sm font-medium text-gray-700">Harga :</label>
                    <input type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="harga" name="harga" value="<?= $data['harga'] ?>">
                </div>
                <div>
                    <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori :</label>
                    <select required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="kategori" name="kategori">
                        <option selected disabled hidden value="">pilih opsi</option>
                        <option value="makanan">makanan</option>
                        <option value="minuman">minuman</option>
                    </select>
                </div>
                <div>
                    <label for="gambar">gambar ikon</label>
                    <img src="./img/<?= $data['ikon'] ?>" alt="Gambar Default" id="preview_gambar" style="aspect-ratio:1/1; max-width: 200px; max-height: 200px;"><br>
                    <input type="file" name="gambar" id="gambar">
                </div>
                <button type="submit" name="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Ubah Data!</button>
            </form>
        </div>
    </div>
</div>
<?php
include("./components/footer.php");
?>