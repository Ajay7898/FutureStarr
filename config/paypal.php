<?php

return array(
/** set your paypal credential **/
// 'client_id' =>'AX-6kQY_CKrDk3Bo6l-Qzs9MVNN4suscDF3jOrmEQUT3lWZBk6c8yoSWPBo_mMyNKfxHI3t_13_mrLb-',
// 'secret' => 'EPfnnETNH3eh0sjPM_v5z1-kKgp7hohxdcdLCk4LKCG-I-Dh-H2iSOQ_I6lDzesCsgxjl_Z3RJsV4R7U',


'client_id' =>'AZahv0ebowhP9YhZR_BGL3mX_NcDfMUN-X-yfQZrEUMq_UgcQUc4O3gcOi73zUACCSfDBoOE15vC_D0K',
'secret' => 'EMe06z5P0P3s1rlUvd8B6UDPnubZmkPZIlo3TmeNcNLOdQ5o6SCpoF69ht9RP4149jntDO9QPiAcavz0',
/**
* SDK configuration 
*/
'settings' => array(
    /**
    * Available option 'sandbox' or 'live'
    */
    'mode' => 'sandbox',
    /**
    * Specify the max request time in seconds
    */
    'http.ConnectionTimeOut' => 1000,
    /**
    * Whether want to log to a file
    */
    'log.LogEnabled' => true,
    /**
    * Specify the file that want to write on
    */
    'log.FileName' => storage_path() . '/logs/paypal.log',
    /**
    * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
    *
    * Logging is most verbose in the 'FINE' level and decreases as you
    * proceed towards ERROR
    */
    'log.LogLevel' => 'FINE'
    ),
);