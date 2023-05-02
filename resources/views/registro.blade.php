@include('header')
<body>
    <h1>Escollera</h1>
    <h3>Registrarse</h3>
    <form action="{{route('RegistroCliente.store')}}" method="post">
        @csrf
        <input class="" type="text" name="nombre" id="nombre" placeholder="Ingrese su nombre">
        {!! $errors->first('nombre','<small>:message</small>')!!}<br>
        <input class="" type="text" name="apellido" id="apellido" placeholder="Ingrese su apellido">
        {!! $errors->first('email','<small>:message</small>')!!}<br>
        <input class="" type="number" name="dni" id="dni" placeholder="Ingrese su dni">
        {!! $errors->first('dni','<small>:message</small>')!!}<br>
        <input class="" type="text" name="email" id="email" placeholder="Ingrese su email">
        {!! $errors->first('email','<small>:message</small>')!!}<br>
        <input class="" type="password" name="contraseña" id="password" placeholder="Ingrese su contraseña">
        {!! $errors->first('password','<small>:message</small>')!!}<br>
        <input class="" type="submit" value="Registrarse">
        <p><a href="#">¿Ya tiene cuenta?</a></p>
    </form>
</body>

</html>