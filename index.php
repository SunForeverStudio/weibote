    <?php
session_start();
require_once("./core/getAccess.php");
require_once("./core/getUserInfo.php");

include_once( './core/config.php' );
include_once( './core/saetv2.ex.class.php' );

$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );

$code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );


if(isset($_SESSION['token'])){
    //ユーザ情報取得
    $c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
    $uid_get = $c->get_uid();
    $uid = $uid_get['uid'];
    $user_message = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息
    
    
}



?>
<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns#">
<!-- meta -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="description" content="">
<meta name="keywords" content="">

<title>自动发微博小程序</title>

<!-- Mobile -->
<meta name="viewport" content="width=device-width, user-scalable=no">
<link rel="apple-touch-icon-precomposed" href="">

<!-- OGP -->
<meta property="og:title" content="">
<meta property="og:description" content="">
<meta property="og:image" content="">
<meta property="og:url" content="">
<meta property="og:type" content="website">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="" />
<meta name="twitter:description" content="" />
<meta name="twitter:image:src" content="">

<!-- css -->
<link rel="stylesheet" href="./assets/css/style.css">

</head>
<body>
<!-- header --><!--
<header>
	<div id="gNavi">
		<div id="gNaviBtnWrap">
			<p class="ttl">MENU</p>
			<div id="gNaviBtn">
				<div class="btnIcon"></div>
			</div>
		</div>
		<div id="gNaviList">
			<ul>
				<li><a href="#Overview">キャンペーン概要</a></li>
				<li><a href="#EntryList">最終フレーバー候補一覧</a></li>
				<li><a href="#EntryForm">投稿フォーム</a></li>
				<li><a href="#Requirement">応募事項</a></li>
			</ul>
		</div>
	</div>
	<figure class="logo"><img src="./assets/img/logo.png" alt=""></figure>
