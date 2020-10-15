<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginController
 *
 * @author Damian Mosquera
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\AprobacionIngreso;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Mail;
Use Illuminate\Support\Facades\File;
Use Illuminate\Http\UploadedFile;
Use Illuminate\Support\Facades\Storage;
Use Illuminate\Support\Facades\Response;
use FilesystemIterator;
use App\Http\Controllers\MailController;
use App\Http\lib\PayU;

class AdminController extends Controller{
    //put your code here
    public function PayU(){
        Return view('formPayU');
    }

    public function Ingreso(){
        $Mensaje = DB::SELECT("SELECT ValorText "
                . "FROM config "
                . "WHERE Campo = 'MENSAJE_LOGIN' "
                . "ORDER by id asc");
        $ErroM = "";

        if ( session('Time') > date("Y-m-d H:i:s") ){
            return view('Bienvenida');
        }else{
            if( session('Time') == '' ){
                $ErroM = "";
            }else{
                $ErroM = "Su sesión a terminado y sus cambios han sido guardados.";
            }
            $datos = [
            'Mensaje'=>($Mensaje[0]->ValorText),
            'Error'=>$ErroM
                    ];
            return view('inicio')->with('datos',$datos);
        }
    }

    public function CerrarSesion(){
        session()->forget('Time');
        return redirect()->route('loginAdmin');
    }

    public function validaringreso(){
        $Credentials = $this->validate(request(),[
           'User' => 'required|string',
           'inputPassword' => 'required|string'
        ]);


        $UserValidate = DB::SELECT("SELECT id, user, nombre "
                . "from users "
                . "where user = '". addslashes($Credentials['User'])."' and estado = 1 "
                . "and "
                . "pwd = '". md5("HolaCaremonda!!".($Credentials['inputPassword']))."';"
                );
        if( $UserValidate ){
            if( !empty($UserValidate[0]->nombre)){

                session()->flush();
                session(['user' => $UserValidate[0]->user]);
                session(['keyUser' => $UserValidate[0]->id]);

                return redirect()->route('ConsoleAdmin');
            }else{
                return redirect()->route('LoginAdmin');
            }
        }else{
            return redirect()->route('LoginAdmin');
        }
    }

    public function ListTipoComprador(){
        $sql = DB::SELECT("SELECT id, nombre from tipocomprador ");
        return response()->json([
            'info'=>$sql
            ]);
    }

    public function ValidaCodigo(){
        $sql = DB::SELECT("SELECT id,codigo, porcentaje "
                . "from codigos_descuento "
                . "where codigo = '".request()->get('codigo')."'");
        if( count($sql) == 0 ){
            return response()->json([
            'info'=>0
            ]);
        }else{
            return response()->json([
            'info'=>1,
            'por'=>$sql[0]->porcentaje,
            'id'=>$sql[0]->id
            ]);
        }
    }

    public function ConfirmacionCompraPs($id){
        $datos = ['info'=>$id];
        return view('compraboleta')->with('datos',$datos);
    }

    public function SeleccionBoletas(){
        $sql = DB::SELECT("SELECT t.id,"
                . "t.name, t.photo, format(t.valor,0) as valor, t.cantidad, t.dolar,t.include_principal, t.include_normal, t.estado,"
                . "t.taller, tt.nombre as TipoComprador "
                . "FROM type_tickets t "
                . "inner join tipocomprador tt on t.tipocomprador_id = tt.id "
                . "WHERE t.tipocomprador_id = 1");
        foreach($sql as $d){
            $sqlcomprados = DB::SELECT("SELECT COUNT(1) AS Comprados "
                    . "from comprador_ticket "
                    . "where type_tickets_id = ".$d->id
                    . "");
            $d->comprados = $d->cantidad - $sqlcomprados[0]->Comprados;
        }
        $datos = ['info'=>$sql];
        return view('compraboleta')->with('datos',$datos);
    }

    public function ListarBoletas(){
        $sql = DB::SELECT("SELECT "
                . "t.name, t.photo, t.valor, t.include_principal, t.include_normal, t.estado,"
                . "t.taller, tt.nombre as TipoComprador "
                . "FROM type_tickets t "
                . "inner join tipocomprador tt on t.tipocomprador_id = tt.id ");
        return response()->json([
            'info'=>$sql
            ]);
    }

