<head>
    <meta charset="utf-8">
    <title>Editar perfil</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center mb-4">Edita tu perfil</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>">
                </div>
                <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos"
                        value="<?php echo $apellidos; ?>">
                </div>
                <div class="form-group">
                    <label for="correo">Correo electrónico:</label>
                    <input type="email" class="form-control" readonly id="correo" name="correo"
                        value="<?php echo $correo; ?>">
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" class="form-control" id="telefono"
                        value="<?php echo isset($_POST['telefono']) ? $_POST['telefono'] : (isset($valores['telefono']) ? $valores['telefono'] : 'Introduzca TLF'); ?>"
                        name="telefono">
                </div>
                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                    <input type="text" class="form-control" readonly id="fecha_nacimiento" name="fecha_nacimiento"
                        value="<?php echo $fecha_nacimiento; ?>">
                </div>
                <div class="form-group">
                    <label for="fecha_registro">Fecha de registro:</label>
                    <input type="text" class="form-control" readonly id="fecha_registro" name="fecha_registro"
                        value="<?php echo $fecha_registro; ?>">
                </div>
                <div class="form-group">
                    <label for="rol">Rol:</label>
                    <input type="text" class="form-control" readonly id="rol" name="rol" value="<?php echo $rol; ?>">
                </div>
                <div class="form-group text-center">
                    <input type="submit" class="btn btn-primary" value="Guardar cambios">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi4jq7f"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js