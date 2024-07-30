<?php
date_default_timezone_set('Asia/Jakarta');
?>

<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$db = 'kelompok';
$koneksi = mysqli_connect($hostname, $username, $password, $db);

function getdata()
{
    global $koneksi;
    $query = "select * from menu";
    return $data = mysqli_query($koneksi, $query);
}

function tambahmenu($data, $gambar)
{
    global $koneksi;
    $kategori = $data['kategori'];
    $nama = htmlspecialchars($data['nama']);
    $harga = $data['harga'];
    $gambar_name = $gambar["name"];
    $temp = explode(".", $gambar_name);
    $textname = $temp[0];
    $extention = end($temp);
    $gambar_temp = $gambar["tmp_name"];
    $gambar_path = 'img/' . $gambar_name;

    $cek = getimagesize($gambar_temp);
    if ($cek === false) {
        echo "File yang diunggah bukan gambar.";
        return;
    }
    $a = 0;
    $no = 0;
    while ($a == 0) {
        if (file_exists($gambar_path)) {
            $no++;
            $gambar_name = $textname . $no . "." . $extention;
            $gambar_path = 'img/' . $textname . $no . "." . $extention;
        } else {
            if (move_uploaded_file($gambar_temp, $gambar_path)) {
                $a = 1;
                $query = "INSERT INTO menu (kategori, nama, harga,ikon) VALUES ('$kategori', '$nama', $harga, '$gambar_name')";
                $add = mysqli_query($koneksi, $query);
                return $add;
            } else {
                echo "Gagal memindahkan file.";
                return;
            }
        }
    }
}

function hapus($id)
{
    global $koneksi;
    $detail_transaksis = mysqli_query($koneksi, "select transaksi_id from detail_transaksi WHERE menu_id=$id");
    $detail_transaksi = mysqli_fetch_all($detail_transaksis, MYSQLI_ASSOC);
    var_dump($detail_transaksi);
    if (isset($_GET['confirm'])) {
        $count = count($detail_transaksi);
        foreach ($detail_transaksi as $key => $d) {
            $transaksi_id = $d['transaksi_id'];
            var_dump($detail_transaksis);
            mysqli_query($koneksi, "delete from detail_transaksi where menu_id = $id");
            if ($key === $count - 1) {
                mysqli_query($koneksi, "delete from menu WHERE menu_id = $id");
                mysqli_query($koneksi, "delete from transaksi where transaksi_id = $transaksi_id");
            }
        }
        return mysqli_affected_rows($koneksi);
    } else {
        if (!empty($detail_transaksi)) {
?>
            <script>
                var result = confirm('Menghapus menu ini juga akan menghapus <?= $detail_transaksis->num_rows ?> transaksi. Apakah Anda yakin ingin melanjutkan?');
                if (result) {
                    window.location.href = 'hapus.php?id=<?= $id ?>&confirm=yes';
                } else {
                    alert("Data gagal dihapus");
                    window.location.href = 'menu.php';
                }
            </script>
<?php
        } else {
            mysqli_query($koneksi, "delete from menu where menu_id = $id");
            return mysqli_affected_rows($koneksi);
        }
    }
}


function editmenu($data, $gambar)
{
    global $koneksi;
    $id = $data["menu_id"];

    $kategori = $data['kategori'];
    $nama = htmlspecialchars($data['nama']);
    $harga = $data['harga'];
    if ($gambar["name"] != "") {
        $gambar_name = $gambar["name"];
        $temp = explode(".", $gambar_name);
        $textname = $temp[0];
        $extention = end($temp);
        $gambar_temp = $gambar["tmp_name"];
        $gambar_path = 'img/' . $gambar_name;
        $cek = getimagesize($gambar_temp);
        if ($cek === false) {
            echo "File yang diunggah bukan gambar.";
            return;
        }
        $no = 0;
        while (file_exists($gambar_path)) {
            $no++;
            $gambar_name = $textname . $no . "." . $extention;
            $gambar_path = 'img/' . $textname . $no . "." . $extention;
            $query = "UPDATE menu SET kategori='$kategori', nama='$nama', harga=$harga, ikon='$gambar_name' WHERE menu_id=$id";
            $update = mysqli_query($koneksi, $query);
            return $update;
        }
        if (!move_uploaded_file($gambar_temp, $gambar_path)) {
            echo "Gagal memindahkan file.";
            return;
        }
    } else {
        $query = "UPDATE menu SET kategori='$kategori', nama='$nama', harga=$harga WHERE menu_id=$id";
        $update = mysqli_query($koneksi, $query);
        return $update;
    }
}

