<?php

require_once 'Dao.php';

class DaoArticulo extends Dao {

    public function registrarArticulo($DTOArticulo) {
        try {
            $referencia = $DTOArticulo->getReferencia();
            $nombre = $DTOArticulo->getNombre();
            $tipo = $DTOArticulo->getTipoArticulo();

            $conexion = $this->conectar();
            $stmt = $conexion->prepare("INSERT INTO Articulo (refe_articulo ,nom_articulo,tipo_articulo) 
            VALUES (?, ?, ?)");
            $stmt->bind_Param('sss', $referencia, $nombre, $tipo);
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

    public function registrarArticuloPedido($DTOArticulo) {
        try {
            $referencia = $DTOArticulo->getReferencia();
            $cantidad = $DTOArticulo->getCantidad();
            $codigo = $DTOArticulo->getCodigoPedido();

            $conexion = $this->conectar();
            $stmt = $conexion->prepare("INSERT INTO ArticuloPedido (cod_pedido_artped ,refe_articulo_artped,
                cantidad) 
            VALUES (?, ?, ?)");
            $stmt->bind_Param('sss', $codigo, $referencia, $cantidad);
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

    public function buscarArticulo($DTOArticulo) {
        try {
            $tipo = $DTOArticulo->getTipo();
            $informacion = $DTOArticulo->getInformacion();
            $sucursal = $DTOArticulo->getCodigo();
            $conexion = $this->conectar();
            if ($sucursal == 'Todos') {
                if ($tipo == 'Tipo') {
                    $stmt = $conexion->prepare("SELECT * FROM ArticuloSucursal A inner join "
                            . "Articulo B on A.refe_artic_artsuc = B.refe_articulo "
                            . "where tipo_articulo=?");
                    $stmt->bind_param("s", $informacion);
                } else if ($tipo == 'Referencia') {
                    $stmt = $conexion->prepare("SELECT * FROM ArticuloSucursal A inner join "
                            . "Articulo B on A.refe_artic_artsuc = B.refe_articulo "
                            . "where refe_articulo=?");
                    $stmt->bind_param("s", $informacion);
                } else if ($tipo == 'Nombre') {
                    $informacion = "%{$informacion}%";
                    $stmt = $conexion->prepare("SELECT * FROM ArticuloSucursal A inner join "
                            . "Articulo B on A.refe_artic_artsuc = B.refe_articulo "
                            . "where nom_articulo like ?");
                    $stmt->bind_param("s", $informacion);
                } else if ($tipo == 'Referencia2') {
                    $stmt = $conexion->prepare("SELECT * FROM Articulo where refe_articulo=? ");
                    $stmt->bind_param("s", $informacion);
                }
            } else {
                if ($tipo == 'Tipo') {
                    $stmt = $conexion->prepare("SELECT * FROM ArticuloSucursal A inner join "
                            . "Articulo B on A.refe_artic_artsuc = B.refe_articulo "
                            . "where tipo_articulo=? and cod_sucur_artsuc= ?");
                    $stmt->bind_param("ss", $informacion, $sucursal);
                } else if ($tipo == 'Referencia') {
                    $stmt = $conexion->prepare("SELECT * FROM ArticuloSucursal A inner join "
                            . "Articulo B on A.refe_artic_artsuc = B.refe_articulo "
                            . "where refe_articulo=? and cod_sucur_artsuc= ?");
                    $stmt->bind_param("ss", $informacion, $sucursal);
                } else if ($tipo == 'Nombre') {
                    $informacion = "%{$informacion}%";
                    $stmt = $conexion->prepare("SELECT * FROM ArticuloSucursal A inner join "
                            . "Articulo B on A.refe_artic_artsuc = B.refe_articulo "
                            . "where nom_articulo like ? and cod_sucur_artsuc= ?");
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
                if ($tipo == "Referencia2") {
                    $stmt->bind_result($col1, $col2, $col3);
                } else {
                    $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10);
                }
                while ($stmt->fetch()) {
                    if ($tipo == "Referencia2") {
                        $resultado[$i] = array($col1, $col2,
                            $col3);
                        $i++;
                    } else {
                        $resultado[$i] = array($col1, $col2,
                            $col3, $col4, $col5, $col6,
                            $col7, $col8, $col9, $col10);
                        $i++;
                    }
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

    public function actualizarArticulo($DTOArticulo) {
        try {
            $referencia = $DTOArticulo->getReferencia();
            $nombre = $DTOArticulo->getNombre();
            $tipo = $DTOArticulo->getTipoArticulo();


            $conexion = $this->conectar();
            $stmt = $conexion->prepare("UPDATE Articulo SET  nom_articulo= ? , tipo_articulo= ?
                where refe_articulo = ?");
            $stmt->bind_Param('sss', $nombre, $tipo, $referencia);
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
