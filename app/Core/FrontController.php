<?php

namespace Com\Daw2\Core;

use Steampixel\Route;

class FrontController {

    static function main() {
        Route::add('/',
                function () {
                    $controlador = new \Com\Daw2\Controllers\InicioController();
                    $controlador->index();
                }
                , 'get');

        Route::add('/csv/historico',
                function () {
                    $controlador = new \Com\Daw2\Controllers\CSVController();
                    $controlador->poblacionPontevedra();
                }
                , 'get');

        Route::add('/csv/grupos-edad',
                function () {
                    $controlador = new \Com\Daw2\Controllers\CSVController();
                    $controlador->poblacionGruposEdad();
                }
                , 'get');

        Route::add('/csv/totales-2020',
                function () {
                    $controlador = new \Com\Daw2\Controllers\CSVController();
                    $controlador->poblacion2020Totales();
                }
                , 'get');

        Route::add('/csv/new-2020',
                function () {
                    $controlador = new \Com\Daw2\Controllers\CSVController();
                    $controlador->new2020Form();
                }
                , 'get');

        Route::add('/csv/new-2020',
                function () {
                    $controlador = new \Com\Daw2\Controllers\CSVController();
                    $controlador->new2020FormProcess();
                }
                , 'post');

        Route::add('/usuario/test',
                function () {
                    $controlador = new \Com\Daw2\Controllers\UsuarioController();
                    $controlador->test();
                }
                , 'get');

        Route::add('/usuarios',
                function () {
                    $controlador = new \Com\Daw2\Controllers\UsuarioController();
                    $controlador->mostrarTodos();
                }
                , 'get');

        Route::add('/usuarios/delete/([A-Za-z_]+)',
                function ($username) {
                    $controlador = new \Com\Daw2\Controllers\UsuarioController();
                    $controlador->delete($username);
                }
                , 'get');

        Route::add('/usuarios/ordered',
                function () {
                    $controlador = new \Com\Daw2\Controllers\UsuarioController();
                    $controlador->mostrarTodosOrdenados();
                }
                , 'get');

        Route::add('/usuarios/estandard',
                function () {
                    $controlador = new \Com\Daw2\Controllers\UsuarioController();
                    $controlador->mostrarUsuariosStandard();
                }
                , 'get');

        Route::add('/usuarios/carlos',
                function () {
                    $controlador = new \Com\Daw2\Controllers\UsuarioController();
                    $controlador->mostrarUsuariosCarlos();
                }
                , 'get');

        Route::add('/proveedores',
                function () {
                    $controlador = new \Com\Daw2\Controllers\ProveedorController();
                    $controlador->mostrarTodos();
                }
                , 'get');
                
        Route::add('/proveedores/view/([A-Za-z0-9]+)',
                function ($cif) {
                    $controlador = new \Com\Daw2\Controllers\ProveedorController();
                    $controlador->view($cif);
                }
                , 'get');

        Route::add('/proveedores/delete/([A-Za-z0-9]+)',
                function ($cif) {
                    $controlador = new \Com\Daw2\Controllers\ProveedorController();
                    $controlador->delete($cif);
                }
                , 'get');

        Route::add('/proveedores/edit/([A-Za-z0-9]+)',
                function ($cif) {
                    $controlador = new \Com\Daw2\Controllers\ProveedorController();
                    $controlador->mostrarEdit($cif);
                }
                , 'get');        
                
        Route::add('/proveedores/edit/([A-Za-z0-9]+)',
                function ($cif) {
                    $controlador = new \Com\Daw2\Controllers\ProveedorController();
                    $controlador->edit($cif);
                }
                , 'post');          

        Route::add('/proveedores/add',
                function () {
                    $controlador = new \Com\Daw2\Controllers\ProveedorController();
                    $controlador->mostrarAdd();
                }
                , 'get');

        Route::add('/proveedores/add',
                function () {
                    $controlador = new \Com\Daw2\Controllers\ProveedorController();
                    $controlador->add();
                }
                , 'post');
                
        Route::add('/proveedores/cant_add',
                function () {
                    $controlador = new \Com\Daw2\Controllers\ProveedorController();
                    $controlador->error405();
                }
                , 'get');

        Route::pathNotFound(
                function () {
                    $controller = new \Com\Daw2\Controllers\ErroresController();
                    $controller->error404();
                }
        );

        Route::methodNotAllowed(
                function () {
                    $controller = new \Com\Daw2\Controllers\ErroresController();
                    $controller->error405();
                }
        );

        Route::run();
    }

}
