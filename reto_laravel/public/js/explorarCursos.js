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
