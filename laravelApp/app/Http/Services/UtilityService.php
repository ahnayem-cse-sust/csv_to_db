<?php

namespace App\Http\Services;
use Illuminate\Support\Facades\Storage;


class UtilityService{


    public function __construct(){

    }

    public function downloadCsv($filename){
        return Storage::disk('local')->writeStream('csvData/'.$filename, Storage::disk('sftp')->readStream($filename));
        
    }

    public function createCtl($file,$content){
       return Storage::put( 'ctl/'.$file, $content);
    }

    public function deleteCtl($file,$content){
        return Storage::delete('ctl/'.$file);
     }

    public function runLoader($file){
        $cmd="sqlldr ".env('ORACLE_DB_USERNAME')."/".env('ORACLE_DB_PASSWORD')."@".
        env('ORACLE_DB_HOST').":".env('ORACLE_DB_PORT')."/".env('ORACLE_DB_SERVICE_NAME')." 
        control=".env('STORAGE_LOCATION')."ctl/".$file;
        $output=null;
        $retval=null;
        exec($cmd, $output, $retval);
    }

    public function getCtlHead($data_file){
        $content = 'LOAD DATA

        INFILE "E:/gitProject/csv_to_db/laravelApp/storage/app/csvData/'.$data_file.'"
        BADFILE "E:/gitProject/csv_to_db/laravelApp/storage/app/badFile/bad_'.$data_file.'"';

        return $content;
     }

}