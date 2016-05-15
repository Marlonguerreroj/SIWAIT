<?php

require_once 'Dao.php';

class DaoSucursal extends Dao {

    public function registrarSucursal($DTOSucursal) {
        try {
            $codigo = $DTOSucursal->getCodigo();
            $nombre = $DTOSucursal->getNombre();
            $telefono = $DTOSucursal->getTelefono();
            $email = $DTOSucursal->getEmail();
            $pagina = $DTOSucursal->getPagina();
            $direccion = $DTOSucursal->getDireccion();
            $ciudad = $DTOSucursal->getCiudad();
            $pais = $DTOSucursal->getPais();

            $conexion = $this->conectar();
            $stmt = $conexion->prepare("INSERT INTO Sucursal (cod_sucursal,nom_sucursal,tel_sucursal,
                email_sucursal,web_sucursal,dir_sucursal,ciudad_sucursal,pais_sucursal) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_Param('ssisssss', $codigo, $nombre, $telefono, $email, $pagina, $direccion, $ciudad, $pais);
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

    public function buscarSucursal($DTOSucursal) {
        try {
            $tipo = $DTOSucursal->getTipo();
            $informacion = $DTOSucursal->getInformacion();
            $conexion = $this->conectar();
            if ($tipo == 'Codigo') {
                $stmt = $conexion->prepare("SELECT * FROM Sucursal WHERE cod_sucursal = ?");
                $stmt->bind_param("s", $informacion);
            } else if ($tipo == 'Nombre') {
                $stmt = $conexion->prepare("SELECT * FROM Sucursal WHERE nom_sucursal = ?");
                $stmt->bind_param("s", $informacion);
            } else if ($tipo == 'Todos') {
                $stmt = $conexion->prepare("SELECT * FROM Sucursal");
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

    public function actualizarSucursal($DTOSucursal) {
        try {
            $codigo = $DTOSucursal->getCodigo();
            $nombre = $DTOSucursal->getNombre();
            $telefono = $DTOSucursal->getTelefono();
            $email = $DTOSucursal->getEmail();
            $pagina = $DTOSucursal->getPagina();
            $direccion = $DTOSucursal->getDireccion();
            $ciudad = $DTOSucursal->getCiudad();
            $pais = $DTOSucursal->getPais();

            $conexion = $this->conectar();
            $stmt = $conexion->prepare("UPDATE Sucursal SET  nom_sucursal= ? , tel_sucursal= ?,
                email_sucursal= ?,web_sucursal= ?, dir_sucursal= ?, ciudad_sucursal= ?, pais_sucursal= ?
                where cod_sucursal = ?;
            ");
            $stmt->bind_Param('sisssssi', $nombre, $telefono, $email, $pagina, $direccion, $ciudad, $pais, $codigo);
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
