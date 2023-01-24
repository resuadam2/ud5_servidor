<?php
namespace Com\Daw2\Controllers;

class UsuarioSistemaController extends \Com\Daw2\Core\BaseController
{
   
   public function testInsert(){
       $rol = new \Com\Daw2\Helpers\Rol(1, 'Administrador', '', '');
       for($i = 0; $i < 10; $i++){
            $email = substr(md5(random_int(1, PHP_INT_MAX)), 0 , 15).'@test.org';
            $usuario = new \Com\Daw2\Helpers\UsuarioSistema(NULL, $rol, $email, 'Test', 'es', false);
            $usuarioSistemaModel = new \Com\Daw2\Models\UsuarioSistemaModel();
            $usuarioSistemaModel->insertUsuarioSistema($usuario, 'test');
       }
   }
   
   public function login(){
       $this->view->show('login.view.php');
   }
   
   public function loginProcess(){
       $usuarioSistemaModel = new \Com\Daw2\Models\UsuarioSistemaModel();
       $user = $usuarioSistemaModel->login($_POST['email'], $_POST['password']);
       $_vars = [];
       if(is_null($user)){
           $_vars['loginError'] = 'Datos de acceso incorrectos';
       }
       else{
           $_SESSION['user'] = $user;
       }
       $this->view->show('login.view.php', $_vars);
   }
   
   
}