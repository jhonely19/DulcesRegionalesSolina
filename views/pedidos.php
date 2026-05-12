<?php
// SEGURO DE SESIÓN: Solo inicia si no existe una activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificación de seguridad
if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}

$usuario = $_SESSION['usuario'] ?? '';

$clientes = $formData['clientes'] ?? [];
$productos = $formData['productos'] ?? [];
$pedidosExistentes = $datos ?? [];

// El aviso solo sale si el controlador intentó cargar datos y falló
$mostrarAviso = (empty($clientes) || empty($productos));
$msj = $_GET['msj'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos | Doña Solina</title>
    <link rel="icon" href="../imagenes/logotipo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assetes/css/style_home.css">
    <link rel="stylesheet" href="../assetes/css/style_producto.css">
</head>
<body>

<?php include 'layouts/header.php'; ?>

<div class="layout">
    <?php include 'layouts/sidebar.php'; ?>

    <main class="content">
        <div class="container-fluid py-4">
            <h2 class="mb-4" style="color:#880e4f; font-weight:700;">Gestión de Pedidos</h2>

<?php if ($mostrarAviso): ?>
                <div class="alert alert-warning">No se pudieron cargar clientes/productos desde la base de datos.</div>
            <?php elseif ($msj === 'ok'): ?>
                <div class="alert alert-success">Pedido guardado correctamente.</div>
            <?php elseif ($msj === 'error'): ?>
                <div class="alert alert-danger">Error al guardar el pedido. Revisa los datos.</div>
            <?php endif; ?>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Nueva Solicitud</h5>
                </div>
                <div class="card-body">
                    <form action="../controller/PedidoController.php?a=guardar" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Cliente</label>
                                <select name="id_cliente" class="form-select" required>
                                    <option value="" selected disabled>Seleccione un cliente</option>
                                    <?php foreach ($clientes as $c): ?>
                                        <option value="<?= (int)$c['id_cliente'] ?>">
                                            <?= htmlspecialchars(($c['nombre'] ?? '') . ' ' . ($c['apellido'] ?? '')) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Producto</label>
                                <select name="id_producto" class="form-select" required>
                                    <option value="" selected disabled>Seleccione un producto</option>
                                    <?php foreach ($productos as $p): ?>
                                        <option value="<?= (int)$p['id_producto'] ?>">
                                            <?= htmlspecialchars(($p['nombre_producto'] ?? 'Producto') . ' - S/ ' . number_format((float)($p['precio'] ?? 0), 2)) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Cantidad</label>
                                <input type="number" name="cantidad" class="form-control" min="1" step="1" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Fecha</label>
                                <input type="date" name="fecha_pedido" class="form-control" value="<?= date('Y-m-d') ?>" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Estado</label>
                                <select name="estado_pedido" class="form-select" required>
                                    <option value="pendiente" selected>Pendiente</option>
                                    <option value="en_proceso">En proceso</option>
                                    <option value="entregado">Entregado</option>
                                </select>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>Guardar Pedido
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-list me-2"></i>Listado de Pedidos</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Producto</th>
                                    <th>Fecha</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($datos)): ?>
                                    <?php foreach ($datos as $dp): ?>
                                        <tr>
                                            <td><?= (int)($dp['id_pedido'] ?? 0) ?></td>
                                            <td><?= htmlspecialchars(($dp['cliente_nombre'] ?? '') . ' ' . ($dp['cliente_apellido'] ?? '')) ?></td>
                                            <td><?= htmlspecialchars($dp['producto_nombre'] ?? '') ?></td>
                                            <td><?= htmlspecialchars($dp['fecha_pedido'] ?? '') ?></td>
                                            <td><?= (int)($dp['cantidad'] ?? 0) ?></td>
<td>S/ <?= number_format((float)($dp['total'] ?? 0), 2) ?></td>
                                            <td><?= htmlspecialchars($dp['estado_pedido'] ?? '') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
<td colspan="7" class="text-center py-4 text-muted">No hay pedidos registrados.</td>
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

</body>
</html>

