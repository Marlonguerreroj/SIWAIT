<?php

require_once 'Dao.php';

class DaoEmpleado extends Dao {

    public function RegistrarEmpleado($DTOEmpleado) {
        try {
            $codigo = $DTOEmpleado->getCodigo();
            $dni = $DTOEmpleado->getDni();
            $sucursal = $DTOEmpleado->getSucursal();
            $tipoEmpleado = $DTOEmpleado->getTipoEmpleado();
            $contraseña = $DTOEmpleado->getContraseña();
            $fIngreso = $DTOEmpleado->getfIngreso();
            $fSalida = null;
            $celular = $DTOEmpleado->getCelular();

            $conexion = $this->conectar();
            $stmt = $conexion->prepare("INSERT INTO Empleado (cod_empleado, dni_cli_empleado,
                cod_sucur_empleado,tipo_empleado,contra_empleado,ingreso_empleado,salida_empleado,
                celular_empleado) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_Param('ssissssi', $codigo, $dni, $sucursal, $tipoEmpleado, $contraseña, $fIngreso, $fSalida, $celular);
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

    public function IniciarSesion($DTOEmpleado) {
        try {
            $id = $DTOEmpleado->getCodigo();
            $contraseña = $DTOEmpleado->getContraseña();
            $conexion = $this->conectar();
            $stmt = $conexion->prepare("SELECT tipo_empleado,estado_empleado,nom_cliente FROM Empleado A inner join Cliente B on
                         A.dni_cli_empleado = B.dni_cliente where cod_empleado = ? and contra_empleado= ?");
            $stmt->bind_param("ss", $id, $contraseña);
            $stmt->execute();
            $stmt->store_result();
            $num = $stmt->num_rows;

            if ($num == 0) {
                $stmt->close();
                $conexion->close();
                return false;
            } else {
                $resultado = array();
                $i = 0;
                $stmt->bind_result($col1, $col2, $col3);
                while ($stmt->fetch()) {
                    $resultado[$i] = array($col1, $col2, $col3);
                    $i++;
                }$stmt->close();
                $conexion->close();
                return $resultado;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function buscarEmpleado($DTOEmpleado) {
        try {
            $tipo = $DTOEmpleado->getTipo();
            $informacion = $DTOEmpleado->getInformacion();
            $conexion = $this->conectar();
            if ($tipo == 'Sucursal') {
                $stmt = $conexion->prepare("SELECT * FROM Empleado A inner join Cliente B on"
                        . " A.dni_cli_empleado = B.dni_cliente where A.cod_sucur_empleado = ?");
                $stmt->bind_param("s", $informacion);
            } else if ($tipo == 'Codigo') {
                $stmt = $conexion->prepare("SELECT * FROM Empleado A inner join Cliente B on"
                        . " A.dni_cli_empleado = B.dni_cliente where A.cod_empleado = ?");
                $stmt->bind_param("s", $informacion);
            } else if ($tipo == 'Dni') {
                $stmt = $conexion->prepare("SELECT * FROM Empleado A inner join Cliente B on"
                        . " A.dni_cli_empleado = B.dni_cliente where A.dni_cli_empleado = ?");
                $stmt->bind_param("s", $informacion);
            } else if ($tipo == 'Todos') {
                $stmt = $conexion->prepare("SELECT * FROM Empleado A inner join Cliente B on"
                        . " A.dni_cli_empleado = B.dni_cliente");
            } else if ($tipo == 'Nombre') {
                $informacion = "%{$informacion}%";
                $stmt = $conexion->prepare("SELECT * FROM Empleado A inner join Cliente B on"
                        . " A.dni_cli_empleado = B.dni_cliente where B.nom_cliente like ? or B.ape_cliente like ?");
                $stmt->bind_param("ss", $informacion, $informacion);
            }
            $stmt->execute();
            $stmt->store_result();
            $num = $stmt->num_rows;
            if ($num == 0) {
                $conexion->close();
                $stmt->close();
                return false;
            } else {
                //echo '<script language="javascript">alert("' . $num . '");</script>';
                $resultado = array();
                $i = 0;
                $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11, $col12, $col13, $col14, $col15);
                while ($stmt->fetch()) {
                    $result = $col1 . "-" . $col2 . "-" . $col3 . "-" . $col4 . "-" .
                            $col5 . "-" . $col6 . "-" . $col7 . "-" . $col8 . "-" . $col10;

                    $resultado[$i] = array($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8,
                        $col9, $col11, $col12, $col13, $col14, $col15);
                    $i++;
                    //echo '<script language="javascript">alert("' . $col11 . '");</script>';
                }

                $stmt->close();
                $conexion->close();
                return $resultado;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function actualizarEmpleado($DTOEmpleado) {
        try {
            $dni = $DTOEmpleado->getDni();
            $celular = $DTOEmpleado->getCelular();
            $sucursal = $DTOEmpleado->getSucursal();
            $fIngreso = $DTOEmpleado->getFIngreso();
            $fSalida = $DTOEmpleado->getFSalida();
            $contraseña = $DTOEmpleado->getContraseña();
            $tipoEmpleado = $DTOEmpleado->getTipoEmpleado();
            $estado = $DTOEmpleado->getEstado();

            $conexion = $this->conectar();
            if (empty($contraseña)) {
                $stmt = $conexion->prepare("UPDATE Empleado SET  cod_sucur_empleado= ? , tipo_empleado= ?,
                ingreso_empleado= ?, salida_empleado= ?, celular_empleado= ?, estado_empleado= ?
                where dni_cli_empleado = ?;");
                $stmt->bind_Param('isssiis', $sucursal, $tipoEmpleado, $fIngreso, $fSalida, $celular, $estado, $dni);
            } else {
                $stmt = $conexion->prepare("UPDATE Empleado SET  cod_sucur_empleado= ? , tipo_empleado= ?,
                contra_empleado= ?,ingreso_empleado= ?, salida_empleado= ?, celular_empleado= ?, estado_empleado= ?
                where dni_cli_empleado = ?;");
                $stmt->bind_Param('issssiis', $sucursal, $tipoEmpleado, $contraseña, $fIngreso, $fSalida, $celular, $estado, $dni);
            }
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
