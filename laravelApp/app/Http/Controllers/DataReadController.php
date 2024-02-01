<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suit;
use Illuminate\Support\Facades\Storage;

class DataReadController extends Controller
{
    public function __construct()
    {
        
    }

    public function suit()
    {

        // $handle = fopen(public_path("SUIT.INFO.20240119.csv"), 'r');
        $filename = "SUIT.INFO.20240119.csv";
        $handle = fopen(Storage::disk('ftp')->url($filename), 'r');
      
        while (($line = fgetcsv($handle, 4096)) !== false) {
            $dataString = implode("| ", $line);
            $row = explode('|', $dataString);
            // print_r($row);

            $dataSuit = new Suit();
            $dataSuit->REC_ID = $row[0];
            $dataSuit->BR_CODE = $row[1];
            $dataSuit->PREV_TRACT_NO = $row[2];
            $dataSuit->SUIT_NO = $row[3];
            $dataSuit->COURT_TYPE = $row[4];
            $dataSuit->COURT_SUB_TYPE = $row[5];
            $dataSuit->SUIT_TYPE = $row[6];
            $dataSuit->SUIT_SUB_TYPE = $row[7];
            $dataSuit->PLAINTIFF = $row[8];
            $dataSuit->DEFENDANT = $row[9];
            $dataSuit->DISTRICT_CODE = $row[10];
            $dataSuit->SUIT_FILING_DATE = $row[11];
            $dataSuit->PRSNT_POS_DATE = $row[12];
            $dataSuit->PRST_POS_CODE = $row[13];
            $dataSuit->PRST_POS_IF_OTHER = $row[14];
            $dataSuit->NEXT_FOLLOW_DATE = $row[15];
            $dataSuit->NEXT_FOLLOW_STATUS = $row[16];
            $dataSuit->CLAIMED_AMOUNT = $row[17];
            $dataSuit->LAWYER_ID = $row[18];
            $dataSuit->ANY_FACILITY = $row[19];
            $dataSuit->SOLENAMA_DATE = $row[20];
            $dataSuit->ANY_DECREE = $row[21];
            $dataSuit->DECREE_DATE = $row[22];
            $dataSuit->TOTAL_SUIT_COST = $row[23];
            $dataSuit->WAIVE_AMOUNT = $row[24];
            $dataSuit->EMP_BANKID = $row[25];
            $dataSuit->EMP_NAME = $row[26];
            $dataSuit->EMP_POST = $row[27];
            $dataSuit->EMP_CONTACT_NO = $row[28];
            $dataSuit->DISPOSAL_DATE = $row[29];
            $dataSuit->DISPOSAL_AMT = $row[30];
            $dataSuit->DISPOSAL_POS = $row[31];
            $dataSuit->DISPOSAL_TYPE = $row[32];
            $dataSuit->FAVOR_OF = $row[33];
            $dataSuit->DISPOSAL_CONDI = $row[34];
            $dataSuit->REMARKS = $row[35];
            $dataSuit->SUIT_STATUS = $row[36];
            $dataSuit->INPUTTER = $row[37];
            $dataSuit->AUTHORISER = $row[38];
            $dataSuit->CO_CODE = $row[39];
            $dataSuit->CASED_BY = $row[40];
            $dataSuit->CAUSE_OF_SUIT = $row[41];
            $dataSuit->AS_ON = $row[42];
            $dataSuit->save();
            echo '<br/>';
          }
      
    //   DB::table('products')->insert($records);

        exit();
    }
}
