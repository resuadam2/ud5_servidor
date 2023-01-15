<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

class UsuarioModel extends \Com\Daw2\Core\BaseModel{
    
    private const FROM = 'FROM usuario LEFT JOIN aux_rol ON aux_rol.id_rol = usuario.id_rol';
    private const SELECT_FROM = 'SELECT usuario.*, aux_rol.nombre_rol '. self::FROM ;
    private const COUNT_FROM = 'SELECT COUNT(*) as total '. self::FROM;
    private const FIELDS_ORDER = ['username', 'nombre_rol', 'salarioBruto', 'retencionIRPF'];
    private const ORDER_DEFECTO = 0;
    
    function getAll() : array{
        $stmt = $this->pdo->query(self::SELECT_FROM);
        return $stmt->fetchAll();
    }  
    
    function delete(string $username) : bool{
        $stmt = $this->pdo->prepare('DELETE FROM usuario WHERE username=?');
        $stmt->execute([$username]);
        return $stmt->rowCount() == 1;
    }
    
    /**
     * 
     * @param array $filtros
     * @return array con posicion condiciones y parametros
     */
    function filter(array $filtros) : array{
        $condiciones = [];
        $parametros = [];
        
        if(isset($filtros['rol']) && is_array($filtros['rol'])){
            $contador = 1;
            $condicionesRol = [];
            foreach($filtros['rol'] as $rol){
                if(filter_var($rol, FILTER_VALIDATE_INT)){
                    $condicionesRol[] = ':rol'.$contador;
                    $parametros['rol'.$contador] = $rol;
                    $contador++;
                }
            }
            if(count($parametros) > 0){
                $condiciones[] = 'usuario.id_rol IN ('.implode(',', $condicionesRol).')';
                
            }
        }
        if(isset($filtros['username']) && !empty($filtros['username'])){
            $condiciones[] = 'usuario.username LIKE :username';
            $parametros['username'] = '%'.$filtros['username'].'%';
        }
        if(isset($filtros['min_salar']) && is_numeric($filtros['min_salar'])){
            $condiciones[] = 'salarioBruto >= :min_salar';
            $parametros['min_salar'] = $filtros['min_salar'];
        }
        if(isset($filtros['max_salar']) && is_numeric($filtros['max_salar'])){
            $condiciones[] = 'salarioBruto <= :max_salar';
            $parametros['max_salar'] = $filtros['max_salar'];
        }
        if(isset($filtros['min_retencion']) && is_numeric($filtros['min_retencion'])){
            $condiciones[] = 'retencionIRPF >= :min_retencion';
            $parametros['min_retencion'] = $filtros['min_retencion'];
        }
        if(isset($filtros['max_retencion']) && is_numeric($filtros['max_retencion'])){
            $condiciones[] = 'retencionIRPF <= :max_retencion';
            $parametros['max_retencion'] = $filtros['max_retencion'];
        }
        return array(
            'condiciones' => $condiciones,
            'parametros' => $parametros
        );
    }
    
