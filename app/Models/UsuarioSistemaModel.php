<?php


namespace Com\Daw2\Models;

use Com\Daw2\Helpers\UsuarioSistema;

class UsuarioSistemaModel extends \Com\Daw2\Core\BaseModel{
    //put your code here
    public function insertUsuarioSistema(UsuarioSistema $usuario, string $password){
        $sql = "INSERT INTO `usuario_sistema` (`id_rol`, `email`, `pass`, `nombre`, `idioma`, `baja`) VALUES (:id_rol, :email, :pass, :nombre, :idioma, :baja)";
        $query = $this->pdo->prepare($sql);
        $query->bindValue('baja', $usuario->getBaja(), \PDO::PARAM_BOOL);
        $query->bindValue('id_rol', $usuario->getRol()->getIdRol(), \PDO::PARAM_INT);
        $query->bindValue('email', $usuario->getEmail());
        $query->bindValue('pass', password_hash($password, PASSWORD_DEFAULT));
        $query->bindValue('nombre', $usuario->getNombre());
        $query->bindValue('idioma', $usuario->getIdioma());
        return $query->execute();
    }
    
    public function login(string $email, string $password) : ?\Com\Daw2\Helpers\UsuarioSistema{
        $query = $this->pdo->prepare("SELECT * FROM usuario_sistema LEFT JOIN rol ON rol.id_rol = usuario_sistema.id_rol WHERE email = ? AND baja = 0");
        $query->execute([$email]);        
        if($row = $query->fetch()){
            if(password_verify($password, $row['pass'])){
                return $this->rowToUsuarioSistema($row);
            }
            else{
                return NULL;
            }
        }
        return NULL;
    }
    
    private function rowToUsuarioSistema(array $row) : ?\Com\Daw2\Helpers\UsuarioSistema{
        $rol = new \Com\Daw2\Helpers\Rol($row['id_rol'], $row['rol'], $row['descripcion_es'], $row['descripcion_es']);
        return new \Com\Daw2\Helpers\UsuarioSistema($row['id_usuario'], $rol, $row['email'], $row['nombre'], $row['idioma'], $row['baja']);
    }
}
