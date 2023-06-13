<?php 
 include('components/header.php');
 include('components/navbar.php'); 
 include('functions/conection.php');
 include('functions/config.php');
 $consulta="SELECT * FROM clientes";            
 $resultados=mysqli_query($conexion,$consulta); 
 $consultaEmpleado="SELECT * FROM empleados";            
 $resultadosEmpleado=mysqli_query($conexion,$consultaEmpleado);
 $arrayClientes = $resultados->fetch_all(MYSQLI_ASSOC);
 $arrayEmpleados = $resultadosEmpleado->fetch_all(MYSQLI_ASSOC);
 $result_array = array_merge($arrayClientes, $arrayEmpleados);
 $activo=0;
 $filter=0;
if(isset($_POST['btnbuscar'])){
    $activo=1;
    $busqueda = $_POST['busqueda'];
    $consulta="SELECT * FROM empleados WHERE nombre LIKE '%$busqueda%' ";            
    $queryBusqueda=mysqli_query($conexion,$consulta); 
    if(mysqli_num_rows($queryBusqueda) == 0){
        $consultaCliente="SELECT * FROM clientes WHERE nombre LIKE '%$busqueda%' ";            
        $queryBusqueda=mysqli_query($conexion,$consultaCliente); 
    }else{
        while($empleadoBusqueda = $queryBusqueda->fetch_assoc()){
            echo $empleadoBusqueda['nombre'];
        }
    }    
};
if(isset($_POST['btnfiltrar'])){
    $ordenamiento = $_POST['ordenamiento'];
    $activo=1;
    $filter=1;
    if ($ordenamiento == 'filtrar_empl') {
        $resultadosFiltrar = mysqli_query($conexion, "SELECT * FROM empleados ORDER BY nombre ASC");
    } elseif ($ordenamiento == 'filtrar_cli') {
        $resultadosFiltrar = mysqli_query($conexion, "SELECT * FROM clientes ORDER BY nombre ASC");
    } 
    elseif ($ordenamiento == 'todo') {
        $activo=0;
        $filter=0;
    } 
} 
?>
<div class="row justify-content-center text-center">
    <div class="col-md-8 col-lg-6">
        <div class="header" style="color:white;margin-top:30px;">
            <h2>Listado de Usuarios</h2>
            <form method="POST"><input type="text" name="busqueda"><input type="submit" value="buscar"
                    name="btnbuscar" />
            </form>
            <form method="post" style="margin-bottom:40px;">
                <div class="form-group">
                    <label for="ordenamiento">Ordenar por:</label>
                    <select class="form-control" id="ordenamiento" name="ordenamiento">
                        <option value="filtrar_empl">Filtrar solo empleados</option>
                        <option value="filtrar_cli">Filtrar solo clientes</option>
                        <option value="todo">Todo</option>
                    </select>
                </div>
                <button type="submit" name="btnfiltrar" class="btn btn-primary">Ordenar</button>
            </form>
        </div>
    </div>
</div>
<div class="table-responsive" style="margin-top:40px;">
    <table class="table table-striped table-hover" style="background: white;margin: auto;max-width: 732px;">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Localidad</th>
                <th>Correo electrónico</th>
                <th>Rol</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php 
        if($activo==0){
        ?>
            <?php
                foreach($result_array as $usuario) { 
            ?>
            <tr>
                <td><?php echo $usuario['nombre'];?></td>
                <td><?php echo $usuario['apellido'];?></td>
                <td><?php echo $usuario['dni'];?></td>
                <td><?php if (array_key_exists('id_localidad', $usuario)){echo $usuario['id_localidad'];}else{echo "NULL";}?>
                </td>
                <td><?php echo $usuario['email'];?></td>
                <td><?php if (array_key_exists('id_localidad', $usuario)){echo "Cliente";}else{echo "Empleado";}?></td>
                <td><a href="editarUsuario.php?tipo_usuario=<?php if (array_key_exists('id_localidad', $usuario)){echo "clientes";}else{echo "empleados";}?>&id_usuario=<?php echo $usuario['id'];?>&token=<?php echo hash_hmac('sha1',$usuario['id'],KEY_TOKEN); ?>"><button class="btn btn-success"><i class="fas fa-pencil-alt"></i> Editar</button></a></td>
            </tr>
            <?php
        }}else{
            if($filter==0 && $activo==1){
            foreach($queryBusqueda as $busquedaUsuario) { 
        ?>
            <tr>
                <td><?php echo $busquedaUsuario['nombre'];?></td>
                <td><?php echo $busquedaUsuario['apellido'];?></td>
                <td><?php echo $busquedaUsuario['dni'];?></td>
                <td><?php if (array_key_exists('id_localidad', $busquedaUsuario)){echo $busquedaUsuario['id_localidad'];}else{echo "NULL";}?></td>
                <td><?php echo $busquedaUsuario['email'];?></td>
                <td><?php if (array_key_exists('id_localidad', $busquedaUsuario)){echo "Cliente";}else{echo "Empleado";}?></td>
                <td><a href="editarUsuario.php?tipo_usuario=<?php if (array_key_exists('id_localidad', $busquedaUsuario)){echo "clientes";}else{echo "empleados";}?>&id_usuario=<?php echo $busquedaUsuario['id'];?>&token=<?php echo hash_hmac('sha1',$busquedaUsuario['id'],KEY_TOKEN); ?>"><button class="btn btn-success"><i class="fas fa-pencil-alt"></i> Editar</button></a></td>
            </tr>
            <?php
            }  
        }else{
            foreach($resultadosFiltrar as $resultadoFiltrar) { 
    ?>
            <tr>
                <td><?php echo $resultadoFiltrar['nombre'];?></td>
                <td><?php echo $resultadoFiltrar['apellido'];?></td>
                <td><?php echo $resultadoFiltrar['dni'];?></td>
                <td>NULL</td>
                <td><?php echo $resultadoFiltrar['email'];?></td>
                <td><?php if($ordenamiento =='filtrar_empl'){echo "Empleado";}else{echo "Cliente";}?></td>
                <td><a href="editarUsuario.php?tipo_usuario=<?php if (array_key_exists('id_localidad', $resultadoFiltrar)){echo "clientes";}else{echo "empleados";}?>&id_usuario=<?php echo $resultadoFiltrar['id'];?>&token=<?php echo hash_hmac('sha1',$resultadoFiltrar['id'],KEY_TOKEN); ?>"><button class="btn btn-success"><i class="fas fa-pencil-alt"></i> Editar</button></a></td>
            </tr>
            <?php
            }
        }
    }
    ?>
        </tbody>
    </table>
</div>