</header>
-->
<!-- contents -->
<div id="wrap">
	<!-- main -->
	<main class="contsBox" id="mainConts">
		
		<div class="box" id="Entry">
			<h2 class="ttlH2">キャンペーン<br class="hiddenPC">応募フォーム</h2>
			<?php if(isset($_SESSION['token']) && !empty($_SESSION['token'])) : ?>
				<div class="boxInner flowChart logIn">
			<?php else : ?>
			<div class="boxInner flowChart logOut">
			<?php endif; ?>
			
				<div class="inner flow One">
					<div class="flowInner">
					<!--
						<div class="ttlWrap">
							<span class="num">1</span>
							<h3 class="ttlH3">ネスレ会員・Twitterへログイン</h3>
						</div>
						<!-- 
						<div class="readText">
							<p>キャンペーンの応募にはネスレ会員とTwitter、両方へのログインが必要です。<br>
							ネスレ会員登録・Twitterアカウント登録がまだの方は、それぞれ登録をお願いいたします。</p>
						</div>
						 -->
						<div class="borderBoxWrap">
                            
							<div class="borderBox cloumn User">
								<h4 class="borderBoxTtl">WEIBO</h4>
								<?php if(!isset($_SESSION['token']) || empty($_SESSION['token'])) : ?>
								<div class="">
									<div class="linkBtn login" ontouchstart>
										<div class="btn"><a href="<?=$code_url?>" class="defultOff">登    录<i class="material-icons blank">launch</i></a></div>
									</div>
									<div class="textWrap">
										<p>注册微博账号<br></p>
									</div>
									<div class="linkBtn entry" ontouchstart>
										<div class="btn"><a href="https://twitter.com/i/flow/signup" class="defultOff">注     册<i class="material-icons blank">launch</i></a></div>
									</div>
								</div>
								<?php else:	?>
								<div class="">
									<div class="stateWrap">
										<p class="state"><i class="material-icons check">check_circle</i>登陆成功</p>
									</div>
									<div class="borderBoxInner">
										<figure><img src="<?php echo $user_message["profile_image_url"]; ?>" alt=""></figure>
										<div class="textWrap">
											<p class="name"><span class="userName"><?php echo $user_message['screen_name']; ?></span><small>さん</small></p>
											<p class="id"><span class="userID">@<?php echo $user_message['screen_name']; ?></span></p>
											<p class="follower"><small>粉 丝</small><br>
											<span class="followerText"><span class="followerVal"><?php echo $user_message['followers_count']; ?></span><small>人</small></span></p>
										</div>
									</div>
								</div>
								<?php endif	;?>					
							</div>
						</div>
						 
						<?php if(isset($_SESSION['token'])&& !empty($_SESSION['token'])) : ?>
						

						<div class="encloseBox" align="center">
								 <form action="./index.php" method="GET">
                        		  <input type="search" name="search" placeholder="输入关键字">
                                  <input type="submit" name="submit" value="搜 索">
                        		</form>
  
						</div>

						<?php endif	;?>	
					    
						<?php include_once( './index_result.php' );?>	

					</div>
				</div>
				
				<!-- 
				<div class="inner flow Two" id="EntryList">
					<div class="flowInner">
						<div class="ttlWrap">
							<span class="num">2</span>
							<h3 class="ttlH3">最終候補に残ったフレーバーから<br class="hiddenSP">商品化されると思う新フレーバーを予想</h3>
						</div>
						<div class="readText">
							<p>下記の候補の中から、1種類だけ選択してください。</p>
						</div>
						<div class="errorMessage">
							<p><i class="material-icons error">info</i>ネスレ会員またはTwitterアカウントにログインしていないため、選択できません。</p>
						</div>
						<ul class="flavorList">
                        <!-- フレーバー-->
                        <?php //foreach ($selectCategoryResult as $key => $val) : ?>

						 <!--	<li>
								<figure>
									<span class="imgWrap">
										<span class="choiceIcon circle"></span>
										<span class="img"><img src="<?php //echo $val['image_path']; ?>" alt="<?php //echo $val['id']; ?>"></span>
									</span>
									<figcaption><?php//echo $val['category_name']; ?></figcaption>
								</figure>
							</li>
						<?php //endforeach; ?>
						</ul>
					</div>
					<div class="linkBtn" ontouchstart>
						<div class="btn"><a href="#EntryForm" target="_blank" class="anchor defultOff">この内容入力へ進む</a></div>
					</div>
				</div>
				
				 -->
				<!--
				<div class="inner flow Three" id="EntryForm">
					<div class="flowInner">
						<div class="ttlWrap">
							<span class="num">3</span>
							<h3 class="ttlH3">選択したフレーバーを予想した理由と、ハッシュタグ<br class="hiddenSP"><strong class="hashTag">#キットカット世界総選挙で商品化されるのは</strong>を添えてツイート！</h3>
						</div>
						<div class="readText">
							<p>「たぶんこの無難な味なんじゃない？」などのガチな予想以外にも「絶対このフレーバー食べたい！」「これ実現したらめっちゃ買うのに…」といった内容の予想もOKです。</p>
						</div>
						<div class="innerInner">	
							<div class="errorMessage" >
								<p><i class="material-icons error">info</i><label id = 'errorMessage'>ネスレ会員またはTwitterアカウントにログインしていないため、選択できません。</label></p>								
							</div>
					<input type="hidden" name ='DBhashtag'  value="<?php// echo isset($hashTag)?$hashTag:'';?>" />
				 	<input type="hidden" name ='twiceFlg' value="<?php //echo isset($twiceFlg)?$twiceFlg:'';?>" />
					<input type="hidden" name ='imgPath' value="<?php //echo isset($_SESSION['imgPath'] )&&!empty($_SESSION['imgPath'] )? $_SESSION['imgPath'] :''; ?>" />
					<input type="hidden" name ='category_id' value="<?php //echo isset($_SESSION['category_id'] )&&!empty($_SESSION['category_id'] )? $_SESSION['category_id'] :''; ?>" />						
							
							<div class="encloseBox">
							<?php// if(!isset($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token'])) : ?>
								<div class="cloumn User">
									<figure><img src="./assets/img/twitter_user_img.png" alt=""></figure>
									<div class="textWrap">
										<p class="name"><span class="userName">ゲスト</span><small>さん</small></p>
										<p class="id"><span class="userID"></span></p>
									</div>
								</div>
							<?php //else: ?>
								<div class="cloumn User">
									<figure><img src="<?php// echo $userInfoData['profile_image_url']; ?>" alt=""></figure>
									<div class="textWrap">
										<p class="name"><span class="userName"><?php //echo $userInfoData['name']; ?></span><small>さん</small></p>
										<p class="id"><span class="userID">@<?php //echo $userInfoData['screen_name']; ?></span></p>
									</div>
								</div>
                             <?php// endif;?>	
								<div class="cloumn Tweet">
										<div class="balloonBox">
											<div class="textWrap">
												<textarea name="hashtag" class="hashtag"><?php //echo isset($_SESSION['hashtag'] )&&!empty($_SESSION['hashtag'] )? $_SESSION['hashtag'] :$hashTag.' #'; ?></textarea>
												<textarea name="tweet" placeholder="こちらに選択したフレーバーを予想した理由を入力してください。"><?php echo isset($_SESSION['tweet'] )&&!empty($_SESSION['tweet'] )? $_SESSION['tweet'] :''; ?></textarea>
												<textarea name="url" class="url">http://nestle.jp/voc/voice/</textarea>
											</div>
										</div>
									<ul class="note">
										<li>※本キャンペーンのハッシュタグと、一番下に記載しているURLは変更できません。
										ただし、ハッシュタグの追加は可能です。</li>
										<!-- <li>※VOICE投稿には最低50字以上の文字数が必要です。</li> -->
								<!--	</ul>
								</div>
							</div>	
							<div class="linkBtn" ontouchstart>
								<div class="btn"><button type='submit' name='action' value='send'>ツイート内容確認画面へ</button></div>
							</div>							
						</div>
					</div>
				</div>
				 -->
			</div>
		</div>
	</main>
	

	
	
	
	
	
<!-- jQuery -->
<script src="//code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
<!-- original js -->
<script src="./assets/js/config.js"></script>
</body>
</html>