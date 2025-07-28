function openModal(formElement) {
    const modal = document.getElementById("modal-confirm");
    const modalForm = document.getElementById("modal-form");
    const methodInput = modalForm.querySelector('input[name="_method"]');

    modalForm.action = formElement.action;

    if (formElement.querySelector('input[name="_method"]')) {
        methodInput.value = formElement.querySelector(
            'input[name="_method"]'
        ).value;
    } else if (methodInput) {
        methodInput.remove();
    }

    modal.style.display = "flex";
}

function closeModal() {
    document.getElementById("modal-confirm").style.display = "none";
}

window.onclick = function (event) {
    const modal = document.getElementById("modal-confirm");
    if (event.target === modal) {
        closeModal();
    }
};

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