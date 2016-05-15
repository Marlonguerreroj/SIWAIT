<?php

require_once 'Dao/DaoEmpleado.php';
require_once 'Dao/DaoCliente.php';
require_once 'Dao/DaoSucursal.php';
require_once 'Dao/DaoArticulo.php';
require_once 'Dao/DaoPedido.php';
require_once 'Dao/DaoComparacion.php';
require_once 'Dao/DaoArticuloExtra.php';
require_once 'Dao/DaoArticuloSucursal.php';
require_once 'Dao/DaoProveedor.php';
require_once 'Dto/EmpleadoDTO.php';
require_once 'Dto/ComparacionDTO.php';
require_once 'Dto/ClienteDTO.php';
require_once 'Dto/SucursalDTO.php';
require_once 'Dto/ProveedorDTO.php';
require_once 'Dto/ArticuloDTO.php';
require_once 'Dto/PedidoDTO.php';
require_once 'Dto/ArticuloExtraDTO.php';
require_once 'Dto/ArticuloSucursalDTO.php';

class Fachada {

    public function IniciarSesion($id, $contraseña) {
        $DaoEmpleado = new DaoEmpleado();
        $DTOEmpleado = new EmpleadoDTO();
        $id1 = $this->crypt_blowfish($id);
        $contraseña1 = $this->crypt_blowfish($contraseña);
        $DTOEmpleado->setCodigo($id1);
        $DTOEmpleado->setContraseña($contraseña1);
        $valor = $DaoEmpleado->IniciarSesion($DTOEmpleado);
        return $valor;
    }
    public function registrarSeriales($codigo, $referencia, $sucursal,$pedido,$descripcion){
        $DaoComparacion = new DaoComparacion();
        $DTOComparacion = new ComparacionDTO();
        $DTOComparacion->setCodigo($codigo);
        $DTOComparacion->setReferencia($referencia);
        $DTOComparacion->setSucursal($sucursal);
        $DTOComparacion->setNotas($descripcion);
        $DTOComparacion->setPedido($pedido);
        $valor = $DaoComparacion->registrarSeriales($DTOComparacion);
        return $valor;
        
    }
    public function registrarPedido($codigo, $proveedor, $fecha, $notas) {
        $DaoPedido = new DaoPedido();
        $DTOPedido = new PedidoDTO();
        $DTOPedido->setCodigo($codigo);
        $DTOPedido->setProveedor($proveedor);
        $DTOPedido->setFecha($fecha);
        $DTOPedido->setNotas($notas);
        $valor= $DaoPedido->registrarPedido($DTOPedido);
        return $valor;
    }
    public function registrarComparacion($codigo, $sucursal, $fecha, $notas,$cantArticulo,$cantUnidades) {
        $DaoComparacion = new DaoComparacion();
        $DTOComparacion = new ComparacionDTO();
        $DTOComparacion->setCodigo($codigo);
        $DTOComparacion->setSucursal($sucursal);
        $DTOComparacion->setFecha($fecha);
        $DTOComparacion->setNotas($notas);
        $DTOComparacion->setCantArticulos($cantArticulo);
        $DTOComparacion->setCantUnidades($cantUnidades);
        $valor= $DaoComparacion->registrarComparacion($DTOComparacion);
        return $valor;
    }
    public function registrarArticulosComparacion($referencia, $codigo, $cantidad) {
        $DaoComparacion = new DaoComparacion();
        $DTOComparacion = new ComparacionDTO();
        $DTOComparacion->setCodigo($codigo);
        $DTOComparacion->setReferencia($referencia);
        $DTOComparacion->setCantArticulos($cantidad);
        $valor= $DaoComparacion->registrarArticuloComparacion($DTOComparacion);
        return $valor;
    }
    public function registrarArticuloSucursal($referencia, $sucursal, $cantidad, $cantidadApart, $valor0, $transporte, $costo){
        $DaoArticulo = new DaoArticuloSucursal();
        $DTOarticulo = new ArticuloSucursalDTO();
        $DTOarticulo->setReferencia($referencia);
        $DTOarticulo->setSucursal($sucursal);
        $DTOarticulo->setCantidad($cantidad);
        $DTOarticulo->setApartados($cantidadApart);
        $DTOarticulo->setValor($valor0);
        $DTOarticulo->setCostoTransporte($transporte);
        $DTOarticulo->setCosto($costo);
        $valor = $DaoArticulo->registrarArticuloSucursal($DTOarticulo);
        return $valor;
        
    }