    function get(array $filtros, int $tamPag) : array{
        
        $procesado = $this->filter($filtros);
        
        $condiciones = $procesado['condiciones'];
        $parametros = $procesado['parametros'];
        /*
         * Ordenamos 
         */        
        if(isset($filtros['order']) && filter_var($filtros['order'], FILTER_VALIDATE_INT)){
            if($filtros['order'] <= count(self::FIELDS_ORDER) && $filtros['order'] >= 1){
                $fieldOrder = self::FIELDS_ORDER[$filtros['order'] -1];
            }
            else{
                $_GET['order'] = self::ORDER_DEFECTO;
                $fieldOrder = self::FIELDS_ORDER[self::ORDER_DEFECTO];                
            }
        }
        else{
            $_GET['order'] = self::ORDER_DEFECTO;
            $fieldOrder = self::FIELDS_ORDER[self::ORDER_DEFECTO]; 
        }
        
        $pagina = (isset($filtros['page']) && filter_var($filtros['page'], FILTER_VALIDATE_INT) && $filtros['page'] > 0) ? (int) $filtros['page'] : 1;        
        $registroInicial = ($pagina - 1) * $tamPag;        
        $limit = "LIMIT $registroInicial, $tamPag";
        
        if(count($parametros) > 0){
            $sql = self::SELECT_FROM.' WHERE '.implode(" AND ", $condiciones)." ORDER BY $fieldOrder $limit";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parametros);
            return $stmt->fetchAll();
        }
        else{
            $stmt = $this->pdo->query(self::SELECT_FROM." ORDER BY $fieldOrder $limit");
            return $stmt->fetchAll();
        }
    }
    
    function count(array $filtros) : int{
        $procesado = $this->filter($filtros);
        
        $condiciones = $procesado['condiciones'];
        $parametros = $procesado['parametros'];
        
        if(count($parametros) > 0){
            $sql = self::COUNT_FROM.' WHERE '.implode(" AND ", $condiciones);
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parametros);
            $res = $stmt->fetchAll();
            return $res[0]['total'];
        }
        else{
            $stmt = $this->pdo->query(self::COUNT_FROM);
            $res = $stmt->fetchAll();
            return $res[0]['total'];
        }
    }
    
    /*
     * Mejor otra opción
     */
    function get2(array $filtros, bool $contar = false) : array{
        $condiciones = [];
        $parametros = [];
        if(isset($filtros['rol']) && is_array($filtros['rol'])){
            $contador = 1;
            $condicionesRol = [];
            foreach($filtros['rol'] as $rol){
                if(filter_var($rol, FILTER_VALIDATE_INT)){
                    $condicionesRol[] = ':rol'.$contador;
                    $parametros['rol'.$contador] = $rol;
                    $contador++;
                }
            }
            if(count($parametros) > 0){
                $condiciones[] = 'usuario.id_rol IN ('.implode(',', $condicionesRol).')';
                
            }
        }
        if(isset($filtros['username']) && !empty($filtros['username'])){
            $condiciones[] = 'usuario.username LIKE :username';
            $parametros['username'] = '%'.$filtros['username'].'%';
        }
        if(isset($filtros['min_salar']) && is_numeric($filtros['min_salar'])){
            $condiciones[] = 'salarioBruto >= :min_salar';
            $parametros['min_salar'] = $filtros['min_salar'];
        }
        if(isset($filtros['max_salar']) && is_numeric($filtros['max_salar'])){
            $condiciones[] = 'salarioBruto <= :max_salar';
            $parametros['max_salar'] = $filtros['max_salar'];
        }
        if(isset($filtros['min_retencion']) && is_numeric($filtros['min_retencion'])){
            $condiciones[] = 'retencionIRPF >= :min_retencion';
            $parametros['min_retencion'] = $filtros['min_retencion'];
        }
        if(isset($filtros['max_retencion']) && is_numeric($filtros['max_retencion'])){
            $condiciones[] = 'retencionIRPF <= :max_retencion';
            $parametros['max_retencion'] = $filtros['max_retencion'];
        }
        /*
         * Ordenamos 
         */        
        if(isset($filtros['order']) && filter_var($filtros['order'], FILTER_VALIDATE_INT)){
            if($filtros['order'] <= count(self::FIELDS_ORDER) && $filtros['order'] >= 1){
                $fieldOrder = self::FIELDS_ORDER[$filtros['order'] -1];
            }
            else{
                $_GET['order'] = self::ORDER_DEFECTO;
                $fieldOrder = self::FIELDS_ORDER[self::ORDER_DEFECTO];                
            }
        }
        else{
            $_GET['order'] = self::ORDER_DEFECTO;
            $fieldOrder = self::FIELDS_ORDER[self::ORDER_DEFECTO]; 
        }
        
        if(!$contar){
            if(count($parametros) > 0){
                $sql = self::SELECT_FROM.' WHERE '.implode(" AND ", $condiciones)." ORDER BY $fieldOrder";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute($parametros);
                return $stmt->fetchAll();
            }
            else{
                $stmt = $this->pdo->query(self::SELECT_FROM." ORDER BY $fieldOrder");
                return $stmt->fetchAll();
            }
        }
        else{
            if(count($parametros) > 0){
                $sql = self::COUNT_FROM.' WHERE '.implode(" AND ", $condiciones);
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute($parametros);
                return $stmt->fetchAll();
            }
            else{
                $stmt = $this->pdo->query(self::COUNT_FROM);
                return $stmt->fetchAll();
            }
        }
    }
    
    function filterByRol(int $rol) : array{
        $stmt = $this->pdo->prepare(self::SELECT_FROM.' WHERE usuario.id_rol = ?');
        $stmt->execute([$rol]);
        return $stmt->fetchAll();
    }
    
    function filterByUsername(string $username) : array{
        $stmt = $this->pdo->prepare(self::SELECT_FROM . ' WHERE usuario.username LIKE ?');
        $likeUsername = "%$username%";
        $stmt->execute([$likeUsername]);
        return $stmt->fetchAll();
    }
    
    
    /**
     * 
     * @param float $min -1 si no se filtra por salario mínimo o salario mínimo deseado
     * @param float $max -1 si no se filtra por salario máximo o salario máximo deseado
     * @return array Usuarios que cumplen el requisito
     */
    function filterBySalar(float $min, float $max = -1) : array{
        $where = "";
        $params = [];
        if($min != -1){
            $where .= " AND salarioBruto >= :min";
            $params['min'] = $min;
        }
        if($max != -1){
            $where .= " AND salarioBruto <= :max";
            $params['max'] = $max;
        }
        if(count($params) > 0){
            $where = substr($where, 4);
            $query = self::SELECT_FROM . " WHERE $where ORDER BY salarioBruto ASC";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        }
        else{
            $stmt = $this->pdo->query(self::SELECT_FROM);
            return $stmt->fetchAll();
        }
    }
    
    /**
     * 
     * @param float $min -1 si no se filtra por retención mínima o retención mínimo deseado
     * @param float $max -1 si no se filtra por retención máximo o retención máximo deseado
     * @return array Usuarios que cumplen el requisito
     */
    function filterByRetencion(float $min, float $max = -1) : array{
        $where = "";
        $params = [];
        if($min != -1){
            $where .= " AND retencionIRPF >= :min";
            $params['min'] = $min;
        }
        if($max != -1){
            $where .= " AND retencionIRPF <= :max";
            $params['max'] = $max;
        }
        if(count($params) > 0){
            $where = substr($where, 4);
            $sql = self::SELECT_FROM . " WHERE $where ORDER BY retencionIRPF ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();
        }
        else{
            $stmt = $this->pdo->query(self::SELECT_FROM );
            return $stmt->fetchAll();
        }
    }
    
    function getAllOrdenados() : array{
        $stmt = $this->pdo->query(self::SELECT_FROM .' ORDER BY salarioBruto DESC');
        return $stmt->fetchAll();
    }
    
    function getStandard() : array{
        $stmt = $this->pdo->query(self::SELECT_FROM . " WHERE rol='standard'");
        $res = [];
        while($row = $stmt->fetch()){
            $row['salarioNeto'] = $row['salarioBruto'] * (1 - ($row['retencionIRPF']/100));
            $res[] = $row;
        }
        return $res;
    }
    
    function getCarlos() : array{
        $stmt = $this->pdo->query(self::SELECT_FROM . " WHERE username LIKE 'Carlos%'");
        return $stmt->fetchAll();
    }   
    
    function filterByRoles(array $roles) : array{
        $rolesInt = [];
        foreach($roles as $rol){
            if(filter_var($rol, FILTER_VALIDATE_INT)){
                $rolesInt[] = (int) $rol;
            }
        }
        if(count($rolesInt) > 0){
            $queryRoles = implode(",", $rolesInt);
            $sql = self::SELECT_FROM . " WHERE usuario.id_rol IN ($queryRoles)";  
            //echo $sql;die();
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll();
        }
        else{
            return $this->getAll();
        }
    }
    
    function filterByRoles2(array $roles) : array{
        $idsQuery = "";
        $params = [];
        $contador = 1;
        foreach($roles as $rol){
            if(filter_var($rol, FILTER_VALIDATE_INT)){
                $idsQuery .= ", :num$contador";
                $params['num'.$contador] = $rol;
                $contador++;
            }
        }
        if(count($params) > 0){
            $idsQuery = substr($idsQuery, 2);
            $sql = self::SELECT_FROM . " WHERE usuario.id_rol IN ($idsQuery)";
            //echo $sql;var_dump($params);die();
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();
        }
        else{
            return $this->getAll();
        }
    }
}
