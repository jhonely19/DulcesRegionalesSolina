<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['usuario'])) { header('Location: ../login.php'); exit(); }

$msj = $_GET['msj'] ?? '';
$usuarios = $datos ?? []; // Viene del controlador
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios | Doña Solina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assetes/css/style_home.css">
    <link rel="stylesheet" href="../assetes/css/style_producto.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<?php include 'layouts/header.php'; ?>

<div class="layout">
    <?php include 'layouts/sidebar.php'; ?>

    <main class="content">
        <div class="container-fluid py-4">
            <h2 class="mb-4" style="color:#880e4f; font-weight:700;">Gestión de Usuarios</h2>

            <?php if($msj === 'ok'): ?>
                <div class="alert alert-success">Usuario registrado con éxito.</div>
            <?php elseif($msj === 'delete'): ?>
                <div class="alert alert-info">Usuario eliminado.</div>
            <?php endif; ?>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Registrar Nuevo Usuario</h5>
                </div>
                <div class="card-body">
                    <form action="../controller/UsuarioController.php?a=guardar" method="POST">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Nombre Completo</label>
                                <input type="text" name="nombre_usuario" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Correo Electrónico</label>
                                <input type="email" name="correo" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Contraseña</label>
                                <input type="password" name="contrasena" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Rol</label>
                                <select name="rol" class="form-select">
                                    <option value="admin">Administrador</option>
                                    <option value="vendedor">Vendedor</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Estado</label>
                                <select name="estado" class="form-select">
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Rol</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $u): ?>
                            <tr>
                                <td><?= $u['id_usuario'] ?></td>
                                <td><?= htmlspecialchars($u['nombre_usuario']) ?></td>
                                <td><?= htmlspecialchars($u['correo']) ?></td>
                                <td><span class="badge bg-secondary"><?= $u['rol'] ?></span></td>
                                <td>
                                    <span class="badge <?= $u['estado'] === 'activo' ? 'bg-success' : 'bg-danger' ?>">
                                        <?= $u['estado'] ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="../controller/UsuarioController.php?a=eliminar&id=<?= $u['id_usuario'] ?>" 
                                       class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>