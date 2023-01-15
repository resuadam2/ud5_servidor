<!-- Content Row -->
<!-- Still to-do -->
<div class="row">
    <?php 
        $proveedor = $proveedores[0];
    ?>
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Datos completos del proveedor</h6>                                    
            </div>
            <!-- Card Body -->
            <div class="card-body">                   
                <!-- <form method="get"> -->
                    <div class="row">
                    <div class="mb-3 col-sm-6">
                        <label for="cif">CIF</label>
                        <input class="form-control" id="cif" type="text" name="cif" placeholder="<?php echo $proveedor['cif'] ?>" required>
                    </div>
                     <div class="mb-3 col-sm-6">
                        <label for="codigo">Código</label>
                        <input class="form-control" id="codigo" type="text" name="codigo" placeholder="<?php echo $proveedor['codigo'] ?>" required>
                    </div>
                     <div class="mb-3 col-sm-6">
                        <label for="nombre">Nombre</label>
                        <input class="form-control" id="nombre" type="text" name="nombre" placeholder="<?php echo $proveedor['nombre'] ?>" required>
                    </div>
                     <div class="mb-3 col-sm-6">
                        <label for="direccion">Dirección</label>
                        <input class="form-control" id="direccion" type="text" name="direccion" placeholder="<?php echo $proveedor['direccion'] ?>" required>
                    </div>
                     <div class="mb-3 col-sm-6">
                        <label for="pais">País</label>
                        <input class="form-control" id="pais" type="text" name="pais" placeholder="<?php echo $proveedor['pais'] ?>" required>
                    </div>
                    
                    <div class="mb-3 col-sm-6">
                        <label for="email">Email</label>
                        <input class="form-control" id="email" type="email" name="email" placeholder="<?php echo $proveedor['email'] ?>" required>
                    </div>
                     <div class="mb-3 col-sm-6">
                        <label for="username">Teléfono</label>
                        <input class="form-control" id="telefono" type="tel" name="telefono" placeholder="<?php echo $proveedor['telefono'] ?>">
                    </div>
                     <div class="mb-3 col-sm-6">
                        <label for="website">Website</label>
                        <input class="form-control" id="website" type="url" name="website" placeholder="<?php echo $proveedor['website'] ?>" required>
                    </div>
                    <div class="mb-3 col-sm-10"></div>
                    <div class="mb-3 m-1">
                        <input type="submit" value="Enviar" class="btn btn-primary"/>
                    </div>
                    <div class="mb-3 m-1">
                        <a href="/proveedores" class="btn btn-danger">Cancelar</a>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>                        
</div>