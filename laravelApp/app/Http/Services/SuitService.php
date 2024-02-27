<?php

namespace App\Http\Services;


class SuitService{

    private $util;
    public function __construct(){
        $this->util = new \App\Http\Services\UtilityService();
    }

    public function suit($date){
        $data_file = 'SUIT.INFO.'.$date.'.csv';

        // $this->util->downloadCsv($data_file);

        $ctl_content = $this->getSuitCtlContent($data_file,$date);

        $ctl_file = 'ctl_cim_suits.ctl';
        $ctlCreated = $this->util->createCtl($ctl_file,$ctl_content);

        $runLoader = $this->util->runLoader($ctl_file);

        $ctlDlt = $this->util->deleteCtl($ctl_file);

    }

    private function getSuitCtlContent($data_file,$date){
        
        $quot = "'";
        $content = $this->util->getCtlHead($data_file).'
        
        APPEND INTO TABLE CIM_SUITS
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
        AS_ON "'.$date.'"
        )';

        return $content;
    }

}