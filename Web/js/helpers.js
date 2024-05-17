document.getElementById('formulario').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita el envío normal del formulario

    var numero = document.getElementById('numero').value;

    // Crea un objeto XMLHttpRequest
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'numeros.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Define lo que sucede cuando la solicitud está completa
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Actualiza el contenido del div resultado con la respuesta del servidor
            document.getElementById('torre').innerHTML = xhr.responseText;
        } else {
            console.error('Error en la solicitud AJAX');
        }
    };

    // Envía los datos del formulario
    xhr.send('numero=' + encodeURIComponent(numero) + '&calcularMaya=1');
});
