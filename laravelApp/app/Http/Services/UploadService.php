<?php

namespace App\Http\Services;
use Illuminate\Support\Facades\Storage;


class UploadService{


    public function __construct(){

    }

    // public function createTable($table_name,$date){
    //     $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = ".env('ORACLE_DB_HOST')
    //     .")(PORT = ".env('ORACLE_DB_PORT').")))(CONNECT_DATA=(SID=".env('ORACLE_DB_SERVICE_NAME').")))" ;

    //     $query = "SELECT * from ".$table_name." fetch first 1 row only";

    //     if($con = OCILogon(env('ORACLE_DB_USERNAME'), env('ORACLE_DB_PASSWORD'), $db))
    //     {
    //         $s = oci_parse($con, $query);
    //         if(oci_execute($s)){

    //             oci_fetch_all($s, $res);
    //             $as_on = $res['AS_ON'][0];
    //             if($date == $as_on){
    //                 return false;
    //             }
    //             $rename_table_query = "rename ".$table_name." to ".$table_name."_".$as_on;
    //             $s = oci_parse($con, $rename_table_query);

    //             if(oci_execute($s)){

    //                 $create_table_query = "create table	".$table_name." as select * from ".$table_name."_".$as_on."	where 1 = 2";                    ;
    //                 $s = oci_parse($con, $create_table_query);

    //                 if(oci_execute($s)){
    //                     OCILogoff($con);
    //                     return true;
    //                 }
    //             }
    //         }
    //         OCILogoff($con);
    //         return false;
    //     }
    //     else
    //     {
    //         $err = OCIError();
    //         // echo "Connection failed." . $err[text];
    //         return false;
    //     }
    //  }

    public function downloadCsv($filename){
        if(Storage::disk('local')->exists('csvData/'.$filename)){
            return true;
        }
        
        if(Storage::disk('sftp')->exists($filename)){
            Storage::disk('local')->writeStream('csvData/'.$filename, Storage::disk('sftp')->readStream($filename));
            return true;
        }
        return false;
    }

    public function getCtlHead($data_file){
        $content = 'LOAD DATA

        INFILE "E:/gitProject/csv_to_db/laravelApp/storage/app/csvData/'.$data_file.'"
        BADFILE "E:/gitProject/csv_to_db/laravelApp/storage/app/badFile/bad_'.$data_file.'"';

        return $content;
     }

    public function createCtl($file,$content){
        Storage::delete('ctl/'.$file);
        return Storage::put( 'ctl/'.$file, $content);
    }

    public function truncateTable($table_name){
        $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = ".env('ORACLE_DB_HOST').
        ")(PORT = ".env('ORACLE_DB_PORT').")))(CONNECT_DATA=(SID=".env('ORACLE_DB_SERVICE_NAME').")))" ;

        if($con = OCILogon(env('ORACLE_DB_USERNAME'), env('ORACLE_DB_PASSWORD'), $db))
        {
            $query = "truncate table ".$table_name;
            $s = oci_parse($con, $query);
            if(oci_execute($s)){
                OCILogoff($con);
                return true;
            }
            OCILogoff($con);
        }
        else
        {
            $err = OCIError();
            echo "Connection failed." . $err[text];
        }
        return false;
    }

    public function runLoader($file){
        $cmd="sqlldr ".env('ORACLE_DB_USERNAME')."/".env('ORACLE_DB_PASSWORD')."@".
        env('ORACLE_DB_HOST').":".env('ORACLE_DB_PORT')."/".env('ORACLE_DB_SERVICE_NAME')." control=".env('STORAGE_LOCATION')."ctl/".$file;
        // dd($cmd);
        $output=null;
        $retval=null;
        exec($cmd, $output, $retval);
        // echo $retval;
        return true;
    }
    
    public function deleteCtl($file){
        return Storage::delete('ctl/'.$file);
    }
    

}