document.addEventListener('DOMContentLoaded', function () {
    function performSearch() {
        var searchTerm = document.getElementById('searchRecommandationInput').value.toLowerCase();
        var recommandationContainers = document.querySelectorAll('.produit-container');

        recommandationContainers.forEach(function (container) {
            var nomElement = container.querySelector('.nom_produit');
            var nomValue = nomElement.getAttribute('value').toLowerCase();
            var isVisible = nomValue.includes(searchTerm) && isCategorySelected(container);
            container.style.display = isVisible ? 'block' : 'none';
        });
    }

    function isCategorySelected(container) {
        var selectedCategories = document.querySelectorAll('input[name="categories[]"]:checked');
        if (selectedCategories.length === 0) {
            return true; // Si aucune catégorie n'est sélectionnée, afficher l'élément
        }

        var productCategory = container.getAttribute('data-categorie').toLowerCase();
        return Array.from(selectedCategories).some(function (checkbox) {
            return checkbox.value.toLowerCase() === productCategory;
        });
    }

    var searchInput = document.getElementById('searchRecommandationInput');
    if (searchInput) {
        searchInput.addEventListener('input', performSearch);
    }

    var categoryCheckboxes = document.querySelectorAll('input[name="categories[]"]');
    categoryCheckboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', performSearch);
    });
});