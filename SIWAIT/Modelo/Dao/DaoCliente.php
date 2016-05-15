<?php

require_once 'Dao.php';

class DaoCliente extends Dao {

    public function RegistrarCliente($DTOCliente) {
        try {
            $dni = $DTOCliente->getDni();
            $nombre = $DTOCliente->getNombre();
            $apellido = $DTOCliente->getApellido();
            $direccion = $DTOCliente->getDireccion();
            $telefono = $DTOCliente->getTelefono();
            $email = $DTOCliente->getEmail();

            $conexion = $this->conectar();
            $stmt = $conexion->prepare("INSERT INTO Cliente (dni_cliente,nom_cliente,ape_cliente,
                dir_cliente,tel_cliente,email_cliente) 
            VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_Param('ssssis', $dni, $nombre, $apellido, $direccion, $telefono, $email);
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

    public function buscarCliente($DTOCliente) {
        try {
            $tipo = $DTOCliente->getTipo();
            $informacion = $DTOCliente->getInformacion();
            $conexion = $this->conectar();
            if ($tipo == 'Nombre') {
                $informacion = "%{$informacion}%";
                $stmt = $conexion->prepare("SELECT * FROM Cliente WHERE nom_cliente like ? "
                        . "or ape_cliente like ?");
                $stmt->bind_param("ss", $informacion, $informacion);
            } else if ($tipo == 'Dni') {
                $stmt = $conexion->prepare("SELECT * FROM Cliente WHERE dni_cliente = ?");
                $stmt->bind_param("s", $informacion);
            } else if ($tipo == 'Todos') {
                $stmt = $conexion->prepare("SELECT * FROM Cliente");
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
                $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6);
                while ($stmt->fetch()) {
                    $result = $col1 . "-" . $col2 . "-" . $col3 . "-" . $col4 . "-" .
                            $col5 . "-" . $col6;
                    $resultado[$i] = array($col1, $col2, $col3, $col4, $col5, $col6);
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

    public function actualizarCliente($DTOCliente) {
        try {
            $dni = $DTOCliente->getDni();
            $nombre = $DTOCliente->getNombre();
            $apellido = $DTOCliente->getApellido();
            $direccion = $DTOCliente->getDireccion();
            $telefono = $DTOCliente->getTelefono();
            $email = $DTOCliente->getEmail();


            $conexion = $this->conectar();
            $stmt = $conexion->prepare("UPDATE Cliente SET  nom_cliente= ? , ape_cliente= ?,
                dir_cliente= ?,tel_cliente= ?, email_cliente= ?
                where dni_cliente = ?;
            ");
            $stmt->bind_Param('sssisi', $nombre, $apellido, $direccion, $telefono, $email, $dni);
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
