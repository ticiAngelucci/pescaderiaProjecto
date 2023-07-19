<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location:login.php");
    exit();
}
include('components/navbar.php');
include('functions/conection.php');

?>

<div class="container mt-4" style="background-color: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); padding: 20px 30px;">
    <h2>Seleccionar fechas para el reporte:</h2>
    <form action="functions/estadisticasEmpleados.php" method="post" class="form-inline">
        <div class="form-group mr-2">
            <label for="fecha_inicio" class="mr-2">Fecha de inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo $fecha_minima; ?>" max="<?php echo $fecha_maxima; ?>" required class="form-control">
        </div>
        <div class="form-group mr-2">
            <label for="fecha_fin" class="mr-2">Fecha de fin:</label>
            <input type="date" id="fecha_fin" name="fecha_fin" value="<?php echo $fecha_maxima; ?>" max="<?php echo $fecha_maxima; ?>" required class="form-control">
        </div>
        <input type="submit" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); padding: 8px 16px; max-width: 247px" value="Generar Reporte" class="btn btn-primary">
    </form>

    <div id="fechas_seleccionadas" class="mt-4"></div>
</div>
<script>
    // Obtener los elementos de fecha de inicio y fecha de fin
    const fechaInicioInput = document.getElementById('fecha_inicio');
    const fechaFinInput = document.getElementById('fecha_fin');

    // Obtener el elemento donde se mostrarán las fechas seleccionadas
    const fechasSeleccionadasDiv = document.getElementById('fechas_seleccionadas');

    // Función para actualizar las fechas seleccionadas en el div
    function mostrarFechasSeleccionadas() {
        const fechaInicioSeleccionada = fechaInicioInput.value;
        const fechaFinSeleccionada = fechaFinInput.value;

        fechasSeleccionadasDiv.innerHTML = `Fechas seleccionadas: desde ${fechaInicioSeleccionada} hasta ${fechaFinSeleccionada}`;
    }

    // Escuchar cambios en los inputs de fecha
    fechaInicioInput.addEventListener('change', mostrarFechasSeleccionadas);
    fechaFinInput.addEventListener('change', mostrarFechasSeleccionadas);

    // Mostrar las fechas seleccionadas por defecto al cargar la página
    mostrarFechasSeleccionadas();
</script>

<?php include('components/footer.php'); ?>
