<?php
/*
 * 設定ファイル
 */

//Twitter api接続情報

//local: local PC環境

    //Consumer keyの値を格納
    define('_ConsumerKey_', "aoxKloULiPsmVvifRkWWwDaXN");
    //Consumer secretの値を格納
    define('_ConsumerSecret_', "Q6SYkabK016gO19AWti0SHsqFGVaAGzChYsuOvpMMchK2DbDdb");
    
    define('_callback_', "http://127.0.0.1/autoWe/index_voc.php");
    
    //検索結果開始時間
    define('_since_date_', "2018-09-10");
    //検索結果終了時間
    define('_until_date_', "2018-09-20");


    //weibo　key 
    define( "WB_AKEY" , '1699113922' );
    define( "WB_SKEY" , 'b5e332b54ac3487822b5aad38a1c9a36' );
    define( "WB_CALLBACK_URL" , 'https://weibote.herokuapp.com/callback.php' );
    
    
    //twitter
    
    //hashtag
//     $HashTag = '写真詩';
    $result_type ='recent';
    $count =100;
    
    
?>