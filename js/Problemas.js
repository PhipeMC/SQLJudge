/*var text = document.getElementById("inputDescripcion").value,
    target = document.getElementById("targetDiv"),
    converter = new showdown.Converter(),
    html = converter.makeHtml(text);
    target.innerHTML = html; 

*/
function verCodigo(x, y) {
    debugger;
    var titulo =  document.getElementById("tituloEnvio");
    titulo.innerText = "Envio #"+x ;

    var cuerpo = document.getElementById("problemo");
    //cuerpo.value = y;
    alert(cuerpo.value);

    var modalCode = new bootstrap.Modal(document.getElementById("exampleModal"), {
        keyboard: false,
    });
    modalCode.show();

}


