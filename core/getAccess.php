<?php
/*
 * キャンペーン画面：access_tokenを取得、ユーザ確定処理
 */
require_once("./core/tmhOAuth.php");
 // access_token取得
if(isset($_GET['oauth_verifier'])&&!empty($_GET['oauth_verifier'])){
    $twObj = new tmhOauth(array(
        "token" => $_SESSION['request_token']['oauth_token'],
        "secret" => $_SESSION['request_token']['oauth_token_secret'],
        "curl_ssl_verifypeer" => false,
    ));
    $code = $twObj->request('POST', $twObj->url('oauth/access_token', false), array(
        'oauth_verifier' => $_GET['oauth_verifier']
    ));
    
    if ($code == 200) {
        //access_token,user_id,screen_name
        $_SESSION['access_token'] = $twObj->extract_params($twObj->response["response"]); 
    }
    
}

?>