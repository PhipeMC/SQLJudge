function run() {
  var text = document.getElementById("inputDescripcion").value,
    target = document.getElementById("targetDiv"),
    converter = new showdown.Converter(),
    html = converter.makeHtml(text);

  target.innerHTML = html;
  console.log(text);
}

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  "use strict";

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll(".needs-validation");

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener(
      "submit",
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add("was-validated");
      },
      false
    );
  });
})();

var descripcion = document.querySelector("#inputDescripcion");
descripcion.addEventListener("keydown", autosize);

var consulta = document.querySelector("#inputSolucion");
consulta.addEventListener("keydown", autosize);

function autosize() {
  var el = this;
  setTimeout(function () {
    el.style.cssText = "height:50%; padding:0";
    el.style.cssText = "height:" + el.scrollHeight + "px";
  }, 0);
}

/////CODE MIRROR

CodeMirror.fromTextArea(document.querySelector('#inputSolucion'),{
  lineNumbers: true,
  tabSize: 16,
  value: 'SELECT * FROM WORLD;',
  mode: 'sql',
  lineWrapping: true
});