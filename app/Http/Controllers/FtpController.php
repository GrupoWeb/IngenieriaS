<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use FTP;

class FtpController extends Controller
{
    public function index()

    
    {
        
        //Direccion local del archivo que queremos subir
        $fileLocal = storage_path('app/indexFTP.html');
 
        /*Direccion remota donde queremos subir el archivo
        En este caso seria a la raiz del servidor*/
       
        $fileRemote = '/indexFTP.html';
 
        $mode = 'FTP_BINARY';
 
        //Hacemos el upload
        FTP::connection()->uploadFile($fileLocal,$fileRemote,$mode);
 
        //Detenemos la funcion con un mensajes
        return('Operación realizada con éxito');
    }
}
