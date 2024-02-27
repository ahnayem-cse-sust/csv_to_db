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

    public function getCtlHead($data_file){
        $content = 'LOAD DATA

        INFILE "E:/gitProject/csv_to_db/laravelApp/storage/app/csvData/'.$data_file.'"
        BADFILE "E:/gitProject/csv_to_db/laravelApp/storage/app/badFile/bad_'.$data_file.'"';

        return $content;
     }

}