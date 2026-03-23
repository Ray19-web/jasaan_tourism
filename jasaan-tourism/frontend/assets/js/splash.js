window.addEventListener("load", function () {
    if (sessionStorage.getItem("splashShown")) {
        document.getElementById("splashScreen").style.display = "none";
        document.getElementById("mainContent").style.display = "block";
        return;
    }

    setTimeout(() => {
        document.getElementById("splashScreen").style.display = "none";
        document.getElementById("mainContent").style.display = "block";
        sessionStorage.setItem("splashShown", "true");
    }, 2500);
});