<?php
// Vista "pasiva" para listar/crear/editar clientes.
// El controlador es quien define $datos y $cliente (cuando aplica).

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}

$modoEditar = isset($_GET['a']) && $_GET['a'] === 'editar';
$clienteEditar = ($modoEditar && isset($cliente) && is_array($cliente)) ? $cliente : null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes | Doña Solina</title>
    <link rel="icon" href="../imagenes/logotipo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assetes/css/style_home.css">
</head>

<body>
    <?php include 'layouts/header.php'; ?>

    <div class="layout">
        <?php include 'layouts/sidebar.php'; ?>

        <main class="content">
            <div class="container-fluid py-4">
                <h2 class="mb-4" style="color: #880e4f; font-weight: 700;">Registro de Clientes</h2>

                <?php if ($modoEditar && !empty($clienteEditar)): ?>
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0"><i class="fas fa-pen me-2"></i>Editar Cliente</h5>
                        </div>

                        <div class="card-body">
                            <form action="../controller/ClienteController.php?a=actualizar" method="POST">
                                <input type="hidden" name="id_cliente" value="<?= (int)($clienteEditar['id_cliente'] ?? 0) ?>">

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Nombres</label>
                                        <input type="text" name="nombre" class="form-control" required
                                               value="<?= htmlspecialchars($clienteEditar['nombre'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Apellidos</label>
                                        <input type="text" name="apellido" class="form-control" required
                                               value="<?= htmlspecialchars($clienteEditar['apellido'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">DNI</label>
                                        <input type="text" name="dni" class="form-control" maxlength="8" required
                                               value="<?= htmlspecialchars($clienteEditar['dni'] ?? '') ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Teléfono</label>
                                        <input type="text" name="telefono" class="form-control"
                                               value="<?= htmlspecialchars($clienteEditar['telefono'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-5 mb-3">
                                        <label class="form-label">Dirección</label>
                                        <input type="text" name="direccion" class="form-control"
                                               value="<?= htmlspecialchars($clienteEditar['direccion'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Correo</label>
                                        <input type="email" name="correo" class="form-control"
                                               value="<?= htmlspecialchars($clienteEditar['correo'] ?? '') ?>">
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end gap-2">
                                    <a class="btn btn-outline-secondary" href="../controller/ClienteController.php?a=listar">Cancelar</a>
                                    <button type="submit" class="btn btn-primary px-4">Guardar Cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>

                <?php else: ?>
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i>Nuevo Cliente</h5>
                        </div>

                        <div class="card-body">
                            <form action="../controller/ClienteController.php?a=guardar" method="POST">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Nombres</label>
                                        <input type="text" name="nombre" class="form-control" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Apellidos</label>
                                        <input type="text" name="apellido" class="form-control" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">DNI</label>
                                        <input type="text" name="dni" class="form-control" maxlength="8" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Teléfono</label>
                                        <input type="text" name="telefono" class="form-control">
                                    </div>
                                    <div class="col-md-5 mb-3">
                                        <label class="form-label">Dirección</label>
                                        <input type="text" name="direccion" class="form-control">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Correo</label>
                                        <input type="email" name="correo" class="form-control">
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary px-4">Guardar Cliente</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 110px;">DNI</th>
                                        <th>Cliente</th>
                                        <th style="width: 160px;">Teléfono</th>
                                        <th>Correo</th>
                                        <th>Dirección</th>
                                        <th style="width: 160px;">Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php if (!empty($datos)): ?>
                                        <?php foreach ($datos as $c): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($c['dni'] ?? '') ?></td>
                                                <td><?= htmlspecialchars(($c['nombre'] ?? '') . ' ' . ($c['apellido'] ?? '')) ?></td>
                                                <td><?= htmlspecialchars($c['telefono'] ?? '') ?></td>
                                                <td><?= htmlspecialchars($c['correo'] ?? '') ?></td>
                                                <td><?= htmlspecialchars($c['direccion'] ?? '') ?></td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a class="btn btn-outline-warning btn-sm" 
                                                           href="../controller/ClienteController.php?a=editar&id=<?= (int)($c['id_cliente'] ?? 0) ?>"
                                                           title="Editar">
                                                            <i class="fas fa-pen"></i>
                                                        </a>

                                                        <a class="btn btn-outline-danger btn-sm"
                                                           href="../controller/ClienteController.php?a=eliminar&id=<?= (int)($c['id_cliente'] ?? 0) ?>"
                                                           title="Eliminar"
                                                           onclick="return confirm('¿Eliminar este cliente?');">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center py-4 text-muted">No hay clientes registrados todavía.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