    public function registrarArticulo($referencia, $nombre, $tipo) {
        $DaoArticulo = new DaoArticulo();
        $DTOArticulo = new ArticuloDTO();
        $DTOArticulo->setReferencia($referencia);
        $DTOArticulo->setNombre($nombre);
        $DTOArticulo->setTipoArticulo($tipo);
        $valor = $DaoArticulo->registrarArticulo($DTOArticulo);
        return $valor;
    }
    public function registrarArticuloPedido($referencia, $cantidad, $codigoPedido) {
        $DaoArticulo = new DaoArticulo();
        $DTOArticulo = new ArticuloDTO();
        $DTOArticulo->setReferencia($referencia);
        $DTOArticulo->setCantidad($cantidad);
        $DTOArticulo->setCodigoPedido($codigoPedido);
        $valor = $DaoArticulo->registrarArticuloPedido($DTOArticulo);
        return $valor;
    }

    public function registrarArticuloExtra($codigo, $sucursal, $nombre, $cantidad, $fEntrada, $costo, $valorA, $notas) {
        $DaoArticuloExtra = new DaoArticuloExtra();
        $DTOArticuloExtra = new ArticuloExtraDTO();
        $DTOArticuloExtra->setCodigo($codigo);
        $DTOArticuloExtra->setSucursal($sucursal);
        $DTOArticuloExtra->setNombre($nombre);
        $DTOArticuloExtra->setCantidad($cantidad);
        $DTOArticuloExtra->setFEntrada($fEntrada);
        $DTOArticuloExtra->setCosto($costo);
        $DTOArticuloExtra->setValor($valorA);
        $DTOArticuloExtra->setNotas($notas);
        $valor = $DaoArticuloExtra->registrarArticuloExtra($DTOArticuloExtra);
        return $valor;
    }

    public function registrarEmpleado($codigo, $dni, $celular, $sucursal, $fIngreso, $contraseña, $tipoEmpleado) {
        $DaoEmpleado = new DaoEmpleado();
        $DTOEmpleado = new EmpleadoDTO();
        $cod = $this->crypt_blowfish($codigo);
        $DTOEmpleado->setCodigo($cod);
        $DTOEmpleado->setDni($dni);
        $DTOEmpleado->setCelular($celular);
        $DTOEmpleado->setSucursal($sucursal);
        $DTOEmpleado->setFIngreso($fIngreso);
        $password = $this->crypt_blowfish($contraseña);
        $DTOEmpleado->setContraseña($password);
        $DTOEmpleado->setTipoEmpleado($tipoEmpleado);
        $valor = $DaoEmpleado->RegistrarEmpleado($DTOEmpleado);
        return $valor;
    }

    private function crypt_blowfish($password) {
        $salt = '$2x$07$/.hjK5JzAS2.4s5./as9z8';
        return crypt($password, $salt);
    }

    public function registrarCliente($dni, $nombre, $apellido, $direccion, $telefono, $email) {
        $DaoCliente = new DaoCliente();
        $DTOCliente = new ClienteDTO();
        $DTOCliente->setDni($dni);
        $DTOCliente->setNombre($nombre);
        $DTOCliente->setApellido($apellido);
        $DTOCliente->setDireccion($direccion);
        $DTOCliente->setTelefono($telefono);
        $DTOCliente->setEmail($email);
        $valor = $DaoCliente->RegistrarCliente($DTOCliente);
        return $valor;
    }

    public function registrarSucursal($codigo, $nombre, $telefono, $email, $pagina, $direccion, $ciudad, $pais) {
        $DaoSucursal = new DaoSucursal();
        $DTOSucursal = new SucursalDTO();
        $DTOSucursal->setCodigo($codigo);
        $DTOSucursal->setNombre($nombre);
        $DTOSucursal->setTelefono($telefono);
        $DTOSucursal->setEmail($email);
        $DTOSucursal->setPagina($pagina);
        $DTOSucursal->setDireccion($direccion);
        $DTOSucursal->setCiudad($ciudad);
        $DTOSucursal->setPais($pais);
        $valor = $DaoSucursal->registrarSucursal($DTOSucursal);
        return $valor;
    }

