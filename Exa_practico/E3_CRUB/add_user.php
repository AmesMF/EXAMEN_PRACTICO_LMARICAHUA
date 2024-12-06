<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contraseña = $_POST['contraseña'];
    $id_perfil = $_POST['id_perfil'];

    $db = new Database();
    $conn = $db->getConnection();

    if (empty($nombre_usuario) || empty($contraseña) || empty($id_perfil)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    $query = "INSERT INTO Usuarios (Nombre_usuario, Contraseña, Id_perfil) VALUES (:nombre_usuario, :contraseña, :id_perfil)";
    $stmt = $conn->prepare($query);

    $stmt->bindValue(':nombre_usuario', $nombre_usuario);
    $stmt->bindValue(':contraseña', password_hash($contraseña, PASSWORD_DEFAULT));
    $stmt->bindValue(':id_perfil', $id_perfil);

    try {
        if ($stmt->execute()) {
            echo "Usuario agregado con éxito.";
            header("Location: user_list.php");
            exit;
        } else {
            echo "Error al agregar el usuario.";
        }
    } catch (PDOException $e) {
        echo "Error de ejecución: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Usuario</title>
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
    <h1>Agregar Nuevo Usuario</h1>
    <form method="POST">
        <label for="nombre_usuario">Nombre de Usuario:</label>
        <input type="text" id="nombre_usuario" name="nombre_usuario" required>
        
        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" required>
        
        <label for="id_perfil">Perfil (ID):</label>
        <input type="number" id="id_perfil" name="id_perfil" required>
        
        <button type="submit">Agregar Usuario</button>
    </form>
</body>
</html>
