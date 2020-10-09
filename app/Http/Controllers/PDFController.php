<?php

namespace App\Http\Controllers;


use App\Http\Controllers;
use Illuminate\Http\Request;

Use Illuminate\Database\Seeder;
Use Illuminate\Support\Facades\DB;
Use Illuminate\Database\QueryException;
use FilesystemIterator;
Use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade as PDF;


class PDFController extends Controller{
    
    
    public function index($id){
        
    }
    
    public function NombreNumeros($num){
        $NumText = ['cero','uno','dos','tres','cuatro','cinco','seis','siete','ocho','nueve','diez','once','doce','trece','catorce','quince',
            'diesiséis','diecisiete','dieciocho','diecinueve','veinte','veintiuno','veintidos','veintitres','veinticuatro','veinticinco','veintiseis',
            'veintisiete','veintiocho','veintinueve','treinta','trintaiuno'];
        return $NumText[$num];
    }
    
    
    public function NombreAnios($num){
        $NumText = "";
        if( $num == 2020 ){
            $NumText = "dos mil veinte";
        }else if( $num == 2021 ){
            $NumText = "dos mil veintiuno";
        }else if( $num == 2022 ){
            $NumText = "dos mil veintidos";
        }else if( $num == 2023 ){
            $NumText = "dos mil veintitres";
        }else if( $num == 2024 ){
            $NumText = "dos mil veinticuatro";
        }else if( $num == 2025 ){
            $NumText = "dos mil veinticinco";
        }
        return $NumText;
    }
    
    
    public function Meses($num){
        $mes = "";
        if( $num == 1 ){
            $mes = "Enero";
        }
        if( $num == 2 ){
            $mes = "Marzo";
        }
        if( $num == 3 ){
            $mes = "Abril";
        }
        if( $num == 5 ){
            $mes = "Enero";
        }
        if( $num == 5 ){
            $mes = "Mayo";
        }
        if( $num == 6 ){
            $mes = "Junio";
        }
        if( $num == 7 ){
            $mes = "Julio";
        }
        if( $num == 8 ){
            $mes = "Agosto";
        }
        if( $num == 9 ){
            $mes = "Septiembre";
        }if( $num == 10 ){
            $mes = "Octubre";
        }
        if( $num == 11 ){
            $mes = "Noviembre";
        }
        if( $num == 12 ){
            $mes = "Diciembre";
        }
        return $mes;
    }
    
    function calculaedad($fechanacimiento){
        $fecha_nacimiento = new DateTime($fechanacimiento);
        $hoy = new DateTime();
        $edad = $hoy->diff($fecha_nacimiento);
        return $edad->y;
    }
    
    public function GenerarCertificadoTaller(){
        $pdf = \PDF::loadView('Pdf.CertificadoTaller');
        //return $pdf->download('ejemplo.pdf');
        /*
            return PDF::loadView('vista-pdf', $data)
        ->stream('archivo.pdf');
         *          */
        $Mes = $this->Meses(date("m"));
        $data = [
            'titulo' => 'Styde.net'
        ];
        return $pdf->loadView('Pdf.CertificadoTaller',$data)->stream('archivo.pdf');
    }
    
    public function Boleta($id){
        session()->forget('s1');
        session()->forget('s2');
        $sql = DB::SELECT("SELECT t.id,"
                . "t.name, t.photo,t.photo2, format(t.valor,0) as valor, t.valor as valors, t.include_principal, t.include_normal, t.estado,"
                . "t.taller, tt.nombre as TipoComprador , sum(1) as Cantidad "
                . " "
                . "FROM type_tickets t "
                . "inner join tipocomprador tt on t.tipocomprador_id = tt.id "
                . "inner join comprador_ticket c on c.type_tickets_id = t.id "
                . "where c.id = $id "
                . "group by t.id,"
                . "t.name, t.photo, t.photo2, format(t.valor,0), t.valor, t.include_principal, t.include_normal, t.estado,"
                . "t.taller, tt.nombre ");
        $sql2 = DB::SELECT("SELECT t.id,"
                . "t.name, t.photo, t.photo2, format(t.valor,0) as valor, t.valor as valors, t.include_principal, t.include_normal, t.estado,"
                . "t.taller, tt.nombre as TipoComprador "
                . "FROM type_tickets t "
                . "inner join tipocomprador tt on t.tipocomprador_id = tt.id "
                . "inner join comprador_ticket c on c.type_tickets_id = t.id "
                . "where c.id = $id "
                . "");
        
        foreach($sql2  as $t){
            $taller = DB::SELECT("SELECT id, nombre from talleres where "
                    . "idticket = ".$t->id);
            $t->talleres = $taller;
            $s = DB::SELECT("SELECT c.id,"
                . "c.nombre, c.apellido, c.genero, c.noidentificacion, "
                . "c.correo, c.celular, c.pais, c.indicativo, c.ciudad, c.direccion,c.idfacturacion "
                . "FROM comprador_ticket c "
                . "where c.id = $id");
            $t->detalle = $s;
        }
        
        session(['s1' => $sql ]);
        session(['s2' => $sql2 ]);
        
        return \PDF::loadView('Pdf.Boleta')->stream('BOLETA.pdf');;
    }
    
    
    
    
}
