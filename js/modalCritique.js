const app = Vue.createApp({
    data() {
        return {
            ifShow: false,
            selectedCritique: null,
            critiqueData: {
                titre: '',
                libelle: '',
                image: '',
                auteur: '',
                date_publication: '',
                url_critique: '',
            },
        };
    },
    methods: {
        openModal() {
            this.ifShow = true;
        },
        closeModal() {
            this.ifShow = false;
        },
        openCritiqueModal(index) {
            console.log("Ouverture de la modale pour l'actualité index :", index);
            this.selectedCritique = index;
            const critique = critiques[index];
            this.critiqueData.titre = critique.titre;
            this.critiqueData.image = critique.url_image;
            this.critiqueData.libelle = critique.libelle;
            this.critiqueData.libelle_truncate = critique.libelle_truncate;
            this.critiqueData.auteur = critique.auteur;
            this.critiqueData.date_publication = critique.date_publication;
            this.critiqueData.url_critique = critique.url_critique;
            this.openModal();
        },        
        closeCritiqueModal() {
            this.selectedCritique = null;
            this.closeModal();
        },
    },
});

app.mount('#contenu_critique');