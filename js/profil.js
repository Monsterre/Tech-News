document.addEventListener('DOMContentLoaded', function () {
    // Récupérez le bouton et la section du formulaire de modification du mot de passe
    const boutonMotDePasse = document.getElementById('boutonMotDePasse');
    const sectionMotDePasse = document.getElementById('sectionMotDePasse');

    // Ajoutez un écouteur d'événement pour le clic sur le bouton
    boutonMotDePasse.addEventListener('click', function () {
        // Affichez ou masquez la section du formulaire de modification du mot de passe
        sectionMotDePasse.style.display = (sectionMotDePasse.style.display === 'none' || sectionMotDePasse.style.display === '') ? 'block' : 'none';
    });
});
