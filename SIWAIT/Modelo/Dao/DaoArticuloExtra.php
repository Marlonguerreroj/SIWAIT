<?php

require_once 'Dao.php';

class DaoArticuloExtra extends Dao {

    public function registrarArticuloExtra($DTOArticuloExtra) {
        try {
            $codigo = $DTOArticuloExtra->getCodigo();
            $sucursal = $DTOArticuloExtra->getSucursal();
            $nombre = $DTOArticuloExtra->getNombre();
            $cantidad = $DTOArticuloExtra->getCantidad();
            $fEntrada = $DTOArticuloExtra->getFEntrada();
            $costo = $DTOArticuloExtra->getCosto();
            $valor = $DTOArticuloExtra->getValor();
            $notas = $DTOArticuloExtra->getNotas();

            $conexion = $this->conectar();
            $stmt = $conexion->prepare("INSERT INTO ArticuloExtra (cod_articulo_extra ,cod_sucu_articulo_extra,nombre_articulo_extra,
                valor_articulo_extra,cantidad_articulo_extra,notas_articulo_extra,fEntrada_articulo_extra,
                	costo_articulo_extra) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_Param('sisiissi', $codigo, $sucursal, $nombre, $valor, $cantidad, $notas, $fEntrada, $costo);
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

    public function buscarArticuloExtra($DTOArticuloExtra) {
        try {
            $tipo = $DTOArticuloExtra->getTipo();
            $informacion = $DTOArticuloExtra->getInformacion();
            $sucursal = $DTOArticuloExtra->getCodigo();
            $conexion = $this->conectar();
            if ($sucursal == 'Todos') {
                if ($tipo == 'Todos') {
                    $stmt = $conexion->prepare("SELECT * From ArticuloExtra ");
                } else if ($tipo == 'Codigo') {
                    $stmt = $conexion->prepare("SELECT * From ArticuloExtra where "
                            . "cod_articulo_extra = ?");
                    $stmt->bind_param("s", $informacion);
                } else if ($tipo == 'Nombre') {
                    $informacion = "%{$informacion}%";
                    $stmt = $conexion->prepare("SELECT * FROM ArticuloExtra where "
                            . "nombre_articulo_extra like ?");
                    $stmt->bind_param("s", $informacion);
                }
            } else {
                if ($tipo == 'Todos') {
                    $stmt = $conexion->prepare("SELECT * From ArticuloExtra where "
                            . "cod_sucu_articulo_extra = ?");
                    $stmt->bind_param("s", $sucursal);
                } else if ($tipo == 'Codigo') {
                    $stmt = $conexion->prepare("SELECT * From ArticuloExtra where "
                            . "cod_articulo_extra = ? and cod_sucu_articulo_extra= ?");
                    $stmt->bind_param("ss", $informacion, $sucursal);
                } else if ($tipo == 'Nombre') {
                    $informacion = "%{$informacion}%";
                    $stmt = $conexion->prepare("SELECT * FROM ArticuloExtra where "
                            . "nombre_articulo_extra like ? and cod_sucu_articulo_extra= ?");
                    $stmt->bind_param("ss", $informacion, $sucursal);
                }
            }
            $stmt->execute();
            $stmt->store_result();
            $num = $stmt->num_rows;
            if ($num == 0) {
                $stmt->close();
                $conexion->close();
                return false;
            } else {
                //echo '<script language="javascript">alert("' . $num . '");</script>';
                $resultado = array();
                $i = 0;
                $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8);
                while ($stmt->fetch()) {
                    $result = $col1 . "-" . $col2 . "-" . $col3 . "-" . $col4 . "-" .
                            $col5 . "-" . $col6 . "-" . $col7 . "-" . $col8;
                    $resultado[$i] = array($col1, $col2,
                        $col3, $col4, $col5, $col6,
                        $col7, $col8);
                    $i++;
                    //   echo '<script language="javascript">alert("' . $result . '");</script>';
                }

                $stmt->close();
                $conexion->close();
                return $resultado;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}
