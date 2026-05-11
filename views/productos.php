<?php
// Evitamos el error de sesión activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Seguridad: Si no hay sesión, mandamos al login (que está una carpeta afuera)
if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}
$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos | Inventario</title>
    <link rel="icon" href="../imagenes/logotipo.png">
    
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="../assetes/css/style_home.css">
    <link rel="stylesheet" href="../assetes/css/style.producto.css">
</head>

<body>

    <?php include 'layouts/header.php'; ?>

    <div class="layout">

        <?php include 'layouts/sidebar.php'; ?>

        <main class="content">
            <div class="container-fluid py-4">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="titulo-pagina" style="color: #880e4f; font-weight: 700;">Gestión de Inventario</h2>
                    <span class="badge bg-white text-dark shadow-sm p-2" style="border-radius: 10px;">
                        <i class="fas fa-calendar-alt text-pink"></i> <?php echo date('d/m/Y'); ?>
                    </span>
                </div>

                <div class="card card-solina mb-4">
                    <div class="header-solina">
                        <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Registrar Nuevo Dulce</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="../controller/ProductoController.php?a=guardar" method="POST">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Nombre del Producto</label>
                                    <input type="text" name="nombre_producto" class="form-control" placeholder="Ej: Dulce de Coco" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Categoría</label>
                                    <input type="text" name="categoria" class="form-control" placeholder="Categoría" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Región de Origen</label>
                                    <input type="text" name="region_origen" class="form-control" placeholder="Región" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Precio (S/)</label>
                                    <input type="number" step="0.01" name="precio" class="form-control" placeholder="0.00" required>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Stock</label>
                                    <input type="number" name="stock" class="form-control" placeholder="0" required>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">Descripción</label>
                                    <input type="text" name="descripcion" class="form-control" placeholder="Detalles extra...">
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-pink px-4">
                                    <i class="fas fa-save me-2"></i>Guardar Producto
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card card-solina">
                    <div class="header-solina bg-dark">
                        <h4 class="mb-0"><i class="fas fa-list me-2"></i>Listado de Dulces Regionales</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-pink">
                                    <tr>
                                        <th class="ps-4">Producto</th>
                                        <th>Categoría</th>
                                        <th>Origen</th>
                                        <th>Precio</th>
                                        <th>Stock</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($datos)): ?>
                                        <?php foreach($datos as $p): ?>
                                        <tr>
                                            <td class="ps-4 fw-bold text-dark"><?= htmlspecialchars($p['nombre_producto']) ?></td>
                                            <td><span class="badge badge-categoria" style="background:#e1f5fe; color:#0288d1;"><?= htmlspecialchars($p['categoria']) ?></span></td>
                                            <td><i class="fas fa-map-pin text-danger"></i> <?= htmlspecialchars($p['region_origen']) ?></td>
                                            <td class="fw-bold text-success">S/ <?= number_format($p['precio'], 2) ?></td>
                                            <td>
                                                <?php if($p['stock'] <= 5): ?>
                                                    <span class="badge bg-light-danger text-danger border border-danger"><i class="fas fa-exclamation-triangle"></i> <?= $p['stock'] ?></span>
                                                <?php else: ?>
                                                    <span class="badge bg-light-success text-success border border-success"><?= $p['stock'] ?> disp.</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group shadow-sm">
                                                    <button class="btn btn-outline-warning btn-sm"><i class="fas fa-pen"></i></button>
                                                    <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="6" class="text-center py-5 text-muted">No hay dulces registrados aún.</td></tr>
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