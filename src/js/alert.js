var alertDiv = document.getElementById("alert");
function alertP(type, text) {
  setTimeout(function () {
    if (type === 'success') {
      alertDiv.innerHTML = '<div class="alert alert-success bg-green-400 p-3 h5 alert-link" role="alert"><ion-icon name="checkmark" class="px-2 link-alert"></ion-icon> ' + text + '</div>';
    } else if (type === 'error') {
      alertDiv.innerHTML = '<div class="alert alert-danger p-3 h5 alert-link" role="alert"><ion-icon name="close-circle-outline" class="px-1 link-alert"></ion-icon>' + text + '</div>';
    }
  },100)
  setTimeout(function () {
    alertDiv.innerHTML = "";
  }, 3500);
}