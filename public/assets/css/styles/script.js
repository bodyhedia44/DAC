var hamburger = document.querySelector("nav .hamburger-button");
var navbar = document.querySelector("nav ul");
hamburger.onclick = () => {
    if (navbar.style.opacity === "1") {
        navbar.style.display = "none";
        navbar.style.opacity = "0";
    } else {
        navbar.style.display = "flex";
        navbar.style.opacity = "1";
    }
}