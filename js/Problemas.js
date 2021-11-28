function verCodigo(y) {
    var titulo = document.getElementById("tituloEnvio");
    titulo.innerHTML= "Envio #"+textToHTML(y.name);

    var cuerpo = document.getElementById("problemo");
    cuerpo.innerHTML = textToHTML(y.value);

    var modalCode = new bootstrap.Modal(document.getElementById("exampleModal"), {
        keyboard: false,
    });
    modalCode.show();
}

var support = (function () {
    if (!window.DOMParser) return false;
    var parser = new DOMParser();
    try {
        parser.parseFromString("x", "text/html");
    } catch (err) {
        return false;
    }
    return true;
})();

var textToHTML = function (str) {
    if (support) {
        var parser = new DOMParser();
        var doc = parser.parseFromString(str, "text/html");
        return doc.body.innerHTML;
    }

    var dom = document.createElement("div");
    dom.innerHTML = str;
    return dom;
};

