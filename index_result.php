<?php
require_once("./core/getHashTweet.php");
?>

<!-- contents -->
<div id="wrap">
	<!-- main -->
	<main class="contsBox" id="mainConts">
	<form name ='confirm'　id='confirm' action="./confirm.php" method="POST">
		<div class="box" id="Confirm">
<!--		
		<form action="./index.php" method="post">
		  <center><input type="search" name="search" placeholder="キーワードを入力"></center>
          <center><input type="submit" name="submit" value="検索"></center>
		</form>
	-->	
<?php if(!empty($statuses)) : ?>
		
			<h2 class="ttlH2">#<?php echo$HashTag?></h2>
			<div class="boxInner">
				<div class="readText">
					<p>	<?php echo '发起请求数：'.$headers['x-rate-limit-remaining'].'<br>' ?></p>
					
				</div>
				<!--
				<div class="linkBtn" ontouchstart>
					<div class="btn"><button type="button" name='action' value=''  onClick="window.open('./csv_create_download.php')">レポート出力</button></div>
				</div>
				-->
				<?php $count =0 ?>
				<?php foreach ($statuses as $key=>$value) : ?>
				     <?php $count++ ?>
				     
				    <!--画像があるツィーターだけ画面上に表示 -->
			        <?php if (!isset($value["entities"]['media'])) :  ?>
			            <?php $count-- ?>
			            <?php continue ?>
			        <?php endif; ?>
				
			        <!--除外リスト -->
        			<?php if(isset($value["entities"]['media'][0]['media_url'])&&in_array($value["entities"]['media'][0]['media_url'], $blacklist,true)) : ?>
        			
        			    <?php $count-- ?>
        			    <?php continue ?>
        			
        			<?php endif; ?>
				

				<?php if($count<=6) : ?>
				<div class="inner borderBox" id = "<?php echo  $count ?>"　style="display: block;">
					<div class="ttlWrap">
						<div class="account">
							<figure><img src="<?php echo $value['user']['profile_image_url']; ?>" alt=""></figure>
							<div class="textWrap">
								<p class="name"><span class="userName"><?php echo $value['user']['name']; ?></span><small>さん</small></p>
								<p class="id"><span class="userID">@<?php echo $value['user']['screen_name']; ?></span></p>
							</div>
						</div>
						<div class="icon">
							<figure><img src="./assets/img/twitter_icon.png" alt=""></figure>
						</div>
					</div>
					<div class="tweet">
						<div class="textWrap">
							<p class="hashTag"><?php echo '';?></p>
							<p class="text"><?php echo $value['text'];?></p>
					        
						</div>
						<?php if (isset($value["entities"]['media'])){  ?>
						<figure><img src="<?php echo  $value["entities"]['media'][0]['media_url'];?>" alt=""></figure>

						<?php }?>
						<div class="textWrap">
							<p class="date"><?php echo date("Y-m-d H:i:s", (strtotime($value["created_at"])+25200));?></p>
						</div>
					</div>
	                    <input type="checkbox" name="checkbox" value="<?php echo  $count ?>">
				</div>
				<!--他の画像を非表示 -->
				<?php else : ?>
					<div class="inner borderBox " id = "<?php echo  $count ?>"  style="display: none;">
					<div class="ttlWrap">
						<div class="account">
							<figure><img src="<?php echo $value['user']['profile_image_url']; ?>" alt=""></figure>
							<div class="textWrap">
								<p class="name"><span class="userName"><?php echo $value['user']['name']; ?></span><small>さん</small></p>
								<p class="id"><span class="userID">@<?php echo $value['user']['screen_name']; ?></span></p>
							</div>
						</div>
						<div class="icon">
							<figure><img src="./assets/img/twitter_icon.png" alt=""></figure>
						</div>
					</div>
					<div class="tweet">
						<div class="textWrap">
							<p class="hashTag"><?php echo '';?></p>
							<p class="text"><?php echo $value['text'];?></p>
					        
						</div>
						<?php if (isset($value["entities"]['media'])){  ?>
						<figure><img src="<?php echo  $value["entities"]['media'][0]['media_url'];?>" alt=""></figure>

						<?php }?>
						<div class="textWrap">
							<p class="date"><?php echo date("Y-m-d H:i:s", (strtotime($value["created_at"])+32400));?></p>
						</div>
					</div>
	                 <input type="checkbox" name="checkbox" value="<?php echo  $count ?>">
				</div>
				
				<?php endif; ?>
				<?php endforeach; ?>
				<center><?php echo $count ?></center>
				<div class="linkBtn" ontouchstart>
					<div class="btn"><button type="button" name='action' value='send' id = 'moreButton'>  more  </button></div>
				</div>
				<div><input type="hidden" name="screen_name_1" value ='' /></div>
				<div><input type="hidden" name="text_1" value ='' /></div>
				<div><input type="hidden" name="img_1" value ='' /></div>

				<div><input type="hidden" name="screen_name_2" value ='' /></div>
				<div><input type="hidden" name="text_2" value ='' /></div>
				<div><input type="hidden" name="img_2" value ='' /></div>

				<div><input type="hidden" name="screen_name_3" value ='' /></div>
				<div><input type="hidden" name="text_3" value ='' /></div>
				<div><input type="hidden" name="img_3" value ='' /></div>

				<div><input type="hidden" name="screen_name_4" value ='' /></div>
				<div><input type="hidden" name="text_4" value ='' /></div>
				<div><input type="hidden" name="img_4" value ='' /></div>





				<div class="linkBtn" ontouchstart>
					<div class="btn"><button type='submit' name='action' value='send' id = 'sendButton'>确认</button></div>
				</div>
				
			</div>
			
			<?php else: ?>
			<center>没有搜索结果</center>
			<?php endif; ?>
		</div>	


	<!-- form閉じる-->							
    </form>
		
	</main>
