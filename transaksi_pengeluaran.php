<?php
$judul = "Pengeluaran";
require "./components/header.php"
?>
<?php require "./tugas.php";
if (!empty($_POST)) {
  if (Insertpengeluaran($_POST) > 0) {
    echo "
			<script>
				alert('data berhasil ditambahkan!');
			</script>";
  } else {
    echo "
			<script>
				alert('data gagal ditambahkan!');
			</script>";
  }
}


$data = query("select * from pengeluaran order by pengeluaran_id desc");


?>
<div class="content-wrapper">
  <div class="content">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Pengeluaran</h3>
      </div>
      <form method="POST">
        <div class="box-body">
          <label for="nominal">Nominal</label>
          <input name="nominal" type="number" class="form-control" id="nominal" placeholder="Masukan nominal">
          <label for="deskripsi">Deskripsi</label>
          <textarea name="deskripsi" type="text" class="form-control h-36" id="deskripsi" placeholder="Deskripsi"></textarea>
          <label for="tanggal">Tanggal pengeluaran</label>
          <input type="datetime-local" class="form-control" name="tanggal" id="tanggal">
          <div class="box-footer">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card box box-info">
            <div class="card-header">
              <h4 class="card-title">Catatan pengeluaran</h4>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                  <div class="col-sm-12">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>NO</th>
                          <th>nominal</th>
                          <th>deskripsi</th>
                          <th>tanggal  </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no=1; foreach ($data as $d) {?>
                          <tr>
                            <td><?= $no ?></td>
                            <td><?= $d['nominal'] ?></td>
                            <td><?= $d['deskripsi'] ?></td>
                            <td><?= $d['tanggal'] ?></td>
                          </tr>
                          <?php $no++; } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
            <?php
            require "./components/footer.php"
            ?>