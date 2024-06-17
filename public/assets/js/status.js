document.addEventListener("DOMContentLoaded", function () {
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has("editSuccess")) {
        document.getElementById("successEditModal").style.display = "flex";
        setTimeout(function () {
            document.getElementById("successEditModal").style.display = "none";
            window.scrollTo({ top: 0, behavior: "smooth" });
            var newUrl =
                window.location.protocol +
                "//" +
                window.location.host +
                window.location.pathname;
            window.history.replaceState({}, document.title, newUrl);
        }, 4000);
    }

    if (urlParams.has("deleteSuccess")) {
        document.getElementById("successDeleteModal").style.display = "flex";
        setTimeout(function () {
            document.getElementById("successDeleteModal").style.display = "none";
            window.scrollTo({ top: 0, behavior: "smooth" });
            var newUrl =
                window.location.protocol +
                "//" +
                window.location.host +
                window.location.pathname;
            window.history.replaceState({}, document.title, newUrl);
        }, 4000);
    }

    if (urlParams.has("addSuccess")) {
        document.getElementById("successAddModal").style.display = "flex";
        setTimeout(function () {
            document.getElementById("successAddModal").style.display = "none";
            window.scrollTo({ top: 0, behavior: "smooth" });
            var newUrl =
                window.location.protocol +
                "//" +
                window.location.host +
                window.location.pathname;
            window.history.replaceState({}, document.title, newUrl);
        }, 4000);
    }

});
