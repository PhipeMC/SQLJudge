window.onload=function(){
    var text = document.getElementById("inputDescripcion").value,
    target = document.getElementById("targetDiv"),
    converter = new showdown.Converter(),
    html = converter.makeHtml(text);
    target.innerHTML = html;
}