<?php include('components/header.php'); ?>
<?php include('components/navbar.php'); ?>
<div>
    <h3>Registrarse</h3>
    <form action="{{url('store-form')}}" method="post">
        @csrf
        <input class="" type="text" name="nombre" id="nombre" placeholder="Ingrese su nombre">
        {!! $errors->first('nombre','<small>:message</small>')!!}<br>
        <input class="" type="text" name="apellido" id="apellido" placeholder="Ingrese su apellido">
        {!! $errors->first('email','<small>:message</small>')!!}<br>
        <input class="" type="number" name="dni" id="dni" placeholder="Ingrese su dni">
        {!! $errors->first('dni','<small>:message</small>')!!}<br>
        <input class="" type="text" name="email" id="email" placeholder="Ingrese su email">
        {!! $errors->first('email','<small>:message</small>')!!}<br>
        <input class="" type="text" name="id_localidad" id="id_localidad" placeholder="Ingrese su localidad">
        {!! $errors->first('id_localidad','<small>:message</small>')!!}<br>
        <input class="" type="password" name="password" id="password" placeholder="Ingrese su contraseña">
        {!! $errors->first('password','<small>:message</small>')!!}<br>
        <input class="" type="submit" value="Registrarse">
        <p><a href="#">¿Ya tiene cuenta?</a></p>
    </form>
</div>
<?php include('components/footer.php'); ?>