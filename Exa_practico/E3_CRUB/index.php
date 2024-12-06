<?php
include 'db_connection.php';

$db = new Database();
$conn = $db->getConnection();

$query = "SELECT * FROM Usuarios";
$stmt = $conn->prepare($query);
$stmt->execute();

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Usuarios</title>
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
        a {
            text-decoration: none;
            color: #fff;
            background-color: #4CAF50;
            padding: 5px 10px;
            border-radius: 5px;
        }
        a:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .action-links a {
            margin: 0 5px;
        }
    </style>
</head>
<body>
    <h1>Lista de Usuarios</h1>
    <a href="add_user.php">Agregar Nuevo Usuario</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre de Usuario</th>
            <th>Perfil</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?php echo htmlspecialchars($usuario['Id_usuario']); ?></td>
            <td><?php echo htmlspecialchars($usuario['Nombre_usuario']); ?></td>
            <td><?php echo htmlspecialchars($usuario['Id_perfil']); ?></td>
            <td class="action-links">
                <a href="edit_user.php?id=<?php echo $usuario['Id_usuario']; ?>">Editar</a>
                <a href="delete_user.php?id=<?php echo $usuario['Id_usuario']; ?>" 
                   onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
