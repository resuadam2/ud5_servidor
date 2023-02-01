<?php

namespace Com\Daw2\Models;

use Com\Daw2\Helpers\UsuarioSistema;

class UsuarioSistemaModel extends \Com\Daw2\Core\BaseModel {

    //put your code here
    public function insertUsuarioSistema(UsuarioSistema $usuario, string $password) {
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

    public function login(string $email, string $password): ?\Com\Daw2\Helpers\UsuarioSistema {
        $query = $this->pdo->prepare("SELECT * FROM usuario_sistema LEFT JOIN rol ON rol.id_rol = usuario_sistema.id_rol WHERE email = ? AND baja = 0");
        $query->execute([$email]);
        if ($row = $query->fetch()) {
            if (password_verify($password, $row['pass'])) {
                return $this->rowToUsuarioSistema($row);
            } else {
                return NULL;
            }
        }
        return NULL;
    }

    private function rowToUsuarioSistema(array $row): ?\Com\Daw2\Helpers\UsuarioSistema {
        $rol = new \Com\Daw2\Helpers\Rol($row['id_rol'], $row['rol'], $row['descripcion_es'], $row['descripcion_es']);
        return new \Com\Daw2\Helpers\UsuarioSistema($row['id_usuario'], $rol, $row['email'], $row['nombre'], $row['idioma'], $row['baja']);
    }

    function getAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM usuario_sistema');
        return $stmt->fetchAll();
    }

    function getAllRoles(): array {
        $stmt = $this->pdo->query('SELECT * FROM aux_rol');
        return $stmt->fetchAll();
    }

    function size(): int {
        $stmt = $this->pdo->query('SELECT * FROM usuario_sistema');
        return count($stmt->fetchAll());
    }

    function getNombreRol(string $id): array {
        $stmt = $this->pdo->prepare('SELECT nombre_rol FROM aux_rol WHERE id_rol=?');
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    function delete(string $id): int {
        try {
            #if everything was ok return 1
            $stmt = $this->pdo->prepare('DELETE FROM usuario_sistema WHERE id_usuario=?');
            $stmt->execute([$id]);
            if ($stmt->rowCount() == 1) {
                return 1;
            }
        } catch (PDOException $exception) { #if an exception happens return a -1
            return -1;
        }
    }
    
    function baja(string $id): bool {
        try {
            $prev = $this->pdo->prepare('SELECT baja FROM usuario_sistema WHERE id_usuario=?');
            $prev->execute([$id]);
            $actual = $prev->fetchAll();
            $baja = $actual[0];          
            $stmt = $this->pdo->prepare('UPDATE usuario_sistema SET baja=? WHERE id_usuario=?');
            if($baja['baja'] == 0 ) {
                return $stmt->execute(['1',$id]);
            } else {
                return $stmt->execute(['0',$id]);
            }
           
        } catch (PDOException $exception) { #if an exception happens return false
            return false;
        }
    }

    function view(string $id): array {
        $stmt = $this->pdo->prepare('SELECT * FROM usuario_sistema WHERE id_usuario=?');
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    function add(string $nombre, string $pass, string $email, string $id_rol, string $idioma): string {
        try {
            $stmt = $this->pdo->prepare('INSERT INTO usuario_sistema(id_rol, email, pass, nombre, idioma, last_date, baja) values (?,?,?,?,?,?,?)');
            $pass = password_hash($pass, PASSWORD_BCRYPT);
            return $stmt->execute([
                        $id_rol, $email, $pass, $nombre, $idioma, null, 0]
                    ) . "";
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

}
