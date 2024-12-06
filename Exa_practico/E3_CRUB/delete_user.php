<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];

    $db = new Database();
    $conn = $db->getConnection();

    $query = "DELETE FROM Usuarios WHERE Id_usuario = :id_usuario";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_usuario', $id_usuario);

    if ($stmt->execute()) {
        echo "Usuario eliminado con éxito.";
        header("Location: user_list.php");
        exit;
    } else {
        echo "Error al eliminar el usuario.";
    }
} else {
    echo "ID de usuario no proporcionado.";
}
?>
