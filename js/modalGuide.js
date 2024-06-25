const app = Vue.createApp({
    data() {
        return {
            ifShow: false,
            selectedGuide: null,
            guideData: {
                titre: '',
                libelle: '',
                image: '',
                auteur: '',
                date_publication: '',
                url_guide: '',
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
        openGuideModal(index) {
            console.log("Ouverture de la modale pour l'actualité index :", index);
            this.selectedGuide = index;
            const guide = guides[index];
            this.guideData.titre = guide.titre;
            this.guideData.image = guide.url_image;
            this.guideData.libelle = guide.libelle;
            this.guideData.libelle_truncate = guide.libelle_truncate;
            this.guideData.auteur = guide.auteur;
            this.guideData.date_publication = guide.date_publication;
            this.guideData.url_guide = guide.url_guide;
            this.openModal();
        },        
        closeGuideModal() {
            this.selectedGuide = null;
            this.closeModal();
        },
    },
});

app.mount('#contenu_guide');