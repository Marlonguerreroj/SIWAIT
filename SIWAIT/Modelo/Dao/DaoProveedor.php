<?php

require_once 'Dao.php';

class DaoProveedor extends Dao {

    public function registrarProveedor($DTOProveedor) {
        try {
            $codigo = $DTOProveedor->getCodigo();
            $nit = $DTOProveedor->getNit();
            $nombre = $DTOProveedor->getNombre();
            $nCuentaBancaria = $DTOProveedor->getNCuentaBancaria();
            $cuentaBancaria = $DTOProveedor->getCuentaBancaria();
            $pagina = $DTOProveedor->getPagina();
            $nombreContacto = $DTOProveedor->getNombreContacto();
            $telefono = $DTOProveedor->getTelefono();
            $email = $DTOProveedor->getEmail();
            $tipoCuenta = $DTOProveedor->getTipoCuenta();

            $conexion = $this->conectar();
            $stmt = $conexion->prepare("INSERT INTO Proveedor (cod_proveedor,nit_proveedor,nom_proveedor,
                num_cuenta_proveedor,cuenta_proveedor,sitio_web_proveedor,nom_contacto_proveedor,
                tel_contacto_proveedor,email_contacto_proveedor,tipo_cuenta_proveedor) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_Param('sssisssiss', $codigo, $nit, $nombre, $nCuentaBancaria, $cuentaBancaria, $pagina, $nombreContacto, $telefono, $email, $tipoCuenta);
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

    public function buscarProveedor($DTOProveedor) {
        try {
            $tipo = $DTOProveedor->getTipo();
            $informacion = $DTOProveedor->getInformacion();
            $conexion = $this->conectar();
            if ($tipo == 'Codigo') {
                $stmt = $conexion->prepare("SELECT * FROM Proveedor WHERE cod_proveedor = ?");
                $stmt->bind_param("s", $informacion);
            } else if ($tipo == 'Nombre') {
                $stmt = $conexion->prepare("SELECT * FROM Proveedor WHERE nom_proveedor = ?");
                $stmt->bind_param("s", $informacion);
            } else if ($tipo == 'Nit') {
                $stmt = $conexion->prepare("SELECT * FROM Proveedor WHERE nit_proveedor = ?");
                $stmt->bind_param("s", $informacion);
            } else if ($tipo == 'Todos') {
                $stmt = $conexion->prepare("SELECT * FROM Proveedor");
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
                $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10);
                while ($stmt->fetch()) {
                    $result = $col1 . "-" . $col2 . "-" . $col3 . "-" . $col4 . "-" .
                            $col5 . "-" . $col6 . "-" . $col7 . "-" . $col8 . "-" . $col9 . "-" . $col10;
                    $resultado[$i] = array($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10);
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

    public function actualizarProveedor($DTOProveedor) {
        try {
            $codigo = $DTOProveedor->getCodigo();
            $nit = $DTOProveedor->getNit();
            $nombre = $DTOProveedor->getNombre();
            $nCuentaBancaria = $DTOProveedor->getNCuentaBancaria();
            $cuentaBancaria = $DTOProveedor->getCuentaBancaria();
            $pagina = $DTOProveedor->getPagina();
            $nombreContacto = $DTOProveedor->getNombreContacto();
            $telefono = $DTOProveedor->getTelefono();
            $email = $DTOProveedor->getEmail();
            $tipoCuenta = $DTOProveedor->getTipoCuenta();

            $conexion = $this->conectar();
            $stmt = $conexion->prepare("UPDATE Proveedor SET  nit_proveedor= ? , nom_proveedor= ?,
                num_cuenta_proveedor= ?,cuenta_proveedor= ?, sitio_web_proveedor= ?, nom_contacto_proveedor= ?,
                tel_contacto_proveedor= ?,email_contacto_proveedor= ?,tipo_cuenta_proveedor= ?
                where cod_proveedor = ?;
            ");
            $stmt->bind_Param('ssisssssss', $nit, $nombre, $nCuentaBancaria, $cuentaBancaria, $pagina, $nombreContacto, $telefono, $email, $tipoCuenta, $codigo);
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