    public function DatosPayU($id){
        DB::beginTransaction();
        try {


            DB::table('facturacion')
            ->where('id', $id)
            ->update([
                'archivo_ext' => (request())
            ]);
            DB::commit();
            if( request()->get('lapResponseCode') == 'APPROVED' || request()->get('lapResponseCode') == 'APROVED' ){
                $sql = DB::SELECT("SELECT DISTINCT "
                        . "ct.comprador_id, c.email, c.name "
                        . "FROM comprador_ticket ct "
                        . "inner join comprador c on c.id = ct.comprador_id "
                        . "where ct.idfacturacion = $id "
                        . "");
                $array = array();
                $array['destino'] = $sql[0]->email;
                $array['persona'] = $sql[0]->name;
                $array['idtk'] = $id;
                (new MailController)->Notificacion($array);
                return redirect()->route('ConfirmacionCompra');
            }else{
                return redirect()->route('ErrorCompra');
            }
        } catch (\PDOException $exception) {
            error_log("Error - Crear Boleta: " . $exception->getMessage());
            return redirect()->route('ErrorCompra');

        }
    }

    public function NotificacionesMasivas(){
        /*$sql = DB::SELECT("SELECT nombre, correo from correos");
        foreach($sql as $s){
            $array = array();
                $array['destino'] = $s->email;
                $array['persona'] = $s->name;
                (new MailController)->NotificacionMasiva($array);
        }*/
        $array = array();
                $array['destino'] = 'damian.mosquera@creategicalatina.com';//$sql[0]->email;
                $array['persona'] = 'Monica Rodriguez';//$sql[0]->name;
                //$array['idtk'] = $id;
                (new MailController)->NotificacionMasiva($array);

    }

    public function ErrorCompra(){
        return view('error');
    }
    public function ConfirmacionCompra(){
        return view('personaConfirm');
    }

    public function GuardarTicketsCompra(){
        DB::beginTransaction();
        try {


            DB::table('comprador')
            ->insert([
                'email' => request()->get('correo'),
                'psw' => md5("HolaPayU".request()->get('psw')),
                'name' => request()->get('name'),
                'apellido' => request()->get('apellido'),
                'celular' => request()->get('celular'),
                'empresa' => request()->get('empresa'),
                'tipocomprador_id' => 2
            ]);
            $idComprador = DB::getPdo()->lastInsertId();
            $tr = json_decode(request()->get('ArrayBoletas'));
            $valor = 0;
            $imp = 0;
            for($i = 0; $i < count($tr) ;$i++){
                $valor += $tr[$i]->valor;

            }
            $imp = request()->get('impuesto');
            $desc = 0;
            $idx = 0;
            if( !empty(request()->get('descuento')) ){
                $desc = request()->get('descuento');
            }
            if( !empty(request()->get('promo')) ){
                $idx = request()->get('promo');
            }
            DB::table('facturacion')
            ->insert([
                'nombre' => request()->get('F_name'),
                'cedula' => request()->get('F_cedula'),
                'direccion' => request()->get('F_direccion'),
                'telefono' => request()->get('F_telefono'),
                'celular' => request()->get('F_celular'),
                'direccion' => request()->get('F_direccion'),
                'email' => request()->get('F_mail'),
                'archivo_ext' => '',
                'mediopago_id' => 1,
                'mediopago_tipocomprador_id' => 2,
                'estado' => 1,
                'ciudades_id' => 1,
                'ciudades_pais_id' => 1,
                'valorcompra' => $valor,
                'impuesto' => ($valor*19)/100,
                'descuento' => $desc,
                'codigodesc' => $idx,
            ]);
            $idTk = DB::getPdo()->lastInsertId();
            $tr = json_decode(request()->get('ArrayBoletas'));
            for($i = 0; $i < count($tr) ;$i++){
                for($x = 0; $x < $tr[$i]->cantidad;$x++){
                    DB::table('comprador_ticket')
                    ->insert([
                        'fecha' => date("Y-m-d H:i:s"),
                        'type_tickets_id' => $tr[$i]->id,
                        'comprador_id' => $idComprador,
                        'idfacturacion' => $idTk
                    ]);
                }
            }
            DB::commit();

            return response()->json([
            'info'=>1,
            'Id'=>$idTk
            ]);
        } catch (\PDOException $exception) {
            error_log("Error - Crear Boleta: " . $exception->getMessage());
            throw new \PDOException("Error - Crear Boleta: " . $exception->getMessage());
            return response()->json([
            'info'=>0
            ]);
        }
    }

