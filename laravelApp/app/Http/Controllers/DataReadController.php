<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suit;

class DataReadController extends Controller
{
    public function __construct()
    {
        
    }

    public function suit($date)
    {
        $suit = new \App\Http\Services\SuitService();

        return $suit->suit($date);
        
        // $filename = 'SUIT.INFO.20240210.csv';

        // $handle = Storage::disk('local')->writeStream('csvData/'.$filename, Storage::disk('sftp')->readStream($filename));

        // $cmd="sqlldr ".env('ORACLE_DB_USERNAME')."/".env('ORACLE_DB_PASSWORD')."@172.17.22.51:1521/rptdemo control=E:/gitProject/csv_to_db/laravelApp/storage/app/csvData/ctl_cim_suits.ctl";
        // system($cmd,$return_value);

        // dd($return_value);
      

        // exit();
    }
}
