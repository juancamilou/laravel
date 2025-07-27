document.addEventListener("DOMContentLoaded", function () {
    const filas = document.querySelectorAll("table tbody tr");
    const input = document.getElementById("buscador");
    const contador = document.getElementById("contadorInscritos");
    const mensaje = document.getElementById("mensajeNoResultados");

    function actualizarContadorYMensaje() {
        let visibles = 0;
        filas.forEach((fila) => {
            if (fila.style.display !== "none") {
                visibles++;
            }
        });

        contador.innerHTML = `<i class="fas fa-user-check"></i> Total inscritos encontrados: <strong>${visibles}</strong>`;

        mensaje.style.display = visibles === 0 ? "block" : "none";
    }

    input.addEventListener("input", function () {
        const valor = this.value.toLowerCase();

        filas.forEach((fila) => {
            const textoFila = fila.textContent.toLowerCase();
            fila.style.display = textoFila.includes(valor) ? "" : "none";
        });

        actualizarContadorYMensaje();
    });

    actualizarContadorYMensaje(); // Contador inicial
});
