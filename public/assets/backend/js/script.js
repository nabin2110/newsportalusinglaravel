document.addEventListener('DOMContentLoaded', function () {
    // Get the filter button and the filter form
    var filterToggle = document.getElementById('filterToggle');
    var filterForm = document.getElementById('filterForm');

    // Toggle the filter form visibility on button click
    filterToggle.addEventListener('click', function () {
        filterForm.classList.toggle('open'); // Toggle 'open' class
    });

    // Close the filter form if clicked outside
    document.addEventListener('click', function (event) {
        var isClickInside = filterForm.contains(event.target) || filterToggle.contains(event.target);
        if (!isClickInside) {
            filterForm.classList.remove('open'); // Close the filter form if clicked outside
        }
    });
});