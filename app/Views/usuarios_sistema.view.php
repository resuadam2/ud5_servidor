<div class="row">       
    <?php
    if (isset($error)) {
        ?>
        <div class="col-12">
            <div class="alert alert-danger"><p><?php echo $error; ?></p></div>
        </div>
        <?php
    }
    ?>
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 installfont-weight-bold text-primary">Usuarios del sistema</h6>    
                <div class="m-0 font-weight-bold justify-content-end">
                    <a href="/usuario_sistema/add/" class="btn btn-primary ml-1"> Nuevo Usuario del Sistema <i class="fas fa-plus-circle"></i></a>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body" id="card_table">
                <div id="button_container" class="mb-3"></div>
                <?php
                if (count($usuarios_sistema) > 0) {
                    $controller = new \Com\Daw2\Controllers\UsuarioSistemaController();
                    ?>
                    <!--<form action="./?sec=formulario" method="post">                   -->
                    <table id="tabladatos" class="table table-striped">                    
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>                          
                                <th>Email</th>                            
                                <th>Rol</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($usuarios_sistema as $u) {
                                ?>
                            <tr class="<?php echo $u['baja'] != '0' ? 'table-warning': ''; ?>">
                                    <td><?php echo $u['id_usuario']; ?></td>
                                    <td><?php echo $u['nombre']; ?></td>
                                    <td><?php echo $u['email']; ?></td>    

                                    <td><?php
                                        if ($u['id_rol'] !== null) {

                                            echo $controller->getNombreRol($u['id_rol']);
                                        }
                                        ?></td>   


                                    <td>
                                        <a href="/usuario_sistema/view/<?php echo $u['id_usuario']; ?>" class="btn btn-default btn-sm"><i class="fas fa-eye"></i></a>
                                        <a href="/usuario_sistema/edit/<?php echo $u['id_usuario']; ?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                        <a href="/usuario_sistema/baja/<?php echo $u['id_usuario']; ?>" class="btn <?php echo $u['baja'] != '0' ? 'btn-secondary': 'btn-secondary'; ?> btn-sm">
                                            <i class="<?php echo $u['baja'] != '0' ? 'fas fa-toggle-off': 'fas fa-toggle-on'; ?>"></i></a>
                                        <a href="/usuario_sistema/delete/<?php echo $u['id_usuario']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                    </td>

                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            Total de registros: <?php echo count($usuarios_sistema); ?>
                        </tfoot>
                    </table>
                    <?php
                } else {
                    ?>
                    <p class="text-danger">No existen registros que cumplan los requisitos.</p>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>                        
</div>
