<?php

namespace App\Http\Controllers;


use App\Http\Controllers;
use Illuminate\Http\Request;

Use Illuminate\Database\Seeder;
Use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
Use Illuminate\Database\QueryException;
use FilesystemIterator;
Use Illuminate\Support\Facades\File;
Use Illuminate\Support\Facades\Storage;
Use Illuminate\Support\Facades\Response;
Use Illuminate\Http\UploadedFile;
use Barryvdh\DomPDF\Facade as PDF;
use Mail;
use Illuminate\Support\Facades\Config;

class MailController extends Controller{
    
    
    public function index(){
        return view('CalendarPersonal');
    }
    
    public function Notificacion($correo){
        
        $correo['Url'] = "http://process.grupotesta.com.co:8989/BropPayU/public/";
        $correo['UrlRegistro'] = "http://process.grupotesta.com.co:8989/BropPayU/public/RegistroParticipantes/".$correo['idtk'];
        $subject = "Confirmación Compra";
        $for = $correo['destino'];
        Mail::send('mail.notificacion',$correo, function($msj) use($subject,$for){
            $msj->from("soporteprocessplues@gmail.com","Bpro");
            $msj->subject($subject);
            $msj->to($for);
        });
    }
    
    public function NotificacionMasiva($correo){
        
        $correo['Url'] = "http://35.243.142.91:8989/BropPayU/public/";
        //$correo['UrlRegistro'] = "http://process.grupotesta.com.co:8989/BropPayU/public/RegistroParticipantes/".$correo['idtk'];
        $subject = "Te invitamos a participar del Simposio nacional de Gestión del riesgo y Uso seguro de los medicamentos";
        $for = $correo['destino'];
        try {
            Mail::send('mail.notificacionmasiva',$correo, function($msj) use($subject,$for){
            $msj->from("roche.informacion@gmail.com","Roche");
            $msj->subject($subject);
            $msj->to($for);
            echo "aaa";
        });
        } catch (\PDOException $exception) {
            error_log("Error - Crear Boleta: " . $exception->getMessage());
            //return redirect()->route('ErrorCompra'); 
            echo 2;
        }
        
    }
    
    public function NotificacionBoletas($correo){
        
        $correo['Url'] = "http://process.grupotesta.com.co:8989/BropPayU/public/";
        $correo['UrlRegistro'] = "http://process.grupotesta.com.co:8989/BropPayU/public/Boleta/".$correo['idtk'];
        $subject = "Boleta";
        $for = $correo['destino'];
        Mail::send('mail.notificacionboletas',$correo, function($msj) use($subject,$for){
            $msj->from("soporteprocessplues@gmail.com","Bpro");
            $msj->subject($subject);
            $msj->to($for);
        });
    }
    
    
}