    public function registrarProveedor($codigo, $nit, $nombre, $pagina, $telefono, $cuentaBancaria, $nCuentaBancaria, $nombreContacto, $email, $tipoCuenta) {
        $DaoProveedor = new DaoProveedor();
        $DTOProveedor = new ProveedorDTO();
        $DTOProveedor->setCodigo($codigo);
        $DTOProveedor->setNit($nit);
        $DTOProveedor->setNombre($nombre);
        $DTOProveedor->setPagina($pagina);
        $DTOProveedor->setTelefono($telefono);
        $DTOProveedor->setCuentaBancaria($cuentaBancaria);
        $DTOProveedor->setNCuentaBancaria($nCuentaBancaria);
        $DTOProveedor->setNombreContacto($nombreContacto);
        $DTOProveedor->setEmail($email);
        $DTOProveedor->setTipoCuenta($tipoCuenta);
        $valor = $DaoProveedor->registrarProveedor($DTOProveedor);
        return $valor;
    }

    public function buscarSucursal($tipo, $informacion) {
        $DaoSucursal = new DaoSucursal();
        $DTOSucursal = new SucursalDTO();
        $DTOSucursal->setTipo($tipo);
        $DTOSucursal->setInformacion($informacion);
        $valor = $DaoSucursal->buscarSucursal($DTOSucursal);
        return $valor;
    }
    public function buscarPedido($tipo, $informacion) {
        $DaoPedido = new DaoPedido();
        $DTOPedido = new PedidoDTO();
        $DTOPedido->setTipo($tipo);
        $DTOPedido->setInformacion($informacion);
        $valor = $DaoPedido->buscarPedido($DTOPedido);
        return $valor;
    }
    public function buscarPedidoE($tipo, $referencia, $codigo) {
        $DaoPedido = new DaoPedido();
        $DTOPedido = new PedidoDTO();
        $DTOPedido->setTipo($tipo);
        $DTOPedido->setReferencia($referencia);
        $DTOPedido->setCodigo($codigo);
        $valor = $DaoPedido->buscarPedido($DTOPedido);
        return $valor;
    }

    public function buscarArticulo($tipo, $informacion, $sucursal) {
        $DaoArticulo = new DaoArticulo();
        $DTOArticulo = new ArticuloDTO();
        $DTOArticulo->setTipo($tipo);
        $DTOArticulo->setInformacion($informacion);
        $DTOArticulo->setCodigo($sucursal);
        $valor = $DaoArticulo->buscarArticulo($DTOArticulo);
        return $valor;
    }

    public function buscarArticuloExtra($tipo, $informacion, $sucursal) {
        $DaoArticuloExtra = new DaoArticuloExtra();
        $DTOArticuloExtra = new ArticuloExtraDTO();
        $DTOArticuloExtra->setTipo($tipo);
        $DTOArticuloExtra->setInformacion($informacion);
        $DTOArticuloExtra->setCodigo($sucursal);
        $valor = $DaoArticuloExtra->buscarArticuloExtra($DTOArticuloExtra);
        return $valor;
    }

    public function buscarCliente($tipo, $informacion) {
        $DaoCliente = new DaoCliente();
        $DTOCliente = new ClienteDTO();
        $DTOCliente->setTipo($tipo);
        $DTOCliente->setInformacion($informacion);
        $valor = $DaoCliente->buscarCliente($DTOCliente);
        return $valor;
    }

    public function buscarProveedor($tipo, $informacion) {
        $DaoProveedor = new DaoProveedor();
        $DTOProveedor = new ProveedorDTO();
        $DTOProveedor->setTipo($tipo);
        $DTOProveedor->setInformacion($informacion);
        $valor = $DaoProveedor->buscarProveedor($DTOProveedor);
        return $valor;
    }

    public function buscarEmpleado($tipo, $informacion) {
        $DaoEmpleado = new DaoEmpleado();
        $DTOEmpleado = new EmpleadoDTO();
        $DTOEmpleado->setTipo($tipo);
        if ($tipo == "Codigo") {
            $informacion2 = $this->crypt_blowfish($informacion);
            $DTOEmpleado->setInformacion($informacion2);
        } else {
            $DTOEmpleado->setInformacion($informacion);
        }
        $valor = $DaoEmpleado->buscarEmpleado($DTOEmpleado);
        return $valor;
    }

