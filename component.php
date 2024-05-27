<?php
$judul = "components";
include "components/header.php"
?>
<?php
require "tugas.php";
?>
<div id="alert" class="alert top-0 fixed right-0" style="z-index:100000 ;"></div>
<script src="./src/js/alert.js"></script>
<div class="content-wrapper">
  <div class=" content">
<?php
$data = dataByTanggal('pemasukan', 'hari');
var_dump($data);
?>
  </div>
</div>
</script>
<?php
include "components/footer.php"
?>
