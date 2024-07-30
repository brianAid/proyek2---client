<?php
$judul = "Dashboard";
require "./components/header.php";
include "./tugas.php";
?>
<?php

?>
<div class="content-wrapper" style="min-height: 749.333px;">
  <section class="content">
    <div class="row">
      <div class="col-sm-6 col-6 col-md-6 col-xl-3 col-lg-6">
        <div class="small-box bg-green">
          <div class="inner">
            <?php
            $p = dataByTanggal("pemasukan", "hari");
            ?>
            <h4 style="font-weight: bolder"><?php echo "Rp. " . str_replace(',', '.', number_format($p['total_harga'])) . " "; ?></h4>

            <p class="m-0">Pemasukan Hari Ini</p>
          </div>
          <div class="icon">
            <ion-icon style="font-size:0.7em; margin-top:0.3em" name="stats-chart"></ion-icon>
          </div>
          <a href="./laporan.php?tanggal_awal=<?= date('Y-m-d') ?>&tanggal_akhir=<?= date('Y-m-d', strtotime('tomorrow')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-sm-6 col-6 col-md-6 col-xl-3 col-lg-6">
        <div class="small-box bg-blue">
          <div class="inner">
            <?php
            $p = dataByTanggal("pemasukan", "bulan");
            ?>
            <h4 style="font-weight: bolder"><?php echo "Rp. " . str_replace(',', '.', number_format($p['total_harga'])) . " "; ?></h4>

            <p class="m-0">Pemasukan Bulan Ini</p>
          </div>
          <div class="icon">
            <ion-icon style="font-size:0.7em; margin-top:0.3em" name="stats-chart"></ion-icon>
          </div>
          <a href="./laporan.php?tanggal_awal=<?= date('Y-m-01') ?>&tanggal_akhir=<?= date('Y-m-t') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-sm-6 col-6 col-md-6 col-xl-3 col-lg-6">
        <div class="small-box bg-olive">
          <div class="inner">
            <?php
            $p = dataByTanggal("pemasukan", "tahun");
            ?>
            <h4 style="font-weight: bolder"><?php echo "Rp. " . str_replace(',', '.', number_format($p['total_harga'])); ?></h4>

            <p class="m-0">Pemasukan Tahun Ini</p>
          </div>
          <div class="icon">
            <ion-icon style="font-size:0.7em; margin-top:0.3em" name="stats-chart"></ion-icon>
          </div>
          <a href="./laporan.php?tanggal_awal=<?= date('Y-01-01') ?>&tanggal_akhir=<?= date('Y-12-31') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-sm-6 col-6 col-md-6 col-xl-3 col-lg-6">
        <div class="small-box bg-navy">
          <div class="inner">
            <?php
            $p = dataByTanggal("pemasukan", "all");
            ?>
            <h4 style="font-weight: bolder"><?php echo "Rp. " . str_replace(',', '.', number_format($p['total_harga'])); ?></h4>

            <p class="m-0">Seluruh Pemasukan</p>
          </div>
          <div class="icon">
            <ion-icon style="font-size:0.7em; margin-top:0.3em" name="stats-chart"></ion-icon>
          </div>
          <a href="./laporan.php?tanggal_awal=<?= date('0001-01-01') ?>&tanggal_akhir=<?= date('Y-m-t') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-sm-6 col-6 col-md-6 col-xl-3 col-lg-6">
        <div class="small-box bg-yellow">
          <div class="inner">
            <?php
            $p = dataByTanggal("pengeluaran", "hari");
            ?>
            <h4 style="font-weight: bolder"><?php echo "Rp. " . str_replace(',', '.', number_format($p['total_harga'])); ?></h4>

            <p>Pengeluaran Hari Ini</p>
          </div>
          <div class="icon">
            <ion-icon style="font-size:0.7em; margin-top:0.3em" name="stats-chart"></ion-icon>
          </div>
          <a href="./laporan.php?tanggal_awal=<?= date('Y-m-d') ?>&tanggal_akhir=<?= date('Y-m-d', strtotime('tomorrow')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-sm-6 col-6 col-md-6 col-xl-3 col-lg-6">
        <div class="small-box bg-orange">
          <div class="inner">
            <?php
            $p = dataByTanggal("pengeluaran", "bulan");
            ?>
            <h4 style="font-weight: bolder"><?php echo "Rp. " . str_replace(',', '.', number_format($p['total_harga'])); ?></h4>

            <p>Pengeluaran Bulan Ini</p>
          </div>
          <div class="icon">
            <ion-icon style="font-size:0.7em; margin-top:0.3em" name="stats-chart"></ion-icon>
          </div>
          <a href="./laporan.php?tanggal_awal=<?= date('Y-m-01') ?>&tanggal_akhir=<?= date('Y-m-t') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-sm-6 col-6 col-md-6 col-xl-3 col-lg-6">
        <div class="small-box bg-red">
          <div class="inner">
            <?php
            $p = dataByTanggal("pengeluaran", "tahun");
            ?>
            <h4 style="font-weight: bolder"><?php echo "Rp. " . str_replace(',', '.', number_format($p['total_harga'])); ?></h4>

            <p>Pengeluaran Tahun Ini</p>
          </div>
          <div class="icon">
            <ion-icon style="font-size:0.7em; margin-top:0.3em" name="stats-chart"></ion-icon>
          </div>
          <a href="./laporan.php?tanggal_awal=<?= date('Y-01-01') ?>&tanggal_akhir=<?= date('Y-12-31') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-sm-6 col-6 col-md-6 col-xl-3 col-lg-6">
        <div class="small-box bg-maroon">
          <div class="inner">
            <?php
            $p = dataByTanggal("pengeluaran", "all");
            ?>
            <h4 style="font-weight: bolder"><?php echo "Rp. " . str_replace(',', '.', number_format($p['total_harga'])); ?></h4>

            <p>Seluruh Pengeluaran</p>
          </div>
          <div class="icon">
            <ion-icon style="font-size:0.7em; margin-top:0.3em" name="stats-chart"></ion-icon>
          </div>
          <a href="./laporan.php?tanggal_awal=<?= date('0001-01-01') ?>&tanggal_akhir=<?= date('Y-m-t') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    <div class="container mt-10">
      <div class="row">
        <div class="col-sm-12 col-12 col-md-12 col-xl-7 col-lg-12">
          <div class="h-min lg:h-full box ">
            <div class=" font-serif box-header with-border">
              <h3 class="box-title">Pendapatan Bulanan</h3>
              <div class="box-tools pull-right">
                <button aria-label="minimize-maximize" class="btn btn-box-tool" data-widget="collapse"><ion-icon name="menu"></ion-icon></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas height="300" id="canvas1"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class=" col-xl-5">
          <div class="lg:h-full box ">
            <div class=" font-serif box-header with-border">
              <h3 class="box-title">Persentase Pendapatan Bulanan</h3>
              <div class="box-tools pull-right">
                <button aria-label="minimize-maximize" class="btn btn-box-tool" data-widget="collapse"><ion-icon name="menu"></ion-icon></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas height="300" id="canvasPersentase"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-center mt-3">
        <div class="col-sm-12 col-12 col-md-12 col-xl-7 col-lg-12">
          <div class="h-min lg:h-full box ">
            <div class=" font-serif box-header with-border">
              <h3 class="box-title">Pendapatan Tahunan</h3>
              <div class="box-tools pull-right">
                <button aria-label="minimize-maximize" class="btn btn-box-tool" data-widget="collapse"><ion-icon name="menu"></ion-icon></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas height="300" id="canvastahunan"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      const data = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        datasets: [{
            label: 'pemasukan',
            data: [
              <?php
              $tahun = date("Y");
              for ($bulan = 1; $bulan <= 12; $bulan++) {
                $pemasukan_query = mysqli_query($koneksi, "SELECT sum(total_harga) as total_harga FROM transaksi WHERE month(tanggal_transaksi)='$bulan' And Year(tanggal_transaksi)=$tahun");
                $pemasukan_data = mysqli_fetch_assoc($pemasukan_query);
                $pemasukan = $pemasukan_data['total_harga'];
                if ($pemasukan == null) {
                  $pemasukan = 0;
                }
                echo $pemasukan;
                echo ",";
              }
              ?>
            ],
            borderColor: '#36A2EB',
            backgroundColor: '#9BD0F5',
          },
          {
            label: 'pengeluaran',
            data: [
              <?php
              $tahun = date("Y");
              for ($bulan = 1; $bulan <= 12; $bulan++) {
                $pemasukan_query = mysqli_query($koneksi, "SELECT sum(nominal) as total_harga FROM pengeluaran WHERE month(tanggal_transaksi)='$bulan' And Year(tanggal_transaksi)=$tahun");
                $pemasukan_data = mysqli_fetch_assoc($pemasukan_query);
                $pemasukan = $pemasukan_data['total_harga'];
                if ($pemasukan == null) {
                  $pemasukan = 0;
                }
                echo $pemasukan;
                echo ",";
              }
              ?>
            ],
            borderColor: '#FF6384',
            backgroundColor: '#FFB1C1',
          }
        ]
      };
      const canvas1 = document.getElementById('canvas1');
      new Chart(canvas1, {
        type: 'bar',
        data: data,
        options: {
          responsive: true,
          maintainAspectRatio: false,
          datasetFill: false
        }
      });

      // persentase
      <?php
      $pemasukanBlnn = dataByTanggal("pemasukan", "bulan")['total_harga'];
      $pengeluaranBlnn = dataByTanggal("pengeluaran", "bulan")['total_harga'];

      $persentasePemasukan = 0;
      $persentasePengeluaran = 0;

      if ($pemasukanBlnn != 0 || $pengeluaranBlnn != 0) {
        $totalharga = $pemasukanBlnn + $pengeluaranBlnn;

        $persentasePemasukan = number_format(($pemasukanBlnn / $totalharga) * 100, 3);
        $persentasePengeluaran = number_format(100 - $persentasePemasukan, 3);
      }
      ?>


      const dataPersen = {
        labels: [
          'Pemasukan',
          'Pengeluaran',
        ],
        datasets: [{
          label: 'Persentase: ',
          data: [<?= $persentasePemasukan, ",", $persentasePengeluaran ?>],
          backgroundColor: [
            'rgb(54, 162, 235)',
            'rgb(255, 99, 132)',
          ],
          hoverOffset: 4
        }]
      };
      const persentaseChart = document.getElementById('canvasPersentase')
      new Chart(persentaseChart, {
        type: 'doughnut',
        data: dataPersen,
        options: {
          responsive: true,
          maintainAspectRatio: false,
          datasetFill: false,
          plugins: {
            labels: {
              render: 'percentage',
              fontColor: ['white', 'white'],
              precision: 2
            }
          }
        }
      })
      // tahun
      const datatahun = {
        labels: [<?php
                  $data = mysqli_fetch_all(mysqli_query($koneksi, "SELECT YEAR(tanggal_transaksi) AS tanggal FROM pengeluaran
                    UNION 
                    SELECT YEAR(tanggal_transaksi) AS tanggal FROM transaksi order by tanggal ASC"), MYSQLI_ASSOC);
                  foreach ($data as $d) {
                    echo ($d['tanggal'] . ",");
                  }
                  ?>],
        datasets: [{
            label: 'pemasukan',
            data: [
              <?php
              $indeks = 1;
              $pemasukan = array();
              foreach ($data as $d) {
                $tahun = $d['tanggal'];
                $pemasukan_query = mysqli_query($koneksi, "SELECT sum(total_harga) as total_harga FROM transaksi WHERE Year(tanggal_transaksi)=$tahun");
                $pemasukan_data = mysqli_fetch_assoc($pemasukan_query);
                $pemasukan[$indeks] = $pemasukan_data['total_harga'];
                if ($pemasukan[$indeks] == null) {
                  $pemasukan[$indeks] = 0;
                }
                echo $pemasukan[$indeks];
                echo ",";
                $indeks++;
              }
              ?>
            ],
            borderColor: '#36A2EB',
            backgroundColor: '#9BD0F5',
          },
          {
            label: 'pengeluaran',
            data: [
              <?php
              $indek = 1;
              $pengeluaran = array();
              foreach ($data as $d) {
                $tahun = $d['tanggal'];
                $pemasukan_query = mysqli_query($koneksi, "SELECT sum(nominal) as total_harga FROM pengeluaran WHERE Year(tanggal_transaksi)=$tahun");
                $pemasukan_data = mysqli_fetch_assoc($pemasukan_query);
                $pengeluaran[$indek] = $pemasukan_data['total_harga'];
                if ($pengeluaran[$indek] == null) {
                  $pengeluaran[$indek] = 0;
                }
                echo $pengeluaran[$indek];
                echo ",";
                $indek++;
              }
              ?>
            ],
            borderColor: '#FF6384',
            backgroundColor: '#FFB1C1',
          }
        ]
      };
      const canvastahun = document.getElementById('canvastahunan');
      new Chart(canvastahun, {
        type: 'bar',
        data: datatahun,
        options: {
          responsive: true,
          maintainAspectRatio: false,
          datasetFill: false
        }
      });
    </script>
</div>
<?php
include("./components/footer.php")
?>