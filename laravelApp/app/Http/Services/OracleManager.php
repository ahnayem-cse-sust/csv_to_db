<?php

namespace App\Http\Services;
use Illuminate\Support\Facades\Storage;


class OracleManager{


    /**
     * The Singleton's instance is stored in a static field. This field is an
     * array, because we'll allow our Singleton to have subclasses. Each item in
     * this array will be an instance of a specific Singleton's subclass. You'll
     * see how this works in a moment.
     */
    private static $instances = [];
    private $connection;

    /**
     * The Singleton's constructor should always be private to prevent direct
     * construction calls with the `new` operator.
     */
    protected function __construct() { 
        $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = ".env('ORACLE_DB_HOST').
        ")(PORT = ".env('ORACLE_DB_PORT').")))(CONNECT_DATA=(SID=".env('ORACLE_DB_SERVICE_NAME').")))" ;

        if($con = OCILogon(env('ORACLE_DB_USERNAME'), env('ORACLE_DB_PASSWORD'), $db))
        {
            $this->connection=$con;
        }
        else
        {
            $err = OCIError();
            echo "Connection failed." . $err[text];
        }
    }

    /**
     * Singletons should not be cloneable.
     */
    protected function __clone() { }

    /**
     * Singletons should not be restorable from strings.
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    /**
     * This is the static method that controls the access to the singleton
     * instance. On the first run, it creates a singleton object and places it
     * into the static field. On subsequent runs, it returns the client existing
     * object stored in the static field.
     *
     * This implementation lets you subclass the Singleton class while keeping
     * just one instance of each subclass around.
     */
    public static function getInstance(): OracleManager
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    /**
     * Finally, any singleton should define some business logic, which can be
     * executed on its instance.
     */
    public function dataUploadByTableName($table_name)
    {
        dd('fffffffffff');
        $his_statement ='insert into '.$table_name.'_his 
                        select * from '.$table_name.'
                        where rec_id in
                        (select rec_id from '.$table_name.'_temp)';

        $del_statement ='delete from '.$table_name.'
                            where rec_id in
                            (select rec_id from '.$table_name.'_temp)';
        
        $insert_statement ='insert into '.$table_name.' 
                            select * from '.$table_name.'_temp';

        $s = oci_parse($this->connection, $his_statement);
        if(oci_execute($s)){
            $s = oci_parse($this->connection, $del_statement);
            if(oci_execute($s)){
                $s = oci_parse($this->connection, $insert_statement);
                if(oci_execute($s)){
                    return true;
                }
            }
        }

        return false;
    }
    
}