const app = Vue.createApp({
    data() {
        return {
            ifShow: false,
            selectedFavorie: null,
            favorieData: {
                titre: '',
                libelle: '',
                image: '',
                auteur: '',
                date_publication: '',
                url_favorie: '',
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
        getUrlFavorie(favorie) {
            // Switch pour déterminer l'URL appropriée en fonction de la catégorie
            switch (favorie.category) {
                case 'Actualités':
                    return favorie.url_actu;
                case 'Guides':
                    return favorie.url_guide;
                case 'Critiques':
                    return favorie.url_critique;
                default:
                    return ''; // Fallback si la catégorie n'est pas reconnue
            }
        },
        openFavorieModal(index) {
            console.log("Ouverture de la modale pour l'actualité index :", index);
            this.selectedFavorie = index;
            const favorie = favories[index];
            this.favorieData.titre = favorie.titre;
            this.favorieData.image = favorie.url_image;
            this.favorieData.libelle = favorie.libelle;
            this.favorieData.libelle_truncate = favorie.libelle_truncate;
            this.favorieData.auteur = favorie.auteur;
            this.favorieData.date_publication = favorie.date_publication;
            this.favorieData.url_favorie = this.getUrlFavorie(favorie);
            this.openModal();
        },
        closeFavorieModal() {
            this.selectedFavorie = null;
            this.closeModal();
        },
    },
});

app.mount('#contenu_favorie');