function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function bayar($tanggal)
{
    global $koneksi;
    $transaksis = mysqli_query($koneksi, "select * from transaksi where status = 'progress'");
    if (!empty($transaksis->num_rows)) {
        $transaksi = mysqli_fetch_assoc($transaksis);
        $data = mysqli_query($koneksi, "select detail_transaksi.*,menu.nama from detail_transaksi detail_transaksi inner join
     menu on detail_transaksi.menu_id = menu.menu_id where transaksi_id =  '$transaksi[transaksi_id]'");
        $data = mysqli_fetch_all($data, MYSQLI_ASSOC);
        $harga = 0;
        foreach ($data as $d) {
            $dharga = $d['harga'] * $d['jumlah'];
            $harga += $dharga;
        }
        $query = "UPDATE transaksi SET tanggal_transaksi='$tanggal', total_harga=$harga,status='end' WHERE status = 'progress'";
        $update = mysqli_query($koneksi, $query);
    }
}

function searchdataandpagination($keyword, $makanan, $minuman, $halamanaktif)
{
    global $koneksi;
    $halamanaktif = (int) $halamanaktif ?: 1;
    $queryBase = "SELECT * FROM menu WHERE (nama LIKE '%$keyword%' OR harga LIKE '%$keyword%')";

    if ($makanan == "false")
        $queryBase .= " AND kategori <> 'makanan'";
    if ($minuman == "false")
        $queryBase .= " AND kategori <> 'minuman'";

    $data = mysqli_fetch_all(mysqli_query($koneksi, $queryBase), MYSQLI_ASSOC);

    $jumlahdataperhalaman = 3;
    $jumlahdata = count($data);
    $jumlahHalaman = ceil($jumlahdata / $jumlahdataperhalaman);
    $awaldata = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;

    $query = "$queryBase ORDER BY menu_id DESC LIMIT $awaldata, $jumlahdataperhalaman";
    $isi = mysqli_fetch_all(mysqli_query($koneksi, $query), MYSQLI_ASSOC);

    return [
        'jumlahdata' => $jumlahdata,
        'jumlahHalaman' => $jumlahHalaman,
        'jumlahdataperhalaman' => $jumlahdataperhalaman,
        'halamanaktif' => $halamanaktif,
        'awaldata' => $awaldata,
        'data' => $isi
    ];
}


function Insertpengeluaran($data)
{
    global $koneksi;
    $nominal = $data['nominal'];
    $deskripsi = htmlspecialchars($data['deskripsi']);
    $tanggal = $data['tanggal'];

    $query = "INSERT INTO pengeluaran (nominal, deskripsi, tanggal) VALUES ('$nominal', '$deskripsi', '$tanggal')";
    return $add = mysqli_query($koneksi, $query);
}

function dataByTanggal($jenis, $date) {
    global $koneksi;

    $dateFormats = [
        'hari' => ['start' => date('Y-m-d'), 'end' => date('Y-m-d 23:59:59')],
        'bulan' => ['start' => date('m'), 'condition' => 'month'],
        'tahun' => ['start' => date('Y'), 'condition' => 'year'],
        'all' => ['condition' => '']
    ];

    $table = $jenis == 'pemasukan' ? 'transaksi' : 'pengeluaran';
    $column = $jenis == 'pemasukan' ? 'total_harga' : 'nominal';

    $query = "SELECT SUM($column) as total_harga FROM $table";
    
    if ($date != 'all') {
        if ($date == 'hari') {
            $query .= " WHERE tanggal_transaksi >= '{$dateFormats[$date]['start']}' AND tanggal_transaksi <= '{$dateFormats[$date]['end']}'";
        } else {
            $condition = $dateFormats[$date]['condition'];
            $start = $dateFormats[$date]['start'];
            $query .= " WHERE $condition(tanggal_transaksi) = '$start'";
        }
    }

    $result = mysqli_query($koneksi, $query);
    return mysqli_fetch_assoc($result);
}

function alert($type, $text)
{
    echo "
  <script>
  alertP('$type', '$text!');
</script>";
}