    public function formPayUP($id){
        $sql = DB::SELECT("SELECT "
                . "id, valorcompra, impuesto, (valorcompra+impuesto) as Total,email from "
                . "facturacion where id = $id");
        $valor = 0;
        $impuesto = 0;
        $id = 0;
        $total = 0;
        foreach($sql as $t){
            $valor = $t->valorcompra;
            $impuesto = $t->impuesto;
            $total = $t->impuesto + $t->valorcompra;
            $id = $t->id;
        }

        $p = DB::sELECT("SELECT "
                . "merchanid, accountid, apikey, url "
                . "from payu where estado = 1");
        foreach($p as $t){
            $d = $id."-COMPRA BOLETA";
            $t->reference = $id."-COMPRA BOLETA";
            $t->sig = md5($t->apikey."~".$t->merchanid."~".$d."~".$total."~COP");
        }
        $datos = ['info'=>$sql,'pay'=>$p];
        return view('formPPayU')->with('datos',$datos);
    }

    public function GuardarTicketsCompraE(){
        DB::beginTransaction();
        try {

            DB::table('comprador')
            ->insert([
                'email' => request()->get('correo'),
                'psw' => md5("HolaPayU".request()->get('psw')),
                'name' => request()->get('name'),
                'apellido' => request()->get('apellido'),
                'celular' => request()->get('celular'),
                'empresa' => request()->get('empresa'),
                'cargo' => request()->get('cargo'),
                'tipocomprador_id' => 1
            ]);
            $idComprador = DB::getPdo()->lastInsertId();
            $tr = json_decode(request()->get('ArrayBoletas'));
            $valor = 0;
            $imp = 0;
            for($i = 0; $i < count($tr) ;$i++){
                $valor += $tr[$i]->valor;

            }
            $imp = request()->get('impuesto');
            $desc = 0;
            $idx = 0;
            if( !empty(request()->get('descuento')) ){
                $desc = request()->get('descuento');
            }
            if( !empty(request()->get('promo')) ){
                $idx = request()->get('promo');
            }
            $asoc = 0;
            if( request()->get('F_Asociado') == 'Si' ){
                $asoc = 1;
            }
            DB::table('facturacion')
            ->insert([
                'razonsocial' => request()->get('F_name'),
                'nit' => request()->get('F_nit'),
                'asociado' => $asoc,
                'personacontacto' => request()->get('F_persona'),
                'cargo' => request()->get('F_cargo'),
                'codigoacteco' => request()->get('F_acteco'),
                'direccion' => request()->get('F_direccion'),
                'email' => request()->get('F_mail'),
                'celular' => request()->get('F_celular'),
                'archivo_ext' => '',
                'mediopago_id' => 1,
                'mediopago_tipocomprador_id' => 2,
                'estado' => 1,
                'ciudades_id' => 1,
                'ciudades_pais_id' => 1,
                'valorcompra' => $valor,
                'impuesto' => ($valor*19)/100,
                'descuento' => $desc,
                'codigodesc' => $idx,
            ]);
            $idTk = DB::getPdo()->lastInsertId();
            $tr = json_decode(request()->get('ArrayBoletas'));
            for($i = 0; $i < count($tr) ;$i++){
                for($x = 0; $x < $tr[$i]->cantidad;$x++){
                    DB::table('comprador_ticket')
                    ->insert([
                        'fecha' => date("Y-m-d H:i:s"),
                        'type_tickets_id' => $tr[$i]->id,
                        'comprador_id' => $idComprador,
                        'idfacturacion' => $idTk
                    ]);
                }
            }
            DB::commit();
            $array = array();
            $array['destino'] = request()->get('correo');
            $array['persona'] = request()->get('name');
            $array['idtk'] = $idTk;
            (new MailController)->Notificacion($array);
            //return redirect()->route('ConfirmacionCompra');
            return response()->json([
            'info'=>1,
            'Id'=>$idTk
            ]);
        } catch (\PDOException $exception) {
            error_log("Error - Crear Boleta: " . $exception->getMessage());
            throw new \PDOException("Error - Crear Boleta: " . $exception->getMessage());
            return response()->json([
            'info'=>0
            ]);
        }
    }

