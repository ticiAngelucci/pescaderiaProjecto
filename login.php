<?php include('components/header.php'); ?>
<div class="container w-75 bg-primary mt-5 shadow">
    <div class="row align-items-stretch">
        <div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6">

        </div>
        <div class="col bg-white">
            <div class="text-center">
                <img class="py-2"
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRRMjiwG9VWb530KHv-6_GX7qNRb7iJDPy3YNSLetgTAOHPySiBKMMZCZS4f_y5JDElA1Y&usqp=CAU"
                    width="190" alt="Logo Escollera">
            </div>
            <?php
                    include("functions/login.php");
                ?>
            <form action="#" method="POST" class="m-2">
                @csrf

                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="row justify-content-between py-5">
                    <div type="button" class="btn col-sm-4"><a href="#">¿No tienes cuenta?</a></div>
                    <input name="btningresar" type="submit" class="btn btn-primary col-sm-6" value="Ingresar">

                </div>
            </form>
        </div>
    </div>
</div>
<?php include('components/footer.php'); ?>