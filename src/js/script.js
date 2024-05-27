var body = document.body;
var width = window.innerWidth;
var close_btn = document.getElementById('close');
var menu_open = document.getElementById("menu_open");
var popup_delete = document.getElementById("popup_delete");

function parentClose(e) {
  e.target.parentElement.classList.add("d-none");
}

function parentparentClose(e) {
  e.target.parentElement.parentElement.parentElement.classList.add("d-none");
}
function toggleMenu() {
  document.getElementById("toggle_menu").classList.remove("d-none");
}
if (close_btn!=null) {
  close_btn.addEventListener('click', (e) => { parentClose(e); });
}
if (document.querySelectorAll('.cancelButton') !=null) {
  document.querySelectorAll('.cancelButton').forEach((cancelBtn, index) => {
    cancelBtn.addEventListener('click', (e) => {
      var popup = document.querySelectorAll('.popup_delete')[index];
      popup.classList.add('d-none');
    });
  });
}
function confirmDelete(menuId, menuName) {
  var deletetag = `<div class="relative w-full transition my-auto p-4">
    <div class="w-full py-2 bg-white relative rounded-xl mx-auto max-w-sm">
      <div class="p-4 text-center">
        <h2 class="text-xl font-bold tracking-tight">menghapus ${menuName}</h2>
        <p class="text-gray-500">lanjutkan menghapus ${menuName}?</p>
      </div>
      <div class="px-6 py-2 grid gap-2 grid-cols-[repeat(auto-fit,minmax(0,1fr))]">
        <button onclick="canceldelete()" class="inline-flex justify-center py-1 gap-1 rounded-lg border ">
          <span class="flex items-center gap-1">Cancel</span>
        </button>
        <button class="inline-flex justify-center py-1 gap-1 rounded-lg border text-white bg-red-600">
          <a id="deleteLink" href="hapus.php?id=${menuId}" class="flex items-center gap-1">Confirm</a>
        </button>
      </div>
    </div>
  </div>`;
  $("#popup_delete").removeClass("d-none");
  $("#popup_delete").html(deletetag);
  setTimeout(function () {
    popup_delete.style.opacity = 1;
    popup_delete.style.transform = "translateY(0)";
  }, 10);
}
function canceldelete() {
  
  popup_delete.style.opacity = 0;
  popup_delete.style.transform = "translateY(-50px)";
  setTimeout(function () {
    $("#popup_delete").addClass("d-none");
    $("#popup_delete").html("");
  }, 300);
}

function toggler() {
  if (localStorage.getItem("data-toggle") == "true") {
    localStorage.removeItem("data-toggle",);
  }
  else {
    localStorage.setItem("data-toggle", "true");
  }
}
window.onload = function () {
  if (localStorage.getItem("data-toggle") == "true") {
    if (window.innerWidth < 767) {
      body.classList.remove("sidebar-open");
    }
    else {
      body.classList.add("sidebar-collapse");
    }
  }
}

function transaksiOpen() {
  var transaksi = document.getElementById("detailTransaksi");
  document.getElementById("overlay").classList.remove("d-none");
  transaksi.classList.remove("d-none");
  
}
function hidetransaksi() {
  var transaksi = document.getElementById("detailTransaksi");
  document.getElementById("overlay").classList.add("d-none");
  transaksi.classList.add("d-none");
}