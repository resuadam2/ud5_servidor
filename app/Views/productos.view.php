<div class="row">       
    <?php
    if(isset($error)){
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
                <h6 class="m-0 installfont-weight-bold text-primary">Productos</h6>    
                <div class="m-0 font-weight-bold justify-content-end">
                    <a href="/proveedores/add/" class="btn btn-primary ml-1"> Nuevo Producto <i class="fas fa-plus-circle"></i></a>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body" id="card_table">
                <div id="button_container" class="mb-3"></div>
                <?php 
                if(count($productos) > 0){                                    
                ?>
                <!--<form action="./?sec=formulario" method="post">                   -->
                <table id="tabladatos" class="table table-striped">                    
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>                          
                            <th>Categoría</th>                            
                            <th>Proveedor</th>
                            <th>PVP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($productos as $p){
                        ?>
                        <tr class="<?php #echo $p['pais'] != 'España' ? 'table-warning' :  ''; ?>">
                            <td><?php echo $p['codigo']; ?></td>
                            <td><?php echo $p['nombre']; ?></td>
                            <td><?php echo $p['categoria']; ?></td>                            
                            <td><?php echo $p['proveedor']; ?></td>   
                            <td><<?php echo $p['pvp']; ?></td>                         
                                                    
                            <td>
                                <a href="/productos/view/<?php echo $p['codigo']; ?>" class="btn btn-default ml-1"><i class="fas fa-eye"></i></a>
                                <a href="/productos/edit/<?php echo $p['codigo']; ?>" class="btn btn-success ml-1"><i class="fas fa-edit"></i></a>
                                <a href="/productos/delete/<?php echo $p['codigo']; ?>" class="btn btn-danger ml-1"><i class="fas fa-trash"></i></a>
                            </td>

                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        Total de registros: <?php echo count($productos); ?>
                    </tfoot>
                </table>
                <?php
                
                
                            }
                else{
                ?>
                <p class="text-danger">No existen registros que cumplan los requisitos.</p>
                <?php
                }
                ?>
            </div>
        </div>
    </div>                        
</div>
