<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];

    $db = new Database();
    $conn = $db->getConnection();

    $query = "SELECT * FROM Usuarios WHERE Id_usuario = :id_usuario";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_usuario', $id_usuario);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        echo "Usuario no encontrado.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contraseña = $_POST['contraseña'];
    $id_perfil = $_POST['id_perfil'];

    $query = "UPDATE Usuarios SET Nombre_usuario = :nombre_usuario, Contraseña = :contraseña, Id_perfil = :id_perfil WHERE Id_usuario = :id_usuario";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':nombre_usuario', $nombre_usuario);
    $stmt->bindParam(':contraseña', password_hash($contraseña, PASSWORD_DEFAULT));
    $stmt->bindParam(':id_perfil', $id_perfil);
    $stmt->bindParam(':id_usuario', $id_usuario);

    if ($stmt->execute()) {
        echo "Usuario actualizado con éxito.";
        header("Location: user_list.php");
        exit;
    } else {
        echo "Error al actualizar el usuario.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #4CAF50;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            max-width: 400px;
            margin: 20px auto;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Editar Usuario</h1>
    <form method="POST">
        <label for="nombre_usuario">Nombre de Usuario:</label>
        <input type="text" id="nombre_usuario" name="nombre_usuario" value="<?php echo htmlspecialchars($usuario['Nombre_usuario']); ?>" required>
        
        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" required>
        
        <label for="id_perfil">Perfil (ID):</label>
        <input type="number" id="id_perfil" name="id_perfil" value="<?php echo htmlspecialchars($usuario['Id_perfil']); ?>" required>
        
        <button type="submit">Actualizar Usuario</button>
    </form>
</body>
</html>
