<!-- Content Row -->

<div class="row">
 <?php
    $actual = $usuario_sistema[0];
    $controller = new \Com\Daw2\Controllers\UsuarioSistemaController();
    ?>
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Editando <?php echo $actual['nombre'] ?></h6>                                    
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form action="/usuario_sistema/edit/<?php echo $actual['id_usuario'] ?>" method="post">         
                    <!--form method="get"-->
                    <div class="row">
                        <div class="mb-3 col-sm-6">
                            <label for="nombre">Nombre de usuario</label>
                            <input class="form-control" id="nombre" type="text" name="nombre" placeholder="<?php echo $actual['nombre'] ?>" value="<?php echo isset($input['nombre']) ? $input['nombre'] : $actual['nombre']; ?>" required>
                            <p class="text-danger"><?php echo isset($errores['nombre']) ? $errores['nombre'] : ''; ?></p>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="pass">Contraseña</label>
                            <input class="form-control" id="pass" type="password" name="pass" placeholder="Sin modificar" value="<?php echo isset($input['pass']) ? $input['pass'] : $actual['pass']; ?>" required>
                            <p class="text-danger"><?php echo isset($errores['pass']) ? $errores['pass'] : ''; ?></p>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="email">Email</label>
                            <input class="form-control" id="email" type="email" name="email" placeholder="<?php echo $actual['email'] ?>" value="<?php echo isset($input['email']) ? $input['email'] : $actual['email']; ?>" required>
                            <p class="text-danger"><?php echo isset($errores['email']) ? $errores['email'] : ''; ?></p>
                        </div>
                        <div class="mb-3 col-sm-4">
                            <label for="id_rol">Rol del usuario</label>
                            <select class="form-control select2-container--default" name="id_rol">
                                  <?php
                                if ($actual['id_rol'] !== null) {
                                    ?>
                                <option value="<?php $actual['id_rol'] ?>" selected><?php echo $controller->getNombreRol($actual['id_rol']); ?> </option>                                                                
                                <?php
                                }
                                if (count($roles) > 0) {
                                    foreach ($roles as $r) {
                                        ?>
                                        <option value="<?php echo $r['id_rol'] ?>"><?php echo $r['id_rol'] . ': ' . $r['nombre_rol'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <p class="text-danger"><?php echo isset($errores['id_rol']) ? $errores['id_rol'] : ''; ?></p>
                        </div>
                        <div class="mb-3 col-sm-2">
                            <label for="idioma">Idioma</label>
                            <select class="form-control select2-container--default" name="idioma">
                                  <?php
                                if ($actual['idioma'] !== null) {
                                    ?>
                                    <option value="<?php $actual['idioma'] ?>" selected><?php echo $actual['idioma']; ?> </option>                                                                
                                <?php
                                } ?>
                                <option value="es" selected>Español</option>
                                <option value="gal">Galego</option>                                
                                <option value="en">Inglés</option>                                
                                
                            </select>
                            <p class="text-danger"><?php echo isset($errores['idioma']) ? $errores['idioma'] : ''; ?></p>
                        </div>
                        <div class="mb-3 col-sm-9"></div>
                        <div class="mb-3 m-1">
                            <input type="submit" value="Enviar" name="enviar" class="btn btn-primary"/>
                        </div>
                        <div class="mb-3 m-1">
                            <a href="/usuarios_sistema" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>                        
</div>