const app = Vue.createApp({
    data() {
        return {
            ifShow: false,
            selectedActualite: null,
            actualiteData: {
                titre: '',
                libelle: '',
                image: '',
                auteur: '',
                date_publication: '',
                url_actu: '',
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
        openActualiteModal(index) {
            console.log("Ouverture de la modale pour l'actualité index :", index);
            this.selectedActualite = index;
            const actualite = actualites[index];
            this.actualiteData.titre = actualite.titre;
            this.actualiteData.image = actualite.url_image;
            this.actualiteData.libelle = actualite.libelle;
            this.actualiteData.libelle_truncate = actualite.libelle_truncate;
            this.actualiteData.auteur = actualite.auteur;
            this.actualiteData.date_publication = actualite.date_publication;
            this.actualiteData.url_actu = actualite.url_actu;
            this.openModal();
        },        
        closeActualiteModal() {
            this.selectedActualite = null;
            this.closeModal();
        },
    },
});

app.mount('#contenu_actualite');