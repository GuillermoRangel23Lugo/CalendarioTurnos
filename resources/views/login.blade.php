
@include('header')
<div class="login" style="background: linear-gradient(to left, #4b88ed, #acb1e5); min-height: 100vh;">
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="box" style="margin-top: calc(50vh - 175px); padding: 30px; background: white; border-radius: 15px;">
                    <form action="/iniciar_sesion" method="POST">
                        <h4 class="text-center mb-4">Iniciar Sesión</h4>
                        <div class="form-group mb-4">
                            <input type="email" class="form-control" required name="correo" id="correo" placeholder="Correo Electronico">
                        </div>
                        <div class="form-group mb-4">
                            <input type="password" class="form-control" required name="clave" id="clave" placeholder="Contraseña">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Entrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('footer')