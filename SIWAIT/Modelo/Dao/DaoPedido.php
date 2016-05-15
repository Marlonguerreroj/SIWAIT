<?php

require_once 'Dao.php';

class DaoPedido extends Dao {

    public function registrarPedido($DTOPedido) {
        try {
            $codigo = $DTOPedido->getCodigo();
            $proveedor = $DTOPedido->getProveedor();
            $fecha = $DTOPedido->getFecha();
            $notas = $DTOPedido->getNotas();


            $conexion = $this->conectar();
            $stmt = $conexion->prepare("INSERT INTO Pedido (cod_pedido,cod_prove_pedido,
                fecha_pedido,notas_pedido) 
            VALUES (?, ?, ?, ?)");
            $stmt->bind_Param('ssss', $codigo, $proveedor, $fecha, $notas);
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

    public function buscarPedido($DTOPedido) {
        try {
            $tipo = $DTOPedido->getTipo();
            $informacion = $DTOPedido->getInformacion();
            $conexion = $this->conectar();

            $codigo = $DTOPedido->getCodigo();
            $referencia = $DTOPedido->getReferencia();
            if ($tipo == 'Fecha') {
                $stmt = $conexion->prepare("SELECT * FROM Pedido A inner join ArticuloPedido B on
A.cod_pedido = B.cod_pedido_artped where fecha_pedido = ?");
                $stmt->bind_param("s", $informacion);
            } else if ($tipo == 'CodigoProv') {
                $stmt = $conexion->prepare("SELECT * FROM Pedido A inner join ArticuloPedido B on
A.cod_pedido = B.cod_pedido_artped where cod_prove_pedido = ?");
                $stmt->bind_param("s", $informacion);
            } else if ($tipo == 'CodigoPedi') {
                $stmt = $conexion->prepare("SELECT * FROM Pedido A inner join ArticuloPedido B on
A.cod_pedido = B.cod_pedido_artped where cod_pedido = ?");
                $stmt->bind_param("s", $informacion);
            } else if ($tipo == 'Especial') {
                $stmt = $conexion->prepare("SELECT * FROM Pedido A inner join ArticuloPedido B on
A.cod_pedido = B.cod_pedido_artped where cod_pedido = ? and refe_articulo_artped=?");
                $stmt->bind_param("ss", $codigo, $referencia);
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
                $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7);
                while ($stmt->fetch()) {
                    $result = $col1 . "-" . $col2 . "-" . $col3 . "-" . $col4 . "-" .
                            $col5 . "-" . $col6 . "-" . $col7;
                    $resultado[$i] = array($col1, $col2,
                        $col3, $col4, $col5, $col6,
                        $col7);
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
