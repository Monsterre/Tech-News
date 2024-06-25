document.addEventListener('DOMContentLoaded', function () {
    function performSearch() {
        var searchTerm = document.getElementById('searchCritiqueInput').value.toLowerCase();
        var critiqueContainers = document.querySelectorAll('.critique-container');

        critiqueContainers.forEach(function (container) {
            var titleElement = container.querySelector('.titre_critique');
            var titleValue = titleElement.getAttribute('value').toLowerCase();
            container.style.display = titleValue.includes(searchTerm) ? 'block' : 'none';
        });
    }

    var searchInput = document.getElementById('searchCritiqueInput');
    if (searchInput) {
        searchInput.addEventListener('input', performSearch);
    }
});