function toggleSearchValueInput(checkboxId, inputId) {
    var checkbox = document.getElementById(checkboxId);
    var input = document.getElementById(inputId);
    

    if (checkbox.checked) {
        input.removeAttribute("disabled");
    } else {
        input.setAttribute("disabled", "true");
    }
}
