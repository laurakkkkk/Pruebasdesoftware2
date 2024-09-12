<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro y Lista de Usuarios</title>
</head>
<body>
    <h1>Registrar nuevo usuario</h1>
    <!-- Formulario de Registro -->
    <form action="" method="POST">
        <label for="cedula">Cédula:</label>
        <input type="text" name="cedula" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required><br><br>

        <label for="username">Nombre de Usuario:</label>
        <input type="text" name="username" required><br><br>

        <button type="submit" name="registrar">Registrar</button>
    </form>

    <?php
    // Conexión a la base de datos
    include("conexion.php");

    // Procesar el registro cuando el formulario sea enviado
    if (isset($_POST['registrar'])) {
        $cedula = $_POST['cedula'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $username = $_POST['username'];

        // Hashear la contraseña para mayor seguridad
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        // Insertar los datos en la base de datos
        $sql = "INSERT INTO usuarios (cedula, email, password, username) VALUES ('$cedula', '$email', '$password_hashed', '$username')";
        if (mysqli_query($conexion, $sql)) {
            echo "Usuario registrado con éxito.<br><br>";
        } else {
            echo "Error: " . mysqli_error($conexion);
        }
    }

    // Mostrar la lista de usuarios
    $sql = "SELECT * FROM usuarios";
    $resultado = mysqli_query($conexion, $sql);
    ?>

    <h1>Lista de usuarios</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cédula</th>
                <th>Email</th>
                <th>Contraseña</th>
                <th>Nombre de Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            while ($filas = mysqli_fetch_assoc($resultado)) { 
            ?>
            <tr>
                <td><?php echo $filas['id']; ?></td>
                <td><?php echo $filas['cedula']; ?></td>
                <td><?php echo $filas['email']; ?></td>
                <td><?php echo $filas['password']; ?></td>
                <td><?php echo $filas['username']; ?></td>
                <td>
                    <a href="">EDITAR</a>
                    <a href="">ELIMINAR</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <?php
    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
    ?>
</body>
</html>