    public function AddBoleta(Request $request){
        DB::beginTransaction();
        try {
            $NombreArchivo = date("Y_m_d_H_i_s")."Foto_".request()->file('foto1')->getClientOriginalName();
            request()->file('foto1')->storeAs('Boletas/',$NombreArchivo);

            $NombreArchivo2 = date("Y_m_d_H_i_s")."FotoN_".request()->file('foto2')->getClientOriginalName();
            request()->file('foto2')->storeAs('Boletas/',$NombreArchivo2);

            $id = DB::table('type_tickets')
            ->insert([
                'name' => request()->get('nboleta'),
                'photo' => $NombreArchivo,
                'photo2' => $NombreArchivo2,
                'valor' => request()->get('valor'),
                'include_principal' => '',//request()->get('incluye'),
                'include_normal' => '',//request()->get('complemento'),
                'dolar' => request()->get('usd'),
                'cantidad' => request()->get('cantidad'),
                'estado' => 1,
                'tipocomprador_id' => request()->get('aplicaa'),
                'taller' => request()->get('taller'),
                'iduser' => 1,
                'fecha' => date("Y-m-d H:i:s")
            ]);
            DB::commit();
            return redirect()->route('ConsoleAdmin');
        } catch (\PDOException $exception) {
            error_log("Error - Crear Boleta: " . $exception->getMessage());
            throw new \PDOException("Error - Crear Boleta: " . $exception->getMessage());
            return redirect()->route('ConsoleAdmin');
        }
    }

    public function ConsoleAdmin(){
        return view('layout.ConsolaAdmin');
    }

    public function LoginAdmin(){
        return view('layout.loginAdmin');
    }

    public function Sitex(){
        $da = DB::SELECT("SELECT "
                . "id, nombre, icono, subtitulo, descripcion,certificado "
                . "FROM tipocursos "
                . "where estado = 1");
        $datos = [
            'info'=>$da
        ];
        return view('Events')->with('datos',$datos);
    }

    public function InformacionTipo($id){
        $da = DB::SELECT("SELECT "
                . "id, nombre, icono, subtitulo, descripcion,certificado "
                . "FROM tipocursos "
                . "where estado = 1 "
                . "and id = $id");
        $s = DB::SELECT("SELECT "
                . "id, nombre, fechas, horario, link, plataforma , fecha_cierre "
                . "from detalle_talleres where idtaller = $id order by orden");
		$master = DB::SELECT("SELECT * from videosmaster where idcurso = $id");
        $datos = [
            'info'=>$da,
            'info2'=>$s,
            'id'=>$id,
            'master'=>$master
        ];
        return view('compraboleta')->with('datos',$datos);
    }
	public function InformacionTipo2($id){
        $da = DB::SELECT("SELECT "
                . "id, nombre, icono, subtitulo, descripcion,certificado "
                . "FROM tipocursos "
                . "where estado = 1 "
                . "and id = $id");
        $s = DB::SELECT("SELECT "
                . "id, nombre, fechas, horario, link, plataforma, fecha_cierre "
                . "from detalle_talleres where idtaller = $id");
		$master = DB::SELECT("SELECT * from videosmaster where idcurso = $id");
        $datos = [
            'info'=>$da,
            'info2'=>$s,
            'master'=>$master
        ];
        return view('videos')->with('datos',$datos);
    }

	public function Videos($id){
		$master = DB::SELECT("SELECT * from videosmaster where id = $id");
        $datos = [
            'master'=>$master
        ];
        return view('videos')->with('datos',$datos);
    }

    public function RegistroP(){
        $sql = DB::SELECT("SELECT t.id,"
                . "t.name, t.photo,t.photo2, format(t.valor,0) as valor, t.cantidad, t.dolar, t.valor as valors, t.include_principal, t.include_normal, t.estado,"
                . "t.taller, tt.nombre as TipoComprador "
                . "FROM type_tickets t "
                . "inner join tipocomprador tt on t.tipocomprador_id = tt.id "
                . "where tt.id = 2 ");
        foreach($sql as $d){
            $sqlcomprados = DB::SELECT("SELECT COUNT(1) AS Comprados "
                    . "from comprador_ticket "
                    . "where type_tickets_id = ".$d->id
                    . "");
            $d->comprados = $d->cantidad - $sqlcomprados[0]->Comprados;
        }

        $sqlC = DB::sELECT("SELECT  id, concept, DATEDIFF(value, '".date("Y-m-d")."') as Fecha from configpage "
                . "where concept = 'FECHA_DESCUENTO'");
        $datos = ['info'=>$sql,'fecha'=>$sqlC[0]->Fecha,'fechaA'=>date("Y-m-d")];
        return view('personaR')->with('datos',$datos);
    }

