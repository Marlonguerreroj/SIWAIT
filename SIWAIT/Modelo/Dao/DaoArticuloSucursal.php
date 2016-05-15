<?php

require_once 'Dao.php';

class DaoArticuloSucursal extends Dao {

    public function registrarArticuloSucursal($DTOArticulo) {
        try {
            $referencia = $DTOArticulo->getReferencia();
            $sucursal = $DTOArticulo->getSucursal();
            $cantidad = $DTOArticulo->getCantidad();
            $cantidadApart = $DTOArticulo->getApartados();
            $valor0 = $DTOArticulo->getValor();
            $transporte = $DTOArticulo->getCostoTransporte();
            $costo = $DTOArticulo->getCosto();

            $conexion = $this->conectar();
            $stmt = $conexion->prepare("INSERT INTO ArticuloSucursal (refe_artic_artsuc,cod_sucur_artsuc,cant_artsuc,
                cant_apart_artsuc,	valor_artsuc,trans_artsuc,costo_artsuc) 
            VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_Param('ssissss', $referencia, $sucursal, $cantidad, $cantidadApart, $valor0, $transporte, $costo);
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

    public function actualizarArticuloSucursal($DTOArticuloSucursal) {
        try {
            $referencia = $DTOArticuloSucursal->getReferencia();
            $costo = $DTOArticuloSucursal->getCosto();
            $transporte = $DTOArticuloSucursal->getCostoTransporte();
            $valor = $DTOArticuloSucursal->getValor();
            $sucursal = $DTOArticuloSucursal->getSucursal();


            $conexion = $this->conectar();
            $stmt = $conexion->prepare("UPDATE ArticuloSucursal SET  costo_artsuc= ? , trans_artsuc= ?,valor_artsuc= ?
                where refe_artic_artsuc = ? and cod_sucur_artsuc= ?");
            $stmt->bind_Param('iiisi', $costo, $transporte, $valor, $referencia, $sucursal);
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
