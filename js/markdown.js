function run() {
    var text = document.getElementById('inputDescripcion').value, 
    target = document.getElementById('targetDiv'), 
    converter = new showdown.Converter(), 
    html = converter.makeHtml(text);

    target.innerHTML = html;
    console.log(text);
}

var descripcion = document.querySelector('#inputDescripcion');
descripcion.addEventListener('keydown', autosize);

var consulta = document.querySelector('#inputSolucion');
consulta.addEventListener('keydown', autosize)
             
function autosize(){
  var el = this;
  setTimeout(function(){
    el.style.cssText = 'height:50%; padding:0';
    el.style.cssText = 'height:' + el.scrollHeight + 'px';
  },0);
}