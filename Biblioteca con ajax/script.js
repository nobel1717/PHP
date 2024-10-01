// Arreglo para almacenar préstamos activos
const prestamosActivos = [];

// Función para mostrar libros disponibles
function mostrarLibros() {
    const listaLibros = document.getElementById("lista-libros");
    const libroSelect = document.getElementById("libro");

    // Realizar petición AJAX a PHP para obtener los libros
    fetch('clases.php')
        .then(response => response.json())
        .then(libros => {
            listaLibros.innerHTML = "";
            libroSelect.innerHTML = "<option value=''>Selecciona un libro</option>"; // Reset select

            libros.forEach(libro => {
                // Mostrar en lista
                listaLibros.innerHTML += `<li class="list-group-item">${libro.titulo} - Disponibles: ${libro.cantidad}</li>`;
                // Agregar opción al select
                libroSelect.innerHTML += `<option value="${libro.codigo}">${libro.titulo}</option>`;
            });
        })
        .catch(error => console.error('Error al obtener los libros:', error));
}

// Función para manejar el préstamo o devolución
function manejarPrestamo(event) {
    event.preventDefault(); // Evitar que se recargue la página
    const nombreEstudiante = document.getElementById("nombre").value;
    const libroCodigo = document.getElementById("libro").value;
    const accion = document.querySelector('input[name="accion"]:checked').value;

    // Realizar una nueva petición para obtener los libros actualizados
    fetch('clases.php')
        .then(response => response.json())
        .then(libros => {
            const libroSeleccionado = libros.find(libro => libro.codigo === libroCodigo);

            if (!libroSeleccionado) {
                mostrarMensaje("Selecciona un libro válido.", "danger");
                return;
            }

            if (accion === "solicitar") {
                const prestamoExistente = prestamosActivos.find(prestamo => prestamo.estudiante === nombreEstudiante && prestamo.libro === libroSeleccionado.titulo);
                
                if (prestamoExistente) {
                    mostrarMensaje(`El estudiante '${nombreEstudiante}' ya ha solicitado el libro '${libroSeleccionado.titulo}'.`, "warning");
                    return;
                }
                
                if (libroSeleccionado.cantidad > 0) {
                    libroSeleccionado.cantidad--;
                    prestamosActivos.push({ estudiante: nombreEstudiante, libro: libroSeleccionado.titulo });
                    mostrarMensaje(`Préstamo aprobado para el libro: ${libroSeleccionado.titulo}`, "success");
                } else {
                    mostrarMensaje("No hay libros disponibles para el préstamo.", "danger");
                }
            } else if (accion === "devolver") {
                const index = prestamosActivos.findIndex(prestamo => prestamo.estudiante === nombreEstudiante && prestamo.libro === libroSeleccionado.titulo);
                if (index !== -1) {
                    libroSeleccionado.cantidad++;
                    prestamosActivos.splice(index, 1); // Eliminar préstamo activo
                    mostrarMensaje(`El libro '${libroSeleccionado.titulo}' ha sido devuelto con éxito.`, "success");
                } else {
                    mostrarMensaje(`No se encontró un préstamo para el libro '${libroSeleccionado.titulo}' por el estudiante '${nombreEstudiante}'.`, "danger");
                }
            }

            actualizarPrestamos(); // Actualizar la lista de préstamos activos
            mostrarLibros(); // Actualizar la lista de libros
        })
        .catch(error => console.error('Error al manejar el préstamo:', error));
}

// Función para mostrar mensajes
function mostrarMensaje(mensaje, tipo) {
    const mensajeDiv = document.getElementById("mensaje");
    mensajeDiv.className = `alert alert-${tipo}`;
    mensajeDiv.innerText = mensaje;
    mensajeDiv.style.display = "block";

    // Ocultar el mensaje después de 3 segundos
    setTimeout(function() {
        mensajeDiv.style.display = 'none';
    }, 3000);
}

// Función para actualizar la lista de préstamos activos
function actualizarPrestamos() {
    const listaPrestamos = document.getElementById("prestamos-activos");
    listaPrestamos.innerHTML = ""; // Limpiar lista

    prestamosActivos.forEach(prestamo => {
        listaPrestamos.innerHTML += `<li class="list-group-item">${prestamo.estudiante} ha solicitado '${prestamo.libro}'</li>`;
    });
}

// Evento de envío del formulario
document.getElementById("formulario").addEventListener("submit", manejarPrestamo);

// Inicializar la aplicación
mostrarLibros();