    public function RegistroE(){
        $sql = DB::SELECT("SELECT t.id,"
                . "t.name, t.photo, t.photo2,format(t.valor,0) as valor, t.valor as valors, t.cantidad, t.dolar, t.include_principal, t.include_normal, t.estado,"
                . "t.taller, tt.nombre as TipoComprador "
                . "FROM type_tickets t "
                . "inner join tipocomprador tt on t.tipocomprador_id = tt.id "
                . "where tt.id = 1 ");
        foreach($sql as $d){
            $sqlcomprados = DB::SELECT("SELECT COUNT(1) AS Comprados "
                    . "from comprador_ticket "
                    . "where type_tickets_id = ".$d->id
                    . "");
            $d->comprados = $d->cantidad - $sqlcomprados[0]->Comprados;
        }
        $sqlC = DB::sELECT("SELECT  id, concept, DATEDIFF(value, '".date("Y-m-d")."') as Fecha from configpage "
                . "where concept = 'FECHA_DESCUENTO'");
        $datos = ['info'=>$sql,'fecha'=>$sqlC[0]->Fecha,'fechaA'=>date("Y-m-d")];
        return view('empresaR')->with('datos',$datos);
    }

    public function ValidarAsociado(){
        $sql = DB::SELECT("SELECT id from "
                . "asociados where "
                . "nit = '".request()->get('codigo')."'");
        $x = 0;
        if( count($sql)> 0 ){
            $x = 1;
        }
        return response()->json([
            'info'=>$x
            ]);
    }

    public function EnviarLinkBoletas(){
        $s = DB::SELECT("SELECT c.id,"
                . "c.nombre, c.apellido, c.genero, c.noidentificacion, "
                . "c.correo, c.celular, c.pais, c.indicativo, c.ciudad, c.direccion,c.idfacturacion "
                . "FROM comprador_ticket c "
                . "where c.correo  is not null and c.idfacturacion = ".request()->get('fact'));
        foreach($s as $t){
			//$x .= request()->get('fact');
            $array = array();
            $array['destino'] = $t->correo;
            $array['persona'] = $t->nombre." ".$t->apellido;
            $array['idtk'] = $t->id;
            (new MailController)->NotificacionBoletas($array);

        }
		return response()->json([
            'info'=>1
            ]);
    }

    public function ConfirmacionParticipantes($id){
        $sql = DB::SELECT("SELECT t.id,c.idfacturacion,"
                . "t.name, t.photo,t.photo2, format(t.valor,0) as valor, t.valor as valors, t.include_principal, t.include_normal, t.estado,"
                . "t.taller, tt.nombre as TipoComprador , sum(1) as Cantidad "
                . " "
                . "FROM type_tickets t "
                . "inner join tipocomprador tt on t.tipocomprador_id = tt.id "
                . "inner join comprador_ticket c on c.type_tickets_id = t.id "
                . "where c.idfacturacion = $id "
                . "group by t.id,"
                . "t.name, t.photo, t.photo2,format(t.valor,0), t.valor, t.include_principal, t.include_normal, t.estado,"
                . "t.taller, tt.nombre ");
        $sql2 = DB::SELECT("SELECT distinct t.id,c.idfacturacion,"
                . "t.name, t.photo,t.photo2, format(t.valor,0) as valor, t.valor as valors, t.include_principal, t.include_normal, t.estado,"
                . "t.taller, tt.nombre as TipoComprador "
                . "FROM type_tickets t "
                . "inner join tipocomprador tt on t.tipocomprador_id = tt.id "
                . "inner join comprador_ticket c on c.type_tickets_id = t.id "
                . "where c.idfacturacion = $id "
                . "");

        foreach($sql2  as $t){
            $t->sql = "SELECT distinct t.id,c.idfacturacion,"
                . "t.name, t.photo,t.photo2, format(t.valor,0) as valor, t.valor as valors, t.include_principal, t.include_normal, t.estado,"
                . "t.taller, tt.nombre as TipoComprador "
                . "FROM type_tickets t "
                . "inner join tipocomprador tt on t.tipocomprador_id = tt.id "
                . "inner join comprador_ticket c on c.type_tickets_id = t.id "
                . "where c.idfacturacion = $id "
                . "";
            $taller = DB::SELECT("SELECT id, nombre from talleres where "
                    . "idticket = ".$t->id);
            $t->talleres = $taller;
            $s = DB::SELECT("SELECT c.id,"
                . "c.nombre, c.apellido, c.genero, c.noidentificacion, "
                . "c.correo, c.celular, c.pais, c.indicativo, c.ciudad, c.direccion,c.idfacturacion "
                . "FROM comprador_ticket c "
                . "where c.idfacturacion = $id and c.type_tickets_id = ".$t->id);
            $t->detalle = $s;
        }
        $datos = ['info'=>$sql,'info2'=>$sql2];
        return view('confirmacionParticipantes')->with('datos',$datos);
    }

