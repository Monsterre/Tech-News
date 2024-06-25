document.addEventListener('DOMContentLoaded', function () {
    function performSearch() {
        var searchTerm = document.getElementById('searchGuideInput').value.toLowerCase();
        var guideContainers = document.querySelectorAll('.guide-container');

        guideContainers.forEach(function (container) {
            var titleElement = container.querySelector('.titre_guide');
            var titleValue = titleElement.getAttribute('value').toLowerCase();
            container.style.display = titleValue.includes(searchTerm) ? 'block' : 'none';
        });
    }

    var searchInput = document.getElementById('searchGuideInput');
    if (searchInput) {
        searchInput.addEventListener('input', performSearch);
    }
});