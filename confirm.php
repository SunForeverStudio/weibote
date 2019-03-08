<?php

// var_dump($_POST);
// exit;

//完了画面二重投稿対策
$_SESSION['reload'] = "reload";
$reload_off = $_SESSION['reload'];
?>


<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns#">
<!-- css -->
<link rel="stylesheet" href="./assets/css/style.css">

</head>
<body>

<!-- contents -->
<div id="wrap">
	<!-- main -->
	<main class="contsBox" id="mainConts">
	
		<!-- 確認 -->	
	    <!-- form開始 -->
		<form action="./comp.php" method="POST">
		<div class="box" id="Confirm">
			<h2 class="ttlH2">确认转发内容</h2>
			<div class="boxInner">
				<div class="readText">
					<p>没有问题的话请按转发</p>
				</div>


              <?php if(isset($_POST['screen_name_1'])&&!empty($_POST['screen_name_1'])):?>

				<div class="inner borderBox">
					<div class="ttlWrap">
						<div class="account">
							<figure><img src="<?php echo $_POST['img_1']; ?>" alt=""></figure>
							<div class="textWrap">
								<p class="name"><span class="userName"><?php echo $_POST['screen_name_1']; ?></span><small>さん</small></p>
								<p class="id"><span class="userID">@<?php echo $_POST['screen_name_1']; ?></span></p>
							</div>
						</div>
						<div class="icon">
							<figure><img src="./assets/img/twitter_icon.png" alt=""></figure>
						</div>
					</div>
					<div class="tweet">
						<div class="textWrap">
							<p class="hashTag"><?php //echo $_POST['hashtag'];?></p>
							<p class="text"><?php echo $_POST['text_1'];?></p>
					        <p class="url"><?php //echo $_POST['url'];?></p>
						</div>
						<figure><img src="<?php echo  $_POST['img_1'];?>" alt=""></figure>
						<div class="textWrap">
							<p class="date"><?php echo date("H:i");?> - <?php echo date("Y年m月d日");?></p>
						</div>
					</div>
				</div>

				<div><input type="hidden" name="screen_name_1" value ='<?php echo $_POST['screen_name_1']; ?>' /></div>
				<div><input type="hidden" name="text_1" value ='<?php echo $_POST['text_1'];?>' /></div>
				<div><input type="hidden" name="img_1" value ='<?php echo  $_POST['img_1'];?>' /></div>


              <?php endif;?>

              <?php if(isset($_POST['screen_name_2'])&&!empty($_POST['screen_name_2'])):?>

				<div class="inner borderBox">
					<div class="ttlWrap">
						<div class="account">
							<figure><img src="<?php echo $_POST['img_2']; ?>" alt=""></figure>
							<div class="textWrap">
								<p class="name"><span class="userName"><?php echo $_POST['screen_name_2']; ?></span><small>さん</small></p>
								<p class="id"><span class="userID">@<?php echo $_POST['screen_name_2']; ?></span></p>
							</div>
						</div>
						<div class="icon">
							<figure><img src="./assets/img/twitter_icon.png" alt=""></figure>
						</div>
					</div>
					<div class="tweet">
						<div class="textWrap">
							<p class="hashTag"><?php //echo $_POST['hashtag'];?></p>
							<p class="text"><?php echo $_POST['text_2'];?></p>
					        <p class="url"><?php //echo $_POST['url'];?></p>
						</div>
						<figure><img src="<?php echo  $_POST['img_2'];?>" alt=""></figure>
						<div class="textWrap">
							<p class="date"><?php echo date("H:i");?> - <?php echo date("Y年m月d日");?></p>
						</div>
					</div>
				</div>
				<div><input type="hidden" name="screen_name_2" value ='<?php echo $_POST['screen_name_2']; ?>' /></div>
				<div><input type="hidden" name="text_2" value ='<?php echo $_POST['text_2'];?>' /></div>
				<div><input type="hidden" name="img_2" value ='<?php echo  $_POST['img_2'];?>' /></div>


              <?php endif;?>

              <?php if(isset($_POST['screen_name_3'])&&!empty($_POST['screen_name_3'])):?>

				<div class="inner borderBox">
					<div class="ttlWrap">
						<div class="account">
							<figure><img src="<?php echo $_POST['img_3']; ?>" alt=""></figure>
							<div class="textWrap">
								<p class="name"><span class="userName"><?php echo $_POST['screen_name_3']; ?></span><small>さん</small></p>
								<p class="id"><span class="userID">@<?php echo $_POST['screen_name_3']; ?></span></p>
							</div>
						</div>
						<div class="icon">
							<figure><img src="./assets/img/twitter_icon.png" alt=""></figure>
						</div>
					</div>
					<div class="tweet">
						<div class="textWrap">
							<p class="hashTag"><?php //echo $_POST['hashtag'];?></p>
							<p class="text"><?php echo $_POST['text_3'];?></p>
					        <p class="url"><?php //echo $_POST['url'];?></p>
						</div>
						<figure><img src="<?php echo  $_POST['img_3'];?>" alt=""></figure>
						<div class="textWrap">
							<p class="date"><?php echo date("H:i");?> - <?php echo date("Y年m月d日");?></p>
						</div>
					</div>
				</div>
			    <div><input type="hidden" name="screen_name_3" value ='<?php echo $_POST['screen_name_3']; ?>' /></div>
				<div><input type="hidden" name="text_3" value ='<?php echo $_POST['text_3'];?>' /></div>
				<div><input type="hidden" name="img_3" value ='<?php echo  $_POST['img_3'];?>' /></div>


              <?php endif;?>

              <?php if(isset($_POST['screen_name_4'])&&!empty($_POST['screen_name_4'])):?>

				<div class="inner borderBox">
					<div class="ttlWrap">
						<div class="account">
							<figure><img src="<?php echo $_POST['img_4']; ?>" alt=""></figure>
							<div class="textWrap">
								<p class="name"><span class="userName"><?php echo $_POST['screen_name_4']; ?></span><small>さん</small></p>
								<p class="id"><span class="userID">@<?php echo $_POST['screen_name_4']; ?></span></p>
							</div>
						</div>
						<div class="icon">
							<figure><img src="./assets/img/twitter_icon.png" alt=""></figure>
						</div>
					</div>
					<div class="tweet">
						<div class="textWrap">
							<p class="hashTag"><?php //echo $_POST['hashtag'];?></p>
							<p class="text"><?php echo $_POST['text_4'];?></p>
					        <p class="url"><?php //echo $_POST['url'];?></p>
						</div>
						<figure><img src="<?php echo  $_POST['img_4'];?>" alt=""></figure>
						<div class="textWrap">
							<p class="date"><?php echo date("H:i");?> - <?php echo date("Y年m月d日");?></p>
						</div>
					</div>
				</div>

				<div><input type="hidden" name="screen_name_4" value ='<?php echo $_POST['screen_name_4']; ?>' /></div>
				<div><input type="hidden" name="text_4" value ='<?php echo $_POST['text_4'];?>' /></div>
				<div><input type="hidden" name="img_4" value ='<?php echo  $_POST['img_4'];?>' /></div>


              <?php endif;?>






				<div class="linkBtn" ontouchstart>
					<div class="btn"><button type='submit' name='action' value='send'>转发到微博</button></div>
				</div>
			</div>
		</div>	
		</form>
		
		
	</main>
</div>
<!-- jQuery -->
<script src="//code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
<!-- original js -->
<script src="./assets/js/config.js"></script>
</body>
</html>