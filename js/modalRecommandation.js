const app = Vue.createApp({
    data() {
        return {
            ifShow: false,
            selectedRecommandation: null,
            recommandationData: {
                nom: '',
                libelle: '',
                image: '',
                categorie: '',
                url_produit: '',
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
        openRecommandationModal(index) {
            console.log("Ouverture de la modale pour l'actualité index :", index);
            this.selectedRecommandation = index;
            const recommandation = recommandations[index];
            this.recommandationData.nom = recommandation.nom;
            this.recommandationData.image = recommandation.image_produit;
            this.recommandationData.categorie = recommandation.categorie_nom;
            this.recommandationData.libelle = recommandation.libelle;
            this.recommandationData.url_produit = recommandation.url_produit;
            this.recommandationData.libelle_truncate = recommandation.libelle_truncate;
            this.openModal();
        },        
        closeRecommandationModal() {
            this.selectedRecommandation = null;
            this.closeModal();
        },
    },
});

app.mount('#container_recommandation');