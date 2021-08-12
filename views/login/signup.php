<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/all.css">
    <title>Registro de Usuario</title>
</head>
<body>
    <main role="main">
        <div class="container text-center mt-4">
            <div class="row mt">
                <div class="col-md-12">
                    <h1 style="font-size: 28px;" class="mb-4 mt-2">Formulario de Registro</h1>
                </div>
            </div>
            <div class="row mt-5 mb-5">
                <div class="col-md-12">
                    <form class="form-inline justify-content-center" id="miformulario" action="<?php echo constant('URL');?>signup/newUser" method="POST">
                        <label class="sr-only" for="username">Usuario</label>
                        <input type="text" class="form-control mb-2 mr-sm-2" id="username" name="username" placeholder="Usuario" required>
                        <label class="sr-only" for="password">Contraseña</label>
                        <div class="input-group mb-2 mr-sm-2">                  
                            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Aceptar</button>
                    </form> 
                </div>
          </div>
          <div class="row text-center">
            <div class="col-md-12">
              <p class="lead">¿Tienes una cuenta? <a href="<?php echo constant('URL');?>">Iniciar Sesi&oacute;n</a></p>
            </div>
          </div>
        </div>
    </main>
</body>
</html>