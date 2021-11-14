function validationLogin() {
    var nombre = document.querySelector("#txtNombre").value;
    var standarPrice = document.querySelector("#standarPrice").value;
    var timeContract = document.querySelector("#timeContract").value;
    var discount = document.querySelector("#discount").value;

    limpiarValidacionForm();

    let datosValidos = true;

    if (nombre.trim().length >= 8 && nombre.trim().length < 46) {
        document.querySelector("#txtNombre").classList.add("is-valid");
    } else {
        document.querySelector("#txtNombre").classList.add("is-invalid");
        datosValidos = false;
    }

    if (standarPrice != "0") {
        document.querySelector("#standarPrice").classList.add("is-valid");
    } else {
        document.querySelector("#standarPrice").classList.add("is-invalid");
        datosValidos = false;
    }

    if (timeContract != "Elija...") {
        document.querySelector("#timeContract").classList.add("is-valid");
    } else {
        document.querySelector("#timeContract").classList.add("is-invalid");
        datosValidos = false;
    }

    return datosValidos;
}