document.addEventListener('DOMContentLoaded', function () {
    function performSearch() {
        var searchTerm = document.getElementById('searchFavorieInput').value.toLowerCase();
        var favorieContainers = document.querySelectorAll('.favorie-container');

        favorieContainers.forEach(function (container) {
            var titleElement = container.querySelector('.titre_favorie');
            var titleValue = titleElement.getAttribute('value').toLowerCase();
            var isVisible = titleValue.includes(searchTerm) && isCategorySelected(container);
            container.style.display = isVisible ? 'block' : 'none';
        });
    }

    function isCategorySelected(container) {
        var selectedCategories = document.querySelectorAll('input[name="categories[]"]:checked');
        if (selectedCategories.length === 0) {
            return true; // Si aucune catégorie n'est sélectionnée, afficher l'élément
        }

        var productCategory = container.getAttribute('data-category').toLowerCase();
        return Array.from(selectedCategories).some(function (checkbox) {
            return checkbox.value.toLowerCase() === productCategory;
        });
    }

    var searchInput = document.getElementById('searchFavorieInput');
    if (searchInput) {
        searchInput.addEventListener('input', performSearch);
    }

    var categoryCheckboxes = document.querySelectorAll('input[name="categories[]"]');
    categoryCheckboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', performSearch);
    });
});
    