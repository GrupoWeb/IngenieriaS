<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class directoryUpload extends Controller
{
   public function index(){
       return view('welcome');
   }

   public function read_file(){
    // $thefolder = "files";
    // if ($handler = opendir($thefolder)) {
    //     while (false !== ($file = readdir($handler))) {
    //             echo "$file<br>";
    //     }
    //     closedir($handler);
    // }

    //     $thefolder = "files";
    // if ($handler = opendir($thefolder)) {
    //     echo "<ul>";
    //     while (false !== ($file = readdir($handler))) {
    //             echo "<li>$file</li>";
    //     }
    //     echo "</ul>";
    //     closedir($handler);
    // }

    $path= public_path().'\files';
    $directorio = dir($path);
    // dd($ruta);
    while ($archivo = $directorio -> read())
    {
        if($archivo!="." && $archivo!="..")
        {
            if(is_dir($path.$archivo))
            {
                # Mostramos el nombre de la carpeta y los archivo contenidos
                # en la misma
                echo "<div class='folder'>";
                    echo $this->get_infoFile($path,$archivo);
                echo "</div>";
 
                # llamamos nuevamente a la función con la nueva carpeta
                $this->read_file($path."/".$archivo."/");
            }else{
                // Mostramos el archivo
                echo "<div class='file'>";
                    echo $this->get_infoFile($path,$archivo);
                echo "</div>";
            }
        }
    }
    echo "</div>";
    $directorio -> close();
            
    }
    public function listarArchivos2(){
        $path= public_path().'\files';
    
        
            $dir = opendir($path);
            $files = array();
            while ($elemento = readdir($dir)){
            if( $elemento != "." && $elemento != ".."){
            
            if( is_dir($path.$elemento) ){
            listarArchivos( $path.$elemento.'/' );
            }
            else{
            $files[] = $elemento;
            }
            
            }
            }
            echo $path;
            for($x=0; $x<count( $files ); $x++){
            echo $files[$x].", ";
            }
            echo "<BR>";
            
            
            // $this->listarArchivos2( './' );
    }

    public function get_infoFile($path,$archivo)
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
     
        $cadena="<div class='name'>".$archivo."</div>";
        // $cadena.="<div class='size'>".number_format(filesize($path."/".$archivo)/1024,2,",",".")." Kb</div>";
        $cadena.="<div class='perms'>".substr(sprintf('%o', fileperms($path."/".$archivo)),-4)."</div>";
        // $cadena.="<div class='mime'>".finfo_file($finfo,$path."/".$archivo)."</div>";
        return $cadena;
    }


   public function store(Request $request)
    {
        
        $uploadId = array();
        if ( $files =  $request->file('file')) {
            foreach ($request->file('file') as $key => $file) {
                $name = time() . $key . $file->getClientOriginalName();
                $nameFile = $file->getClientOriginalName();
                $filename = $file->move('files', $name);
                $uploadId[] = Upload::create([
                    'file' => $name,
                    'file_name' =>$nameFile,
                    'evento_id' => $request->evento_id])->id;
            }
        }
        return response()->json($uploadId, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function show(Upload $upload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Upload $upload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function destroy(Upload $upload)
    {
        if (!(empty($upload->file))) {
            if (file_exists(public_path() . '/files/' . $upload->file)) {
                unlink(public_path() . '/files/' . $upload->file);
            }
            Upload::where('id', $upload->id)->delete();
        }
        return response()->json(null, 204);
    }
}
