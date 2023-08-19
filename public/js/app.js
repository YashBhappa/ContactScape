document
    .getElementById("filter_company_id")
    .addEventListener("change", function () {
        let companyId = this.value || this.options[this.selectedIndex].value;
        window.location.href =
            window.location.href.split("?")[0] + "?company_id=" + companyId;
    });

document.querySelectorAll("#btn-delete").forEach(function (element) {
    element.addEventListener("click", function (event) {
        event.preventDefault();
        let url = this.getAttribute("href");
        console.log(url);
        let form = document.getElementById("form-delete");
        form.setAttribute("action", url);

        if (confirm("Are you sure?")) {
            form.submit();
        }
    });
});
