/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

document.addEventListener("DOMContentLoaded", function () {
    const rowsPerPage = 10;
    const maxPageNumbers = 5; // Batas jumlah nomor halaman yang ditampilkan
    const tableBody = document.getElementById("guestTableBody");
    const rows = Array.from(tableBody.getElementsByTagName("tr"));
    const pagination = document.getElementById("pagination");
    const totalPages = Math.ceil(rows.length / rowsPerPage);
    let currentPage = 1;

    function displayPage(page) {
        // Display the rows for the current page
        rows.forEach((row, index) => {
            row.style.display = "none";
            if (index >= (page - 1) * rowsPerPage && index < page * rowsPerPage) {
                row.style.display = "table-row";
            }
        });

        // Update pagination buttons
        pagination.innerHTML = "";

        // Previous button
        const prevButton = document.createElement("button");
        prevButton.textContent = "Previous";
        prevButton.disabled = page === 1;
        prevButton.addEventListener("click", () => displayPage(page - 1));
        pagination.appendChild(prevButton);

        // Calculate start and end page numbers for pagination
        let startPage = Math.max(page - Math.floor(maxPageNumbers / 2), 1);
        let endPage = Math.min(startPage + maxPageNumbers - 1, totalPages);

        // Adjust startPage if we're near the end to show the last set of pages
        if (endPage - startPage + 1 < maxPageNumbers) {
            startPage = Math.max(endPage - maxPageNumbers + 1, 1);
        }

        // Page number buttons
        for (let i = startPage; i <= endPage; i++) {
            const button = document.createElement("button");
            button.textContent = i;
            if (i === page) button.classList.add("active");
            button.addEventListener("click", () => displayPage(i));
            pagination.appendChild(button);
        }

        // Next button
        const nextButton = document.createElement("button");
        nextButton.textContent = "Next";
        nextButton.disabled = page === totalPages;
        nextButton.addEventListener("click", () => displayPage(page + 1));
        pagination.appendChild(nextButton);
    }

    displayPage(currentPage);
});


