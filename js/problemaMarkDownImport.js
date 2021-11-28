window.onload=function(){
    var modalAgregar = new bootstrap.Modal(document.getElementById('modalEliminar'), {
        keyboard: false
    });
    modalAgregar.show();
    var text = document.getElementById("inputDescripcion").value,
    target = document.getElementById("targetDiv"),
    converter = new showdown.Converter(),
    html = converter.makeHtml(text);
    target.innerHTML = html;
    
    
    
}