    public function RegistroParticipantes($id){
        $sql = DB::SELECT("SELECT t.id,"
                . "t.name, t.photo, t.photo2,format(t.valor,0) as valor, t.valor as valors, t.include_principal, t.include_normal, t.estado,"
                . "t.taller, tt.nombre as TipoComprador , sum(1) as Cantidad "
                . " "
                . "FROM type_tickets t "
                . "inner join tipocomprador tt on t.tipocomprador_id = tt.id "
                . "inner join comprador_ticket c on c.type_tickets_id = t.id "
                . "where c.idfacturacion = $id "
                . "group by t.id,"
                . "t.name, t.photo, t.photo2,format(t.valor,0), t.valor, t.include_principal, t.include_normal, t.estado,"
                . "t.taller, tt.nombre ");
        $sql2 = DB::SELECT("SELECT distinct t.id,"
                . "t.name, t.photo, t.photo2, format(t.valor,0) as valor, t.valor as valors, t.include_principal, t.include_normal, t.estado,"
                . "t.taller, tt.nombre as TipoComprador "
                . "FROM type_tickets t "
                . "inner join tipocomprador tt on t.tipocomprador_id = tt.id "
                . "inner join comprador_ticket c on c.type_tickets_id = t.id "
                . "where c.idfacturacion = $id "
                . "");

        foreach($sql2  as $t){
            $taller = DB::SELECT("SELECT id, nombre from talleres where "
                    . "idticket = ".$t->id);
            $t->talleres = $taller;
            $s = DB::SELECT("SELECT c.id,"
                . "c.nombre, c.apellido, c.genero, c.noidentificacion, "
                . "c.correo, c.celular, c.pais, c.indicativo, c.ciudad, c.direccion,c.idfacturacion "
                . "FROM comprador_ticket c "
                . "where c.idfacturacion = $id");
            $t->detalle = $s;
        }
        $pais = DB::SELECT("SELECT id,nombre from pais order by nombre asc");
        $datos = ['info'=>$sql,'info2'=>$sql2,'pais'=>$pais];
        return view('registroParticipantes')->with('datos',$datos);
    }

    public function IndicativoPais(){
        $sql = DB::SELECT("SELECT indicativo from pais where nombre  = '".request()->get('pais')."'");
        return response()->json([
            'info'=>$sql[0]->indicativo
            ]);
    }

    public function ParticipanteUpdate(){
        DB::beginTransaction();
        try {


            DB::table('comprador_ticket')
            ->where('id', request()->get('idregistro'))
            ->update([
                'nombre' => request()->get('nombre'),
                'apellido' => request()->get('apellido'),
                'genero' => request()->get('genero'),
                'noidentificacion' => request()->get('identificacion'),
                'correo' => request()->get('correo'),
                'celular' => request()->get('celular'),
                'pais' => request()->get('apellido'),
                'indicativo' => request()->get('indicativo'),
                'ciudad' => request()->get('ciudad'),
                'direccion' => request()->get('direccion')
            ]);
            DB::commit();
            return redirect()->route('ConfirmacionParticipantes',['id'=>request()->get('idP')]);
        } catch (\PDOException $exception) {
            error_log("Error - Crear Boleta: " . $exception->getMessage());
            return redirect()->route('ConfirmacionParticipantes',['id'=>request()->get('idP')]);

        }
    }

}
