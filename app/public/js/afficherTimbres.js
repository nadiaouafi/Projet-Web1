async function chargerTimbres() {
    try {
        let response = await fetch("http://localhost/stampee/public/api/timbres.php");
        let timbres = await response.json();

        let container = document.getElementById("liste-timbres");
        container.innerHTML = "";

        timbres.forEach(timbre => {
            let card = document.createElement("div");
            card.classList.add("timbre-card");

            card.innerHTML = `
                <h3>${timbre.nom}</h3>
                <img src="public/img/${timbre.image_principale}" alt="${timbre.nom}" />
                <p>${timbre.description}</p>
                <a href="detail.html?id=${timbre.id}">Voir détails</a>
            `;
            container.appendChild(card);
        });
    } catch (err) {
        console.error("Erreur :", err);
    }
}

// Charger au démarrage
document.addEventListener("DOMContentLoaded", chargerTimbres);
