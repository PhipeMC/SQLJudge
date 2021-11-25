CodeMirror.fromTextArea(document.querySelector("#envProblema"), {
    lineNumbers: true,
    tabSize: 16,
    value: "SELECT * FROM WORLD;",
    mode: "sql",
    lineWrapping: true,
});
