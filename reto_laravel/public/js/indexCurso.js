function generarColores(cantidad) {
    const colores = [];
    for (let i = 0; i < cantidad; i++) {
        const color = `hsl(${Math.floor((i * 360) / cantidad)}, 65%, 60%)`;
        colores.push(color);
    }
    return colores;
}

document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById("graficoPastel")?.getContext("2d");
    if (!ctx || !Array.isArray(cursoNombres) || !Array.isArray(cursoInscritos))
        return;

    const tipoGrafico = cursoNombres.length <= 10 ? "pie" : "bar";

    new Chart(ctx, {
        type: tipoGrafico,
        data: {
            labels: cursoNombres,
            datasets: [
                {
                    label: "Inscripciones por curso",
                    data: cursoInscritos,
                    backgroundColor: generarColores(cursoNombres.length),
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: tipoGrafico === "pie" ? "bottom" : "top" },
            },
            ...(tipoGrafico === "bar" && {
                indexAxis: "y",
                scales: {
                    x: {
                        beginAtZero: true,
                    },
                },
            }),
        },
    });
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
