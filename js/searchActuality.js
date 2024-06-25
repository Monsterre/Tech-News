document.addEventListener('DOMContentLoaded', function () {
    function performSearch() {
        var searchTerm = document.getElementById('searchActualityInput').value.toLowerCase();
        var actualiteContainers = document.querySelectorAll('.actualite-container');

        actualiteContainers.forEach(function (container) {
            var titleElement = container.querySelector('.titre_actualite');
            var titleValue = titleElement.getAttribute('value').toLowerCase();
            container.style.display = titleValue.includes(searchTerm) ? 'block' : 'none';
        });
    }

    var searchInput = document.getElementById('searchActualityInput');
    if (searchInput) {
        searchInput.addEventListener('input', performSearch);
    }
});