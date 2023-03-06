var mainBtn = document.getElementById("mainBtn");
var submenu = document.getElementById("submenu");

mainBtn.addEventListener("click", function() {
  if (submenu.style.display === "none") {
    submenu.style.display = "block";
  } else {
    submenu.style.display = "none";
  }
});
