<?php

session_start();

include_once( './core/config.php' );
include_once( './core/saetv2.ex.class.php' );

$statuses =array();
if(isset($_POST['screen_name_1'])&&!empty($_POST['screen_name_1'])){

   $statuses[0] = array(
                        'screen_name'=>$_POST['screen_name_1'],
                        'text'=>$_POST['text_1'],
                        'img' =>$_POST['img_1']
                          ); 
}
if(isset($_POST['screen_name_2'])&&!empty($_POST['screen_name_2'])){

   $statuses[1] = array(
                        'screen_name'=>$_POST['screen_name_2'],
                        'text'=>$_POST['text_2'],
                        'img' =>$_POST['img_2']
                          ); 
}

if(isset($_POST['screen_name_3'])&&!empty($_POST['screen_name_3'])){

   $statuses[2] = array(
                        'screen_name'=>$_POST['screen_name_3'],
                        'text'=>$_POST['text_3'],
                        'img' =>$_POST['img_3']
                          ); 
}

if(isset($_POST['screen_name_4'])&&!empty($_POST['screen_name_4'])){

   $statuses[3] = array(
                        'screen_name'=>$_POST['screen_name_4'],
                        'text'=>$_POST['text_4'],
                        'img' =>$_POST['img_4']
                          ); 
}



//ユーザ情報取得
$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );


$count = 0;
foreach ($statuses as $key=>$value){
    $count++;
           
    if( isset($value) && !empty($value)) {
        
        $text = explode("#", $value['text']);
                     
        // 注意至少要带上一个链接。
        $ret = $c->share( urlencode("hello ")."https://weibote.herokuapp.com/",$value['img'] );	//发送微博
    
    
        if ( isset($ret['error_code']) && $ret['error_code'] > 0 ) {
            $errorMessage = $ret['error_code'];
        }

        // sleep($count*60)
    }

    
    
}
?>



<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns#">
<!-- meta -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="description" content="">

<title></title>

<!-- css -->
<link rel="stylesheet" href="./assets/css/style.css">

</head>
<body>
<!-- contents -->
<div id="wrap">
	<!-- main -->
	<main class="contsBox" id="mainConts">
		<!-- firstView -->
		
		<!-- 確認 -->
		<div class="box" id="Comp">
			<div class="boxInner">
				<div class="inner borderBox">
					<div class="readText">
						<p><?php echo isset($errorMessage)?$errorMessage:'发送成功' ?></p>
					</div>
				</div>
				<div class="linkBtn" ontouchstart>
					<div class="btn"><a href="./index.php" class="defultOff">回到首页</a></div>
				</div>
			</div>
		</div>
	</main>
</div>

<!-- jQuery -->
<script src="//code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
<!-- original js -->
<script src="./assets/js/config.js"></script>
</body>
</html>