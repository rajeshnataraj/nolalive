<?php

    define('DB_HOST','127.0.0.1');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_DATABASE','synergyitc');
    define('DB_CONNECTION','server=127.0.0.1;database=synergyitc;username=root;password=;port=3306;socket=');
    //define('DB_CONNECTION','server=' . DB_HOST . ';database=' . DB_DATABASE . ';username='. DB_USERNAME.' ;password='. DB_PASSWORD. ';port=3306;socket=');

    define('SERVER_PROTOCOL', 'http://');
    define('PAPI_URL', 'http://papi.nolaedu.net');
    define('ITC_URL', 'http://itc.nolaedu.net');
    define('CLOUDFRONT_URL', 'http://cloudfront.nolaedu.net');
    define('CONTENT_URL', 'http://itccontent.nolaedu.net');
    define('ITC_DOMAIN', 'itc.nolaedu.net');

    define('REPORT_SERVER_URL', 'http://itcreport.nolaedu.net/');
    define('THINKSCAPE_KEY', 'pitsco_key');//Oauth key used to log in to Thinkscape
    define('THINKSCAPE_SECRET', 'pitsco_secret'); //Secret used in combination with the THINKSCAPE_KEY above to generate a signature needed to log into Thinkscape


    $password_fails_specification_error_message = "Password must contain at least 1 uppercase character, 1 lowercase character, and 1 number. Additionally, only the following special characters are allowed: !@#$&*=_+";
    $password_regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d!@#$&*=_+]{8,}$/";
    /*Remember to set php.ini's include_path to contain your includes directory and your webroot directory*/


  /*  define('DB_HOST','127.0.0.1');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_DATABASE','synergyitc');

    define('DB_CONNECTION','server=' . DB_HOST . ';database=' . DB_DATABASE . ';username='. DB_USERNAME.' ;password='. DB_PASSWORD. ';port=3306;socket=');

    define('SERVER_PROTOCOL', 'http://');
    define('PAPI_URL', 'http://papi.nolaedu.net');
    define('ITC_URL', 'http://itc.nolaedu.net');
    define('CLOUDFRONT_URL', 'http://cloudfront.nolaedu.net');
    define('CONTENT_URL', 'http://itccontent.nolaedu.net');
    define('ITC_DOMAIN', 'itc.nolaedu.net');

    define('REPORT_SERVER_URL', 'http://itcreport.nolaedu.net/');
    define('THINKSCAPE_KEY', 'pitsco_key');//Oauth key used to log in to Thinkscape
    define('THINKSCAPE_SECRET', 'pitsco_secret'); //Secret used in combination with the THINKSCAPE_KEY above to generate a signature needed to log into Thinkscape


    $password_fails_specification_error_message = "Password must contain at least 1 uppercase character, 1 lowercase character, and 1 number. Additionally, only the following special characters are allowed: !@#$&*=_+";
    $password_regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d!@#$&*=_+]{8,}$/";*/
    /*Remember to set php.ini's include_path to contain your includes directory and your webroot directory*/
