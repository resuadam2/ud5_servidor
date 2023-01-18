<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

class ProveedorModel extends \Com\Daw2\Core\BaseModel {

    function getAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM proveedor');
        return $stmt->fetchAll();
    }

    function delete(string $cif): int {
        try { #if there are products enroled to the provider returns 0
            $stmt = $this->pdo->prepare('SELECT * FROM producto WHERE proveedor=?');
            $stmt->execute([$cif]);
            if ($stmt->rowCount() > 0) {
                return 0;
            } else { #if everything was ok return 1
                $stmt = $this->pdo->prepare('DELETE FROM proveedor WHERE cif=?');
                $stmt->execute([$cif]);
                if ($stmt->rowCount() == 1) {
                    return 1;
                }
            }
        } catch (PDOException $exception) { #if an exception happens return a -1
            return -1;
        }
    }

    function add(string $cif, string $codigo, string $nombre, string $direccion, string $website, string $pais, string $email, string $telefono): bool {
        try {
            $size = count($this->getAll());
            $stmt = $this->pdo->prepare('INSERT INTO proveedor(cif,codigo,nombre,direccion,website,pais,email,telefono) values (?,?,?,?,?,?,?,?)');
            $stmt->execute([
                $cif, $codigo, $nombre, $direccion, $website, $pais, $email, $telefono]
            );
            $new_size = count($this->getAll());

            if (($size + 1) == $new_size) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            return false;
        }
    }

    function view(string $cif): array {
        $stmt = $this->pdo->prepare('SELECT * FROM proveedor WHERE cif=?');
        $stmt->execute([$cif]);
        return $stmt->fetchAll();
    }

    function showEdit(string $cif): array {
        $stmt = $this->pdo->prepare('SELECT * FROM proveedor WHERE cif=?');
        $stmt->execute([$cif]);
        return $stmt->fetchAll();
    }

    function edit(string $cif, string $codigo, string $nombre, string $direccion, string $website, string $pais, string $email, string $telefono): bool {
        try {
            $stmt = $this->pdo->prepare('UPDATE proveedor SET codigo=?, nombre=?, direccion=?, website=?, pais=?, email=?, telefono=? WHERE cif=?');
            return $stmt->execute([$codigo, $nombre, $direccion, $website, $pais, $email, $telefono, $cif]);
        } catch (PDOException $ex) {
            echo "cant update for some reason: " . $ex->getMessage();
            return false;
        }
    }

}
