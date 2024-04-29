<?php

namespace App\Http\Services;


class SuitService{

    private $uploadService;
    public function __construct(){
        $this->uploadService = new \App\Http\Services\UploadService();
    }

    public function suit($date){
        $data_file = 'SUIT.INFO.'.$date.'.csv';

        if($this->uploadService->downloadCsv($data_file)){
            
            $ctl_file = 'ctl_cim_suits.ctl';
            $ctl_content = $this->getSuitCtlContent($data_file,$date);

            if($this->uploadService->createCtl($ctl_file,$ctl_content)){
                if($this->uploadService->truncateTable('cim_suits_temp')){
                    if($this->uploadService->runLoader($ctl_file)){
                        $this->uploadService->deleteCtl($ctl_file);
                        return true;
                    }
                }
            }
        }
        return false;
    }

    private function getSuitCtlContent($data_file,$date){
        
        $quot = "'";
        $content = $this->uploadService->getCtlHead($data_file).'
        
        APPEND INTO TABLE CIM_SUITS_TEMP
        FIELDS TERMINATED BY "|" OPTIONALLY ENCLOSED BY '.$quot.' " '.$quot.' TRAILING NULLCOLS
        (
        REC_ID, 
        BR_CODE, 
        PREV_TRACT_NO, 
        SUIT_NO, 
        COURT_TYPE, 
        COURT_SUB_TYPE, 
        SUIT_TYPE, 
        SUIT_SUB_TYPE,
        PLAINTIFF char(4000), 
        DEFENDANT char(4000), 
        DISTRICT_CODE, 
        SUIT_FILING_DATE,
        PRSNT_POS_DATE, 
        PRST_POS_CODE, 
        PRST_POS_IF_OTHER, 
        NEXT_FOLLOW_DATE, 
        NEXT_FOLLOW_STATUS, 
        CLAIMED_AMOUNT, 
        LAWYER_ID, 
        ANY_FACILITY, 
        SOLENAMA_DATE, 
        ANY_DECREE, 
        DECREE_DATE, 
        TOTAL_SUIT_COST, 
        WAIVE_AMOUNT, 
        EMP_BANKID, 
        EMP_NAME, 
        EMP_POST, 
        EMP_CONTACT_NO, 
        DISPOSAL_DATE, 
        DISPOSAL_AMT, 
        DISPOSAL_POS, 
        DISPOSAL_TYPE, 
        FAVOR_OF, 
        DISPOSAL_CONDI, 
        REMARKS, 
        SUIT_STATUS, 
        INPUTTER, 
        AUTHORISER, 
        CO_CODE,
        CASED_BY,
        CAUSE_OF_SUIT char(4000),
        AS_ON
        )';

        return $content;
    }

    public function suitAccount($date){
        $data_file = 'SUIT.INFO.AC.'.$date.'.csv';
        if($this->uploadService->downloadCsv($data_file)){
            $ctl_file = 'ctl_cim_suit_account.ctl';
            $ctl_content = $this->getSuitAccountCtlContent($data_file,$date);

            if($this->uploadService->createCtl($ctl_file,$ctl_content)){
                if($this->uploadService->createTable("cim_suits_account",$date)){

                    $runLoader = $this->uploadService->runLoader($ctl_file);
                    $ctlDlt = $this->uploadService->deleteCtl($ctl_file);
                    return $runLoader;
                }
            }
        }
        return false;
    }

    private function getSuitAccountCtlContent($data_file,$date){
        
        $quot = "'";
        $content = $this->uploadService->getCtlHead($data_file).'
        
        APPEND INTO TABLE CIM_SUITS_ACCOUNT
        FIELDS TERMINATED BY "|" OPTIONALLY ENCLOSED BY '.$quot.' " '.$quot.' TRAILING NULLCOLS
        (
            REC_ID,
            ACCOUNT_NO,
            AS_ON "'.$date.'"
        )';

        return $content;
    }

    public function suitCost($date){
        $data_file = 'SUIT.COST.'.$date.'.csv';
        if($this->uploadService->downloadCsv($data_file)){
            $ctl_file = 'ctl_cim_suits_cost.ctl';
            $ctl_content = $this->getSuitCostCtlContent($data_file,$date);

            if($this->uploadService->createCtl($ctl_file,$ctl_content)){
                if($this->uploadService->createTable("cim_suits_cost",$date)){

                    $runLoader = $this->uploadService->runLoader($ctl_file);
                    $ctlDlt = $this->uploadService->deleteCtl($ctl_file);
                    return $runLoader;
                }
            }
        }
        return false;
    }

    private function getSuitCostCtlContent($data_file,$date){
        
        $quot = "'";
        $content = $this->uploadService->getCtlHead($data_file).'
        
        APPEND INTO TABLE CIM_SUITS_COST
        FIELDS TERMINATED BY "|" OPTIONALLY ENCLOSED BY '.$quot.' " '.$quot.' TRAILING NULLCOLS
        (
            REC_ID,
            SUIT_NO,
            BR_CODE,
            EXPENSE_AMOUNT,
            EXPENSE_TYPE_CODE,
            REMARK_IF_OTHER,
            AS_ON "'.$date.'"
        )';

        return $content;
    }

    public function suitWriteOff($date){
        $data_file = 'WRITE.OFF.'.$date.'.csv';
        if($this->uploadService->downloadCsv($data_file)){
            $ctl_file = 'ctl_cim_writeoff.ctl';
            $ctl_content = $this->getWriteOffCtlContent($data_file,$date);

            if($this->uploadService->createCtl($ctl_file,$ctl_content)){
                if($this->uploadService->createTable("CIM_LOAN_WRITE_OFF",$date)){

                    $runLoader = $this->uploadService->runLoader($ctl_file);
                    $ctlDlt = $this->uploadService->deleteCtl($ctl_file);
                    return $runLoader;
                }
            }
        }
        return false;
    }

    private function getWriteOffCtlContent($data_file,$date){
        
        $quot = "'";
        $content = $this->uploadService->getCtlHead($data_file).'
        
        APPEND INTO TABLE CIM_LOAN_WRITE_OFF
        FIELDS TERMINATED BY "|" OPTIONALLY ENCLOSED BY '.$quot.' " '.$quot.' TRAILING NULLCOLS
        (
            REC_ID,
            AC_NAME,
            CATEGORY,
            AC_OPENING_DATE,
            BOARD_MET_NO,
            BOARD_MET_DATE,
            WR_CCY,
            INT_RATE,
            WO_PRIN_AMT,
            CHARGE_INT,
            NON_CHARGE_INT,
            PENAL_INT,
            OTHER_INT,
            TOT_WO_AMT,
            RECOVERY_AMT,
            SUIT_FIELD,
            HO_DISB_AMT,
            INT_SUSP_AMT,
            WO_DATE,
            OTHERS_COST,
            LAST_BALANCE,
            RECORD_STATUS,
            CO_CODE,
            AS_ON "'.$date.'"
        )';

        return $content;
    }

}