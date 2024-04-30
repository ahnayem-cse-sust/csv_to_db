<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class UploadController extends Controller
{
    public function __construct()
    {
        
    }

    public function uploadTodayData()
    {
        $suit = new \App\Http\Services\SuitService();
        $dt = Carbon::yesterday();
        $oracleManager = \App\Http\Services\OracleManager::getInstance();

        if($suit->suit($dt->format('Ymd'))){
            $oracleManager->dataUploadByTableName('cim_suits');
        }

        // $suit->suit($dt->format('Ymd'));
        // $suit->suitAccount($dt->format('Ymd'));
        // $suit->suitCost($dt->format('Ymd'));
        // $suit->suitWriteOff($dt->format('Ymd'));
        return true;
    }

    public function uploadIncrementalData()
    {
        $suit = new \App\Http\Services\SuitService();
        $dt = Carbon::now();
        $suit->suit($dt->format('Ymd'));
        $suit->suitAccount($dt->format('Ymd'));
        $suit->suitCost($dt->format('Ymd'));
        $suit->suitWriteOff($dt->format('Ymd'));
        return true;
    }

}
