<?php

namespace Com\Daw2\Controllers;

class UsuarioSistemaController extends \Com\Daw2\Core\BaseController {

    public function testInsert() {
        $rol = new \Com\Daw2\Helpers\Rol(1, 'Administrador', '', '');
        for ($i = 0; $i < 10; $i++) {
            $email = substr(md5(random_int(1, PHP_INT_MAX)), 0, 15) . '@test.org';
            $usuario = new \Com\Daw2\Helpers\UsuarioSistema(NULL, $rol, $email, 'Test', 'es', false);
            $usuarioSistemaModel = new \Com\Daw2\Models\UsuarioSistemaModel();
            $usuarioSistemaModel->insertUsuarioSistema($usuario, 'test');
        }
    }

    public function login() {
        $this->view->show('login.view.php');
    }

    public function loginProcess() {
        $usuarioSistemaModel = new \Com\Daw2\Models\UsuarioSistemaModel();
        $user = $usuarioSistemaModel->login($_POST['email'], $_POST['password']);
        $_vars = [];
        if (is_null($user)) {
            $_vars['loginError'] = 'Datos de acceso incorrectos';
        } else {
            $_SESSION['user'] = $user;
        }
        $this->view->show('login.view.php', $_vars);
    }

    function mostrarTodos() {
        $data = [];
        $data['titulo'] = 'Todos los usuarios del sistema';
        $data['seccion'] = '/usuarios_sistema';

        $modelo = new \Com\Daw2\Models\UsuarioSistemaModel();
        $data['usuarios_sistema'] = $modelo->getAll();

        $this->view->showViews(array('templates/header.view.php', 'usuarios_sistema.view.php', 'templates/footer.view.php'), $data);
    }

    function mostrarAdd() {
        $data = [];
        $data['titulo'] = 'Nuevo usuario del sistema';
        $data['seccion'] = '/usuario_sistema/add';
        $modelo = new \Com\Daw2\Models\UsuarioSistemaModel();
        $data['roles'] = $modelo->getAllRoles();
        $this->view->showViews(array('templates/header.view.php', 'add.usuario_sistema.view.php', 'templates/footer.view.php'), $data);
    }

    function delete(string $id) {
        $modelo = new \Com\Daw2\Models\UsuarioSistemaModel();
        $result = $modelo->delete($id);
        if ($result == 1) {
            header('Location: /usuarios_sistema');
        } else if ($result == 0) {
            $this->cant_delete($id);
        } else {
            header('location: methodNotAllowed');
        }
    }
    
      function baja(string $id) {
        $modelo = new \Com\Daw2\Models\UsuarioSistemaModel();
        $result = $modelo->baja($id);
        if ($result) {
            header('Location: /usuarios_sistema');
        } else {
            header('location: methodNotAllowed');
        }
    }

    function view(string $id) {
        $data = [];
        $data['titulo'] = 'Usuario del sistema ' . $id;
        $modelo = new \Com\Daw2\Models\UsuarioSistemaModel();
        $data['usuarios_sistema'] = $modelo->view($id);

        $this->view->showViews(array('templates/header.view.php', 'detail.usuario_sistema.view.php', 'templates/footer.view.php'), $data);
    }

    public function add(): void {
        $data = [];
        $data['titulo'] = 'Nuevo usuario del sistema';
        $data['seccion'] = '/usuario_sistema/add';
        $data['errores'] = $this->checkFormAdd($_POST);
        if (count($data['errores']) === 0) {
            $modelo = new \Com\Daw2\Models\UsuarioSistemaModel();
            $result = $modelo->add($_POST['nombre'], $_POST['pass'], $_POST['email'], $_POST['id_rol'], $_POST['idioma']);

            if ($result == "true") {
                header('Location: /usuarios_sistema');
            } else {
                $this->cant_add($result);
            }
        } else {
            $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->view->showViews(array('templates/header-datatable.view.php', 'add.usuario_sistema.view.php', 'templates/footer-datatable.view.php'), $data);
        }
    }

    function cant_add(string $error) {
        $data['titulo'] = 'No se pudo añadir debido a un error inesperado';
        echo $error;
        $data['seccion'] = '/usuarios_sistema';
        $modelo = new \Com\Daw2\Models\UsuarioSistemaModel();
        $data['usuarios_sistema'] = $modelo->getAll();
        $this->view->showViews(array('templates/header.view.php', 'usuarios_sistema.view.php', 'templates/footer.view.php'), $data);
    }

    function getNombreRol(string $id): string {
        $modelo = new \Com\Daw2\Models\UsuarioSistemaModel();
        $toret = $modelo->getNombreRol($id)[0];
        return $toret['nombre_rol'];
    }

    function checkFormAdd(array $post): array {
        $errores = [];
        if (empty($post['nombre'])) {
            $errores['nombre'] = "Campo obligatorio";
        }

        if (empty($post['pass'])) {
            $errores['pass'] = "Campo obligatorio";
        }


        // Pendiente verificar unique
        if (empty($post['email'])) {
            $errores['email'] = "Campo obligatorio";
        }



        if (empty($post['id_rol'])) {
            $errores['id_rol'] = "Campo obligatorio";
        }

        if (empty($post['idioma'])) {
            $errores['idioma'] = "Campo obligatorio";
        }

        return $errores;
    }

}
