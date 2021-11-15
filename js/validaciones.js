function startSession() {
    if (validation()) {
        alert("Funciona");
    } else {
        alert("No funciona");
    }
}

function validationLogin() {
    var correo = document.querySelector("#txtUsuario").value;
    var contra = document.querySelector("#txtContrasenia").value;
    var tipo = document.querySelector("#selectUser").value;

    limpiarValidacionForm();

    let datosValidos = true;

    if (correo.trim().length >= 8 && correo.trim().length < 81) {
        document.querySelector("#txtUsuario").classList.add("is-valid");
    } else {
        document.querySelector("#txtUsuario").classList.add("is-invalid");
        datosValidos = false;
    }

    if (contra.trim().length >= 8 && contra.trim().length < 21) {
        document.querySelector("#txtContrasenia").classList.add("is-valid");
    } else {
        document.querySelector("#txtContrasenia").classList.add("is-invalid");
        datosValidos = false;
    }

    if (tipo != "¿Tipo de usuario?...") {
        document.querySelector("#selectUser").classList.add("is-valid");
    } else {
        document.querySelector("#selectUser").classList.add("is-invalid");
        datosValidos = false;
    }

    return datosValidos;
}

function limpiarValidacionForm() {
    document.querySelectorAll(`#frmLogin input`).forEach(function (element) {
        element.classList.remove("is-valid");
        element.classList.remove("is-invalid");
    });

    document.querySelectorAll(`#frmLogin select`).forEach(function (element) {
        element.classList.remove("is-valid");
        element.classList.remove("is-invalid");
    });
}
