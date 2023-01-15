<!-- Content Row -->

<div class="row">

    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Introduzca los datos del nuevo proveedor</h6>                                    
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <!--form action="/proveedores/add/" method="post"-->         
                <form method="get">
                    <div class="row">
                    <div class="mb-3 col-sm-6">
                        <label for="cif">CIF</label>
                        <input class="form-control" id="cif" type="text" name="cif" placeholder="CIF" required>
                    </div>
                     <div class="mb-3 col-sm-6">
                        <label for="codigo">Código</label>
                        <input class="form-control" id="codigo" type="text" name="codigo" placeholder="Código" required>
                    </div>
                     <div class="mb-3 col-sm-6">
                        <label for="nombre">Nombre</label>
                        <input class="form-control" id="nombre" type="text" name="nombre" placeholder="Nombre" required>
                    </div>
                     <div class="mb-3 col-sm-6">
                        <label for="direccion">Dirección</label>
                        <input class="form-control" id="direccion" type="text" name="direccion" placeholder="Dirección" required>
                    </div>
                     <div class="mb-3 col-sm-6">
                        <label for="pais">País</label>
                        <input class="form-control" id="pais" type="text" name="pais" placeholder="País" required>
                    </div>
                    
                    <div class="mb-3 col-sm-6">
                        <label for="email">Email</label>
                        <input class="form-control" id="email" type="email" name="email" placeholder="name@example.com" required>
                    </div>
                     <div class="mb-3 col-sm-6">
                        <label for="username">Teléfono</label>
                        <input class="form-control" id="telefono" type="tel" name="telefono" placeholder="Teléfono">
                    </div>
                     <div class="mb-3 col-sm-6">
                        <label for="website">Website</label>
                        <input class="form-control" id="website" type="url" name="website" placeholder="Website" required>
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