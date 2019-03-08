<?php
/*
 * 共通：ユーザ情報取得
 */
require_once("./core/tmhOAuth.php");

if(isset($_SESSION['access_token']['oauth_token'])&& !empty($_SESSION['access_token']['oauth_token'])){
        $twObj = new tmhOauth(array(
            "token" => $_SESSION['access_token']['oauth_token'],
            "secret" => $_SESSION['access_token']['oauth_token_secret'],
            "curl_ssl_verifypeer" => false,
        ));
        
        //ユーザ情報取得
        $code = $twObj->request( 'GET','https://api.twitter.com/1.1/users/show.json?',array("user_id" => $_SESSION['access_token']['user_id']));
        $userInfoData  = json_decode($twObj->response["response"], true);
               
        if(isset($userInfoData['errors']) && $userInfoData['errors'] != ''){
            
//             echo "接続できませんでした";//エラーメッセージ
        }else{
//             $iTweetId =                 $userInfoData['id'];
//             $sIdStr =                   (string)$userInfoData['id_str'];
//             $sName=                     $userInfoData['name'];
//             $sScreenName=               $userInfoData['screen_name'];
//             $sProfileImageUrl =         $userInfoData['profile_image_url'];
//             $followers_count = $userInfoData['followers_count'];
           
            //orginal画像取得
            $userInfoData['profile_image_url'] = preg_match('/_normal/',$userInfoData['profile_image_url'])? str_replace('_normal', '',  $userInfoData['profile_image_url']):$userInfoData['profile_image_url'];
                        
            //ポイント計算: y = 0.2801941891 * x 0.7576611611
//             $point =(int)(pow($userInfoData['followers_count'], 0.7576611611) *0.2801941891);
            $point =(int)(pow(223873, 0.7576611611) *0.2801941891);
        }    
}

?>