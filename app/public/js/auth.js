// Variables
 let utilisateurs = [];


// element HTML
const prenom = document.getElementById("prenom");
const nom = document.getElementById("nom");
const email = document.getElementById("email");
const password = document.getElementById("password");
const confirmPassword = document.getElementById("confirm-password");



function init() {
    console.log("Initialisation du module utilisateur...");

    // Fonction d'inscription
    function inscrire(pseudo, email, motDePasse) {
        // Validation
        if (!pseudo || !email || !motDePasse) {
            return { succes: false, message: "Tous les champs sont obligatoires." };
        }
        if (utilisateurs.some(u => u.pseudo === pseudo || u.email === email)) {
            return { succes: false, message: "Pseudo ou email déjà utilisé." };
        }

        // Enregistrement
        utilisateurs.push({
            pseudo,
            email,
            motDePasse, 
            dateInscription: new Date()
        });

        return { succes: true, message: "Inscription réussie !" };
    }

    // Fonction de connexion
    function connecter(email, motDePasse) {
        let utilisateur = utilisateurs.find(u => u.email === email && u.motDePasse === motDePasse);
        if (utilisateur) {
            return { succes: true, message: `Bienvenue, ${utilisateur.pseudo} !` };
        }
        return { succes: false, message: "Identifiants incorrects." };
    }

    // Démo d'utilisation
    console.log(inscrire("Nadia", "nadia@example.com", "123456"));
    console.log(inscrire("Nadia", "nadia@example.com", "123456")); 
    console.log(connecter("nadia@example.com", "123456"));
    console.log(connecter("nadia@example.com", "mauvaismdp"));
}

init();
