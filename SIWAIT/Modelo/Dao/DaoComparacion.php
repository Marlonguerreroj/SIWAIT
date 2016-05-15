<?php

require_once 'Dao.php';

class DaoComparacion extends Dao {

    public function registrarComparacion($DTOComparacion) {
        try {
            $codigo = $DTOComparacion->getCodigo();
            $sucursal = $DTOComparacion->getSucursal();
            $fecha = $DTOComparacion->getFecha();
            $cantArticulos = $DTOComparacion->getCantArticulos();
            $cantUnidades = $DTOComparacion->getCantUnidades();
            $notas = $DTOComparacion->getNotas();

            $conexion = $this->conectar();
            $stmt = $conexion->prepare("INSERT INTO Comparacion (cod_ped_comparacion,cod_sucursal,
                fecha_comparacion,notas_comparacion,cant_art_comparacion,
                cant_unidades_comparacion) 
            VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_Param('ssssss', $codigo, $sucursal, $fecha, $notas,$cantArticulos,$cantUnidades);
            $stmt->execute();
            $num = $stmt->affected_rows;
            $stmt->close();
            $conexion->close();
            if ($num < 0) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function registrarSeriales($DTOComparacion) {
        try {
            $codigo = $DTOComparacion->getCodigo();
            $sucursal = $DTOComparacion->getSucursal();
            $referencia = $DTOComparacion->getReferencia();
            $pedido = $DTOComparacion->getPedido();
            $descripcion = $DTOComparacion->getNotas();

            $conexion = $this->conectar();
            $stmt = $conexion->prepare("INSERT INTO Serial (codigo_serial,refe_articulo,
                cod_sucursal,cod_ped_comparacion,desc_serial)
            VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_Param('sssss', $codigo, $referencia, $sucursal, $pedido,$descripcion);
            $stmt->execute();
            $num = $stmt->affected_rows;
            $stmt->close();
            $conexion->close();
            if ($num < 0) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function registrarArticuloComparacion($DTOComparacion) {
        try {
            $codigo = $DTOComparacion->getCodigo();
            $referencias = $DTOComparacion->getReferencia();
            $cantidad = $DTOComparacion->getCantArticulos();

            $conexion = $this->conectar();
            $stmt = $conexion->prepare("INSERT INTO ArticuloComparacion (refe_art_artcomp,cod_ped_artcomp,
                cantidad_artcomp) 
            VALUES (?, ?, ?)");
            $stmt->bind_Param('sss', $referencias, $codigo, $cantidad);
            $stmt->execute();
            $num = $stmt->affected_rows;
            $stmt->close();
            $conexion->close();
            if ($num < 0) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}
