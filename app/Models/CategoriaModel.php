<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

class CategoriaModel extends \Com\Daw2\Core\BaseModel {

    function getAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM categoria');
        return $stmt->fetchAll();
    }
    
    function size() : int {
        $stmt = $this->pdo->query('SELECT * FROM categoria');
        return count($stmt->fetchAll());
    }

    function getNombreCategoria(string $id): array {
        $stmt = $this->pdo->prepare('SELECT nombre_categoria FROM categoria WHERE id_categoria=?');
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    function delete(string $id): int {
        try { #if there are products enroled to the provider returns 0
            $stmt = $this->pdo->prepare('SELECT * FROM producto WHERE id_categoria=?');
            $stmt->execute([$id]);
            if ($stmt->rowCount() > 0) {
                return 0;
            } else { #if everything was ok return 1
                $stmt = $this->pdo->prepare('DELETE FROM categoria WHERE id_categoria=?');
                $stmt->execute([$id]);
                if ($stmt->rowCount() == 1) {
                    return 1;
                }
            }
        } catch (PDOException $exception) { #if an exception happens return a -1
            return -1;
        }
    }

    function add(string $id, string $nombre, string $idPadre): bool {
        try {
            $size = count($this->getAll());
            if ($idPadre !== null && $idPadre !== '') {
                $stmt = $this->pdo->prepare('INSERT INTO categoria(id_categoria, nombre_categoria, id_padre) values (?,?,?)');
                $stmt->execute([
                    $id, $nombre, $idPadre]
                );
            } else {
                $stmt = $this->pdo->prepare('INSERT INTO categoria(id_categoria, nombre_categoria) values (?,?)');
                $stmt->execute([
                    $id, $nombre]
                );
            }

            $new_size = count($this->getAll());

            if (($size + 1) == $new_size) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    /*
    function idPadreOk(string $id): bool {
        $stmt = $this->pdo->query('SELECT id_categoria FROM categoria');
        $ids [] = $stmt->fetchAll();
        foreach ($ids as $actual) {
            if ($actual === $id) {
                return true;
            }
        }
        return false;
    }
     * 
     */

    function view(string $id): array {
        $stmt = $this->pdo->prepare('SELECT * FROM categoria WHERE id_categoria=?');
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    function showEdit(string $id): array {
        $stmt = $this->pdo->prepare('SELECT * FROM categoria WHERE id_categoria=?');
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    function edit(string $id, string $nombre, string $id_padre, string $idOriginal): bool {
        try {
            $stmt = $this->pdo->prepare('UPDATE categoria SET id_categoria=?, nombre_categoria=?, id_padre=? WHERE id_categoria=?');
            return $stmt->execute([$id, $nombre, $id_padre, $idOriginal]);
        } catch (PDOException $ex) {
            echo "cant update for some reason: " . $ex->getMossage();
            return false;
        }
    }

}
