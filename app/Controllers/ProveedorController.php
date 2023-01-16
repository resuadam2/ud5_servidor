<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

class ProveedorController extends \Com\Daw2\Core\BaseController {

    function mostrarTodos() {
        $data = [];
        $data['titulo'] = 'Todos los proveedores';
        $data['seccion'] = '/proveedores';

        $modelo = new \Com\Daw2\Models\ProveedorModel();
        $data['proveedores'] = $modelo->getAll();

        $this->view->showViews(array('templates/header.view.php', 'proveedores.view.php', 'templates/footer.view.php'), $data);
    }

    function mostrarAdd() {
        $data['titulo'] = 'Nuevo proveedor';
        $this->view->showViews(array('templates/header.view.php', 'add.proveedor.view.php', 'templates/footer.view.php'), $data);
    }

    function delete(string $cif) {
        $modelo = new \Com\Daw2\Models\ProveedorModel();
        $result = $modelo->delete($cif);
        if ($result == 1) {
            header('Location: /proveedores');
        } else if ($result == 0) {
            $this->cant_delete($cif);
        } else {
            header('location: methodNotAllowed');
        }
    }

    function cant_delete(string $cif) {
        $data = [];
        $data['titulo'] = 'No se ha podido borrar el proveedor con cif ' . $cif . ' debido a que tiene productos asociados.';
        $data['seccion'] = '/proveedores';
        $modelo = new \Com\Daw2\Models\ProveedorModel();
        $data['proveedores'] = $modelo->view($cif);

        $this->view->showViews(array('templates/header.view.php', 'detail.proveedor.view.php', 'templates/footer.view.php'), $data);
    }

    function view(string $cif) {
        $data['titulo'] = 'Proveedor ' . $cif;
        $modelo = new \Com\Daw2\Models\ProveedorModel();
        $data['proveedores'] = $modelo->view($cif);

        $this->view->showViews(array('templates/header.view.php', 'detail.proveedor.view.php', 'templates/footer.view.php'), $data);
    }

    function add() {
        $modelo = new \Com\Daw2\Models\ProveedorModel();
        $nuevo = ['cif' => $_POST('cif'),
            'codigo' => $_POST('codigo'),
            'nombre' => $_POST('nombre'),
            'direccion'=>$_POST('direccion'),
            'website'=>$_POST('website'),
            'pais'=>$_POST('pais'),
            'telefono'=>$_POST('telefono')
            ];
            #'cif' = $_POST('cif'),$_POST('codigo'),$_POST('nombre'),$_POST('direccion'),$_POST('website'),$_POST('pais'),$_POST('email'));
        /*
        if ($_POST('telefono') != null) {
            $nuevo->__set("telefono", $_POST('telefono'));
        }*/
        $result = $modelo->add($nuevo);
        
        if ($result == 1) {
            header('Location: /proveedores');
        } else if ($result == 0) {
            header('Location: /proveedores/cant_add)');
        } else {
            header('location: methodNotAllowed');
        }
    }

}
