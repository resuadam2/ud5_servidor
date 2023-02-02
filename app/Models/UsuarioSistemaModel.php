<?php

namespace Com\Daw2\Models;

use Com\Daw2\Helpers;

class UsuarioSistemaModel extends \Com\Daw2\Core\BaseModel {

       public function login(string $email, string $password): Helpers\UsuarioSistema {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario_sistema WHERE email=? and baja=0");
        $stmt->execute([$email]);
        $userData = $stmt->fetchAll()[0];
        if($stmt->rowCount() == 1) {
            $nombreRol = $this->getNombreRol($userData['id_rol'])[0];
            $rol = new Helpers\Rol($userData['id_rol'], $nombreRol['nombre_rol']);
            $user = new Helpers\UsuarioSistema($userData['id_usuario'], $rol, $userData['email'], $userData['nombre'], $userData['idioma'], $userData['baja']);
            return $user;
        } else {
            return NULL;
        }
    }
    
    public function loginErroneo(string $email, string $password): bool {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario_sistema WHERE email=? and baja=0");
        $stmt->execute([$email]);
        if($stmt->rowCount() == 1) {
            $userData = $stmt->fetchAll()[0];

            if(password_verify($password, $userData['pass'])){
                return false;
            }
        } 
        return true;
    }
    
    public function updateLoginData(string $id_usuario) : bool {
        try{
            $stmt = $this->pdo->prepare('UPDATE usuario_sistema SET last_date=SYSDATE() WHERE id_usuario=?');
            $stmt->execute([$id_usuario]);
            return true;
        } catch (PDOException $ex) {
            echo "cant update for some reason: " . $ex->getMossage();
            return false;
        }
    }
    
    
    function getAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM usuario_sistema');
        return $stmt->fetchAll();
    }

    function getNombre(string $id): array {
        $stmt = $this->pdo->prepare('SELECT nombre FROM usuario_sistema WHERE id_usuario=?');
        $stmt->execute([$id]);
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
            if ($baja['baja'] == 0) {
                return $stmt->execute(['1', $id]);
            } else {
                return $stmt->execute(['0', $id]);
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

    function showEdit(string $id): array {
        $stmt = $this->pdo->prepare('SELECT * FROM usuario_sistema WHERE id_usuario=?');
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    function edit(string $id, string $nombre, string $id_rol, string $email, string $pass, string $idioma): bool {
        try {
            $stmt = $this->pdo->prepare('UPDATE usuario_sistema SET nombre=?, id_rol=?, email=?, pass=?, idioma=? WHERE id_usuario=?');
            $pass = password_hash($pass, PASSWORD_BCRYPT);
            return $stmt->execute([$nombre, $id_rol, $email, $pass, $baja, $idioma, $id]);
        } catch (PDOException $ex) {
            echo "cant update for some reason: " . $ex->getMossage();
            return false;
        }
    }

}
