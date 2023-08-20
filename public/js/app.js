let filterCompany = document.getElementById("filter_company_id");

if (filterCompany) {
    filterCompany.addEventListener("change", function () {
        let companyId = this.value || this.options[this.selectedIndex].value;
        window.location.href =
            window.location.href.split("?")[0] + "?company_id=" + companyId;
    });
}

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

let btn_clear = document.getElementById("btn-clear");
if (btn_clear) {
    btn_clear.addEventListener("click", function () {
        let input = document.getElementById("search");
        if (input) input.value = "";

        let select = document.getElementById("filter_company_id");
        if (select) select.selectedIndex = 0;

        window.location.href = window.location.href.split("?")[0];
    });
}

function toggleClearButton() {
    let query = window.location.search;
    let pattern = /[?&]search=/;
    if (pattern.test(query)) {
        document.getElementById("btn-clear").style.display = "block";
    } else {
        document.getElementById("btn-clear").style.display = "none";
    }

    // let input = document.getElementById("search");
    // let select = document.getElementById("filter_company_id");
    // let clearButton = document.getElementById("btn-clear");

    // if (input.value.length > 0 || select.selectedIndex > 0) {
    //     clearButton.style.display = "block";
    // } else {
    //     clearButton.style.display = "none";
    // }
}

toggleClearButton();
