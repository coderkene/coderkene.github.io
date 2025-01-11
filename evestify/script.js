//for the hamburger menu on all pages
const menuToggle = document.getElementById("mobile-menu");
const navList = document.querySelector(".nav-list");

menuToggle.addEventListener("click", () => {
  navList.classList.toggle("active");
});


//for the faq page
var acc = document.getElementsByClassName("accordion");
var i;
for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function () {
    /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
    this.classList.toggle("active");

    /* Toggle between hiding and showing the active panel */
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}

//for the plans page
const tableTitles = document.querySelectorAll(".table-title");
tableTitles.forEach(title => {
  title.addEventListener("click", () => {
    const container = title.nextElementSibling;
    container.style.display = container.style.display === "block" ? "none" : "block";
  });
});