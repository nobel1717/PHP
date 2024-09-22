function agregarFila() {
    var table = document.getElementById("tabla-articulos").getElementsByTagName("tbody")[0];
    var nuevaFila = table.insertRow();
    nuevaFila.innerHTML = `
        <td><input type="text" name="articulo[]" class="form-control" placeholder="Artículo"></td>
        <td><input type="number" name="cantidad[]" class="form-control" placeholder="Cantidad"></td>
        <td><input type="number" name="precio[]" step="0.01" class="form-control" placeholder="Precio Unitario"></td>
    `;
}
