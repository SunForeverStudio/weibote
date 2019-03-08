<?php
include_once( './core/config.php' );
require_once("./core/tmhOAuth.php");

//除外リスト

$twObj = new tmhOauth(array(
    "curl_ssl_verifypeer" => false,
));

if(isset($_REQUEST['search']) &&!empty($_REQUEST['search']) ){
    
    
    $HashTag = $_REQUEST['search'];
    
    // exit;
    //search conditions
    $params = array(
        "q" => "#".$HashTag,
        "result_type" => "recent",
        'exclude'=>'retweets',
        'filter'=>'images',
        'count'=>100
    );
    
    $statuses=array();
    
    //最大300件取得
    for ($i = 0; $i < 1; $i++) {
        
        $code = $twObj->request( 'GET','https://api.twitter.com/1.1/search/tweets.json?',$params);
        
        if($code ==200){
            $tweets  = json_decode($twObj->response["response"], true);
            $headers = $twObj->response["headers"];
            $statuses = array_merge($statuses,$tweets['statuses']);
            //         var_dump($tweets);exit;
            // next_results が無ければ処理を終了
            if (!isset($tweets['search_metadata']['next_results'])) {
                break;
            }
            //リクエスト残数0の場合、15分リセット待ち
            if($headers['x-rate-limit-remaining']==0){
                //エラー処理追加
                
                break;
            }
            
            // 先頭の「?」を除去
            $next_results = preg_replace('/^\?/', '', $tweets['search_metadata']['next_results']);
            
            // パラメータに変換
            parse_str($next_results, $params);
        }
    }
    
}

?>