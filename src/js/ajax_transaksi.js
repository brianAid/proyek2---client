var keyword = document.getElementById('keyword');
var container = document.getElementById('container');
var checklistmakanan = document.getElementById('makanan');
var checklistminuman = document.getElementById('minuman');
if (localStorage.getItem("halaman") == undefined) {
  localStorage.setItem("halaman", "1");
}
function ajaxMenu(success=function(){}) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200 && xhr.responseText != "") {
      container.innerHTML = xhr.responseText;
      success();
    }
  };
  xhr.open('GET', 'ajax/transaksi_ajax.php?keyword=' + keyword.value + '&makanan=' + checklistmakanan.checked + '&minuman=' + checklistminuman.checked + '&halaman=' + localStorage.getItem("halaman"), true);
  xhr.send();
}
keyword.addEventListener('keyup', function (e) {
  localStorage.setItem("halaman", 1)
  ajaxMenu();
});

checklistmakanan.addEventListener('change', function (e) {
  ajaxMenu();
});

checklistminuman.addEventListener('change', function (e) {
  ajaxMenu();
});

function paginate(value) {
  localStorage.setItem("halaman", value);
  console.log("value" + value);
  ajaxMenu();
}

ajaxMenu()

function ajaxUbah(id, jumlah) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200 && xhr.responseText != null) {
      jumlah.placeholder = jumlah.value
      alertP("success", "berhasil mengubah jumlah barang")
    }
  };
  xhr.open('POST', 'ajax/transaksi_edit.php', true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

  var params = 'id=' + encodeURIComponent(id) + '&jumlah=' + encodeURIComponent(jumlah.value);
  xhr.send(params);
}


function ajaxBeli(id) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.responseText != "") {
        alertP("success", "berhasil transaksi")
        ajaxMenu()
      }
      else {
        alertP("error", "baranga yang ingin anda beli tidak ditemukan")
      }
    }
  };
  xhr.open('POST', 'ajax/transaksi_tambah.php', true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  var data = 'idtransaksi=' + encodeURIComponent(id);
  xhr.send(data);
}
function ajaxHapus(id,event) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.responseText != "") {
        alertP("success", "berhasil menghapus transaksi")
        ajaxMenu(function () {
          document.getElementById("detailTransaksi").classList.remove("d-none");
        })
      }
      else {
        alertP("error", "barang yang ingin anda beli tidak ditemukan")
      }
    }
  };
  xhr.open('POST', 'ajax/transaksi_hapus.php', true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  var data = 'delete=' + encodeURIComponent(id);
  xhr.send(data);
}