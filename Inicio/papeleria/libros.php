<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Detalles de conexión a la base de datos
    $servername = "localhost"; // Cambia esto por la dirección de tu servidor de base de datos
    $username = "tu_usuario"; // Cambia esto por tu nombre de usuario de la base de datos
    $password = "tu_contraseña"; // Cambia esto por tu contraseña de la base de datos
    $database = "tu_base_de_datos"; // Cambia esto por el nombre de tu base de datos

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $imagen = $_FILES['imagen']['name']; // Nombre del archivo de imagen
    $imagen_temp = $_FILES['imagen']['tmp_name']; // Ruta temporal del archivo de imagen

    // Mover la imagen a la carpeta de destino
    $carpeta_destino = "imagenes_libros/";
    move_uploaded_file($imagen_temp, $carpeta_destino . $imagen);

    // Insertar datos en la base de datos
    $sql = "INSERT INTO libros (nombre, precio, imagen) VALUES ('$nombre', '$precio', '$imagen')";
    if ($conn->query($sql) === TRUE) {
        echo "Libro agregado correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
}
?>
