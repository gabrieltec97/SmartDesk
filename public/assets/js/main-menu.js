 document.addEventListener("DOMContentLoaded", function () {
    const sidenavToggle = document.getElementById("sidenavToggle");
    const body = document.body;
    const sidenav = document.getElementById("sidenav-main");
    const iconAreaTecnica = document.querySelector("#areaTecnicaMenu + a .icon-shape i");

    sidenavToggle.addEventListener("click", function () {
        if (body.classList.contains("g-sidenav-hidden")) {
            body.classList.remove("g-sidenav-hidden");
            body.classList.add("g-sidenav-pinned");
        } else {
            body.classList.remove("g-sidenav-pinned");
            body.classList.add("g-sidenav-hidden");
        }
    });

    // Lógica para o ícone
    sidenav.addEventListener("mouseover", function() {
        if (body.classList.contains("g-sidenav-hidden")) {
            const textElements = sidenav.querySelectorAll(".nav-link-text");
            textElements.forEach(el => {
                el.style.visibility = "visible";
                el.style.opacity = "1";
            });
            // Restaura o tamanho do ícone de Área Técnica ao passar o mouse
            iconAreaTecnica.style.fontSize = "1rem";
        }
    });

    sidenav.addEventListener("mouseout", function() {
        if (body.classList.contains("g-sidenav-hidden")) {
            const textElements = sidenav.querySelectorAll(".nav-link-text");
            textElements.forEach(el => {
                el.style.visibility = "";
                el.style.opacity = "";
            });
            // Reduz o tamanho do ícone de Área Técnica ao remover o mouse
            iconAreaTecnica.style.fontSize = ""; // ou "0.8rem", dependendo do valor original
        }
    });
});