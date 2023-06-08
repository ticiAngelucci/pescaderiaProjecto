<?php 
 include('components/header.php'); 
 include('components/navbar.php'); ?>
<div class="container">
    <section class="py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-6 mb-4 mb-lg-0">
                <div class="card mb-3" style="border-radius: .5rem;">
                    <div class="row g-0">
                        <div class="col-md-4 gradient-custom text-center my-5">
                            <img src="assets/perfilUsuario.png" alt="Avatar" style="width: 150px;" />
                            <h5 class="p-3">NOMBRE DE USUARIO TRAER CON BD</h5>
                            <h5>Dni</h5>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h6>Informacion del Usuario</h6>
                                <hr class="mt-0 mb-4">
                                <form action="#">
                                    <div class="col-6 mb-3">
                                        <h6>Email</h6>
                                        <input type="email" placeholder="info@example.com" />
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Celular</h6>
                                        <input type="phone" placeholder="12312321" />
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Contraseña</h6>
                                        <input type="password" placeholder="contraseña q trae bd" />
                                    </div>
                                    <div class="col-6 mb-3">

                                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include('components/footer.php'); ?>