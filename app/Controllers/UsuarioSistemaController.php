<?php

namespace Com\Daw2\Controllers;

class UsuarioSistemaController extends \Com\Daw2\Core\BaseController {

    public function login() {
        $this->view->show('login.view.php');
    }

    public function loginProcess() {
        $usuarioSistemaModel = new \Com\Daw2\Models\UsuarioSistemaModel();
        // $user = new \Com\Daw2\Helpers\UsuarioSistema();
        $loginErroneo = $usuarioSistemaModel->loginErroneo($_POST['email'], $_POST['pass']);
        $_vars = [];
        if ($loginErroneo) {
            $_vars['loginError'] = 'Datos de acceso incorrectos';
            $this->view->show('login.view.php', $_vars);
        } else {
            $user = $usuarioSistemaModel->login($_POST['email'], $_POST['pass']);
            $_SESSION['usuario'] = $user->getNombre();
            $_SESSION['email'] = $user->getEmail();
            $_SESSION['rol'] = $user->getRol()->getIdRol();
            $_SESSION['id_usuario'] = $user->getIdUsuario();
            $usuarioSistemaModel->updateLoginData($_SESSION['id_usuario']);
            $data = [];
            $data['titulo'] = 'Bienvenido '.$_SESSION['usuario'];
            $data['seccion'] = '/';
            $this->view->showViews(array('templates/header.view.php', 'inicio.view.php', 'templates/footer.view.php'), $data);
        }
        
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

    function getNombre($id): string {
        $modelo = new \Com\Daw2\Models\UsuarioSistemaModel();
        $toret = $modelo->getNombre($id)[0];
        return $toret['nombre'];
    }

    function mostrarEdit($id) {
        $data = [];
        $modelo = new \Com\Daw2\Models\UsuarioSistemaModel();
        $data['usuarios_sistema'] = $modelo->getAll();
        $data['titulo'] = 'Usuario ' . $this->getNombre($id) . ' con ID: ' . $id;
        $data['usuario_sistema'] = $modelo->showEdit($id);
        $data['roles'] = $modelo->getAllRoles();

        $this->view->showViews(array('templates/header.view.php', 'edit.usuario_sistema.view.php', 'templates/footer.view.php'), $data);
    }

    function edit($id): void {
        $data = [];
        $data['titulo'] = 'Usuario del sistema con ID ' . $id;
        $data['seccion'] = '/usuario_sistema/edit/' . $id;
        $data['errores'] = $this->checkFormAdd($_POST);
        if (count($data['errores']) === 0) {
            $modelo = new \Com\Daw2\Models\UsuarioSistemaModel();
            $result = $modelo->edit($id, $_POST['nombre'], $_POST['id_rol'], $_POST['email'], $_POST['pass'], $_POST['idioma']);
            if ($result) {
                header('Location: /usuarios_sistema');
            } else {
                $this->cant_edit($id);
            }
        } else {
            $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->view->showViews(array('templates/header-datatable.view.php', 'edit.usuario_sistema.view.php', 'templates/footer-datatable.view.php'), $data);
        }
    }

    function cant_edit(string $id) {
        $data = [];
        $data['titulo'] = 'No se ha podido editar el usuario del sistema con ID ' . $id . '';
        $data['seccion'] = '/usuarios_sistema';
        $modelo = new \Com\Daw2\Models\CategoriaModel();
        $data['usuarios_sistema'] = $modelo->showEdit($id);

        $this->view->showViews(array('templates/header.view.php', 'edit.usuario_sistema.view.php', 'templates/footer.view.php'), $data);
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