    public function actualizarSucursal($codigo, $nombre, $telefono, $email, $pagina, $direccion, $ciudad, $pais) {
        $DaoSucursal = new DaoSucursal();
        $DTOSucursal = new SucursalDTO();
        $DTOSucursal->setCodigo($codigo);
        $DTOSucursal->setNombre($nombre);
        $DTOSucursal->setTelefono($telefono);
        $DTOSucursal->setEmail($email);
        $DTOSucursal->setPagina($pagina);
        $DTOSucursal->setDireccion($direccion);
        $DTOSucursal->setCiudad($ciudad);
        $DTOSucursal->setPais($pais);
        $valor = $DaoSucursal->actualizarSucursal($DTOSucursal);
        return $valor;
    }

    public function actualizarCliente($dni, $nombre, $apellido, $direccion, $telefono, $email) {
        $DaoCliente = new DaoCliente();
        $DTOCliente = new ClienteDTO();
        $DTOCliente->setDni($dni);
        $DTOCliente->setNombre($nombre);
        $DTOCliente->setApellido($apellido);
        $DTOCliente->setDireccion($direccion);
        $DTOCliente->setTelefono($telefono);
        $DTOCliente->setEmail($email);
        $valor = $DaoCliente->actualizarCliente($DTOCliente);
        return $valor;
    }

    public function actualizarArticulo($referencia, $nombre, $tipo) {
        $DaoArticulo = new DaoArticulo();
        $DTOArticulo = new ArticuloDTO();
        $DTOArticulo->setReferencia($referencia);
        $DTOArticulo->setNombre($nombre);
        $DTOArticulo->setTipoArticulo($tipo);
        $valor = $DaoArticulo->actualizarArticulo($DTOArticulo);
        return $valor;
    }

    public function actualizarArticuloSucursal($sucursal, $referencia, $costo, $transporte, $valorA) {
        $DaoArticuloSucursal = new DaoArticuloSucursal();
        $DTOArticuloSucursal = new ArticuloSucursalDTO();
        $DTOArticuloSucursal->setSucursal($sucursal);
        $DTOArticuloSucursal->setReferencia($referencia);
        $DTOArticuloSucursal->setCosto($costo);
        $DTOArticuloSucursal->setCostoTransporte($transporte);
        $DTOArticuloSucursal->setValor($valorA);
        $valor = $DaoArticuloSucursal->actualizarArticuloSucursal($DTOArticuloSucursal);
        return $valor;
    }

    public function actualizarProveedor($codigo, $nit, $nombre, $pagina, $telefono, $cuentaBancaria, $nCuentaBancaria, $nombreContacto, $email, $tipoCuenta) {
        $DaoProveedor = new DaoProveedor();
        $DTOProveedor = new ProveedorDTO();
        $DTOProveedor->setCodigo($codigo);
        $DTOProveedor->setNit($nit);
        $DTOProveedor->setNombre($nombre);
        $DTOProveedor->setPagina($pagina);
        $DTOProveedor->setTelefono($telefono);
        $DTOProveedor->setCuentaBancaria($cuentaBancaria);
        $DTOProveedor->setNCuentaBancaria($nCuentaBancaria);
        $DTOProveedor->setNombreContacto($nombreContacto);
        $DTOProveedor->setEmail($email);
        $DTOProveedor->setTipoCuenta($tipoCuenta);
        $valor = $DaoProveedor->actualizarProveedor($DTOProveedor);
        return $valor;
    }

    public function actualizarEmpleado($dni, $celular, $sucursal, $fIngreso, $fSalida, $contraseña, $tipoEmpleado, $estado) {
        $DaoEmpleado = new DaoEmpleado();
        $DTOEmpleado = new EmpleadoDTO();
        $DTOEmpleado->setDni($dni);
        $DTOEmpleado->setCelular($celular);
        $DTOEmpleado->setSucursal($sucursal);
        $DTOEmpleado->setFIngreso($fIngreso);
        $DTOEmpleado->setFSalida($fSalida);
        $DTOEmpleado->setTipoEmpleado($tipoEmpleado);
        $DTOEmpleado->setEstado($estado);

        if (!empty($contraseña)) {
            $contraseña1 = $this->crypt_blowfish($contraseña);
            $DTOEmpleado->setContraseña($contraseña1);
        } else {
            $DTOEmpleado->setContraseña($contraseña);
        }
        $valor = $DaoEmpleado->actualizarEmpleado($DTOEmpleado);
        return $valor;
    }

}
