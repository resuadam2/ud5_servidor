<?php

namespace Com\Daw2\Core;

use Steampixel\Route;

class FrontController {

    static function main() {
        session_start();
        Route::add('/',
                function () {
                    $controlador = new \Com\Daw2\Controllers\InicioController();
                    $controlador->index();
                }
                , 'get');
                
        #Gestión de usuarios del sistema:
                
                Route::add('/usuarios_sistema',
                function () {
                    $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                    $controlador->mostrarTodos();
                }
                , 'get');

        Route::add('/usuario_sistema/view/([A-Za-z0-9]+)',
                function ($id) {
                    $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                    $controlador->view($id);
                }
                , 'get');

        Route::add('/usuario_sistema/delete/([A-Za-z0-9]+)',
                function ($id) {
                    $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                    $controlador->delete($id);
                }
                , 'get');
                
        Route::add('/usuario_sistema/baja/([A-Za-z0-9]+)',
                function ($id) {
                    $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                    $controlador->baja($id);
                }
                , 'get');                

        Route::add('/usuario_sistema/edit/([A-Za-z0-9]+)',
                function ($id) {
                    $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                    $controlador->mostrarEdit($id);
                }
                , 'get');

        Route::add('/usuario_sistema/edit/([A-Za-z0-9]+)',
                function ($id) {
                    $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                    $controlador->edit($id);
                }
                , 'post');

        Route::add('/usuario_sistema/add',
                function () {
                    $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                    $controlador->mostrarAdd();
                }
                , 'get');

        Route::add('/usuario_sistema/add',
                function () {
                    $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                    $controlador->add();
                }
                , 'post');

        Route::add('/usuario_sistema/cant_add',
                function () {
                    $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                    $controlador->cant_add();
                }
                , 'get');
                
        #Ejemplos con CSVs
                /*
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

                */
                /*
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
                 * 
                 */

        # Gestion de categorías

        Route::add('/categorias',
                function () {
                    $controlador = new \Com\Daw2\Controllers\CategoriaController();
                    $controlador->mostrarTodos();
                }
                , 'get');

        Route::add('/categorias/view/([A-Za-z0-9]+)',
                function ($id) {
                    $controlador = new \Com\Daw2\Controllers\CategoriaController();
                    $controlador->view($id);
                }
                , 'get');

        Route::add('/categorias/delete/([A-Za-z0-9]+)',
                function ($id) {
                    $controlador = new \Com\Daw2\Controllers\CategoriaController();
                    $controlador->delete($id);
                }
                , 'get');

        Route::add('/categorias/edit/([A-Za-z0-9]+)',
                function ($id) {
                    $controlador = new \Com\Daw2\Controllers\CategoriaController();
                    $controlador->mostrarEdit($id);
                }
                , 'get');

        Route::add('/categorias/edit/([A-Za-z0-9]+)',
                function ($id) {
                    $controlador = new \Com\Daw2\Controllers\CategoriaController();
                    $controlador->edit($id);
                }
                , 'post');

        Route::add('/categorias/add',
                function () {
                    $controlador = new \Com\Daw2\Controllers\CategoriaController();
                    $controlador->mostrarAdd();
                }
                , 'get');

        Route::add('/categorias/add',
                function () {
                    $controlador = new \Com\Daw2\Controllers\CategoriaController();
                    $controlador->add();
                }
                , 'post');

        Route::add('/categorias/cant_add',
                function () {
                    $controlador = new \Com\Daw2\Controllers\CategoriaController();
                    $controlador->cant_add();
                }
                , 'get');

        # Gestion de productos


        Route::add('/productos',
                function () {
                    $controlador = new \Com\Daw2\Controllers\ProductoController();
                    $controlador->mostrarTodos();
                }
                , 'get');
        Route::add('/productos/view/([A-Za-z0-9]+)',
                function ($codigo) {
                    $controlador = new \Com\Daw2\Controllers\ProductoController();
                    $controlador->view($codigo);
                }
                , 'get');

        Route::add('/productos/delete/([A-Za-z0-9]+)',
                function ($codigo) {
                    $controlador = new \Com\Daw2\Controllers\ProductoController();
                    $controlador->delete($codigo);
                }
                , 'get');

        Route::add('/productos/edit/([A-Za-z0-9]+)',
                function ($codigo) {
                    $controlador = new \Com\Daw2\Controllers\ProductoController();
                    $controlador->mostrarEdit($codigo);
                }
                , 'get');

        Route::add('/productos/edit/([A-Za-z0-9]+)',
                function ($codigo) {
                    $controlador = new \Com\Daw2\Controllers\ProductoController();
                    $controlador->edit($codigo);
                }
                , 'post');

        Route::add('/productos/add',
                function () {
                    $controlador = new \Com\Daw2\Controllers\ProductoController();
                    $controlador->mostrarAdd();
                }
                , 'get');

        Route::add('/productos/add',
                function () {
                    $controlador = new \Com\Daw2\Controllers\ProductoController();
                    $controlador->add();
                }
                , 'post');

        Route::add('/productos/cant_add',
                function () {
                    $controlador = new \Com\Daw2\Controllers\ProductoController();
                    $controlador->cant_add();
                }
                , 'get');

        # Gestion de proveedores


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
                    $controlador->cant_add();
                }
                , 'get');

        # Ejemplos Cookies y Sesiones:
                
        Route::add('/dark',
                function () {
                    $controlador = new \Com\Daw2\Controllers\CookiesController();
                    $controlador->darkMode();
                }
                , 'get');
                
        Route::add('/light',
                function () {
                    $controlador = new \Com\Daw2\Controllers\CookiesController();
                    $controlador->lightMode();
                }
                , 'get');

        Route::add('/cookie/test',
                function () {
                    $controlador = new \Com\Daw2\Controllers\CookiesController();
                    $controlador->testCookie();
                }
                , 'get');

        Route::add('/cookie/borrar',
                function () {
                    $controlador = new \Com\Daw2\Controllers\CookiesController();
                    $controlador->borrarCookie();
                }
                , 'get');

        Route::add('/session/form',
                function () {
                    $controlador = new \Com\Daw2\Controllers\SessionController();
                    $controlador->sessionForm();
                }
                , 'get');

        Route::add('/session/form',
                function () {
                    $controlador = new \Com\Daw2\Controllers\SessionController();
                    $controlador->sessionFormProcess();
                }
                , 'post');

        Route::add('/session/borrar',
                function () {
                    $controlador = new \Com\Daw2\Controllers\SessionController();
                    $controlador->borrarVariableSession();
                }
                , 'get');

        Route::add('/login',
                function () {
                    $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                    $controlador->login();
                }
                , 'get');

        Route::add('/login',
                function () {
                    $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                    $controlador->loginProcess();
                }
                , 'post');

        Route::add('/login/test-insert',
                function () {
                    $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                    $controlador->testInsert();
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
