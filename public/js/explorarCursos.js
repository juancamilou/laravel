document
    .querySelector('input[name="buscar"]')
    .addEventListener("input", function () {
        const valor = this.value.toLowerCase();
        document.querySelectorAll(".card").forEach((card) => {
            const nombre = card.querySelector("h4").textContent.toLowerCase();
            card.style.display = nombre.includes(valor) ? "flex" : "none";
        });

        const cardsVisibles = [...document.querySelectorAll(".card")].filter(
            (card) => card.style.display !== "none"
        );
        document
            .querySelector(".no-result")
            ?.classList.toggle("show", cardsVisibles.length === 0);
    });
// Modal de descripción
window.mostrarModal = function (titulo, descripcion) {
    document.getElementById("tituloCurso").innerText = titulo;
    document.getElementById("descripcionCurso").innerText = descripcion;
    document.getElementById("descripcionModal").style.display = "block";
};

window.cerrarModal = function () {
    document.getElementById("descripcionModal").style.display = "none";
};

window.onclick = function (event) {
    const modal = document.getElementById("descripcionModal");
    if (event.target === modal) {
        cerrarModal();
    }
};
