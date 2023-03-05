const toggleButton = document.getElementById("toggleMenuCat");
const menuCat = document.querySelector(".menuCat");

toggleButton.addEventListener("click", function () {
  menuCat.classList.toggle("active");
  if (menuCat.classList.contains("active")) {
    menuCat.style.left = 0 + "px";
  } else {
    menuCat.style.left = "-400px";
  }
});

function setTopValue() {
  if (menuCat.classList.contains("active")) {
    if (window.innerWidth < 700) {
      menuCat.style.top = 105 + "px";
    } else {
      menuCat.style.top = 90 + "px";
    }
  }
}

window.addEventListener("scroll", setTopValue);
window.addEventListener("resize", setTopValue);

menuCat.addEventListener("transitionend", setTopValue);