</div>
<!-- jQuery -->
<script src="//code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
<!-- original js -->
<script src="./assets/js/config.js"></script>


<script >
$(function () {
	/*もっとみる機能：
	 *画像<=6 style="display: block;"
	 *画像>6 style="display: none;"
	 *https://qiita.com/gogonosmarty/items/e79bef3afe13c10d5f7a
	 */

	//カウンタの初期値を設定
	var countUpValue = 0;
	
    $('#moreButton').click(function () {
    	//カウンタに 1 を加算
    	countUpValue++;
//     	alert(6*(countUpValue+1));
    	for(var i=6*countUpValue+1;i<6*(countUpValue+1)+1;i++){        	
        	document.getElementById(String(i)).style.display="block";
    	}	
    });



    //
    $('#sendButton').click(function () {
  	  var flag = false;

	  // elements にはボタンの要素も含まれてしまうため -1 しています
	  var j = 0;
	  for (var i = 0; i < document.confirm.elements.length - 1; i++) {
	    if (document.confirm.elements[i].checked) {
	      flag = true;
	      j++;

	      if(j==5){
	      	alert('最大4個選択可能です。');
	      	return false;

	      }
	      // alert(document.confirm.elements[i].value + "が選択されました。");

          // 表示
          var text = $("#"+document.confirm.elements[i].value).find('.tweet .textWrap .text').html();

          var imgPath = $("#"+document.confirm.elements[i].value).find('.tweet').find('figure').children('img').attr('src');

          var screen_name = $("#"+document.confirm.elements[i].value).find('.ttlWrap .account .textWrap .id .userID').html();

          $("input:hidden[name='text_"+String(j)+"']").val(text);
          $("input:hidden[name='img_"+String(j)+"']").val(imgPath);
          $("input:hidden[name='screen_name_"+String(j)+"']").val(screen_name);

          
	      
	    }


	  }

	  if (!flag) {
	    alert("項目が選択されていません。");

	    return false;
	  }	
    });



    
});
</script>