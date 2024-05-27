var keyword = document.getElementById('keyword');
var container = document.getElementById('container');
var checklistmakanan = document.getElementById('makanan');
var checklistminuman = document.getElementById('minuman');
if (localStorage.getItem("halaman") == undefined) {
  localStorage.setItem("halaman", "1");
}
if (document.getElementById("loading") != undefined) {
  var loading = document.getElementById("loading");
}
function ajaxMenu() {
  var loading = document.getElementById("loading");
  loading.style.display = "flex";
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {  
    if (xhr.readyState == 4 && xhr.status == 200) {
      loading.style.display = "none";
      container.innerHTML = xhr.responseText;
      console.log(xhr, container.innerHTML);
    }
  };
  xhr.open('GET', 'ajax/datamenu.php?keyword=' + keyword.value + '&makanan=' + checklistmakanan.checked + '&minuman=' + checklistminuman.checked + '&halaman=' + localStorage.getItem("halaman"), true);
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