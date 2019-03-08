(function($){
    'use strict';
    /*==========================================================================
    / ユーザーエージェント
    /==========================================================================*/
    var ua = (function(u) {
        return {
            WinTablet:(u.indexOf("windows") != -1 && u.indexOf("touch") != -1),
            Tablet:u.indexOf("ipad") != -1
              || (u.indexOf("android") != -1 && u.indexOf("mobile") == -1)
              || (u.indexOf("firefox") != -1 && u.indexOf("tablet") != -1)
              || u.indexOf("kindle") != -1
              || u.indexOf("silk") != -1
              || u.indexOf("playbook") != -1,
            Mobile:(u.indexOf("windows") != -1 && u.indexOf("phone") != -1)
              || u.indexOf("iphone") != -1
              || u.indexOf("ipod") != -1
              || (u.indexOf("android") != -1 && u.indexOf("mobile") != -1)
              || (u.indexOf("firefox") != -1 && u.indexOf("mobile") != -1)
              || u.indexOf("blackberry") != -1
        }
    })(window.navigator.userAgent.toLowerCase());
    if (ua.Mobile) {
        // モバイル
        var uaNum = 2;
    } else if (ua.Tablet) {
        // タブレット
        var uaNum = 1;
    } else if(ua.WinTablet) {
        // winタブレット
        if((typeof window.orientation) === 'undefined'){
            var uaNum = 1;
        }
    } else {
        // 上記以外
        var uaNum = 0;
    }

    /*==========================================================================
    / グローバル変数
    /==========================================================================*/
    var $window = $(window),
        $document = $(document),
        click = 'click',
        load = 'load',
        resize = ''+load+' resize',
        scroll = ''+load+' scroll';

    /*==========================================================================
    / 処理
    /==========================================================================*/
    $(function() {
        globalNavi();
        itemSelect();
        scrollBtn();
        footerNavi();
        anchorLink();
    });

    /*==========================================================================
    / 関数
    /==========================================================================*/
    // グローバルナビ
    function globalNavi() {
        $.easing.quart = function(x, t, b, c, d) {
            return -c * ((t = t / d - 1) * t * t * t - 1) + b;
        };
        $document.on(click,'#gNaviBtn',function(){
            $('#gNavi').addClass('active');
            $('body').addClass('scrollFixed');
        });
        $document.on(click,'#gNavi.active #gNaviBtn',function(){
            $('#gNavi').removeClass('active');
            $('body').removeClass('scrollFixed');
        });
        $document.on(click,'#gNavi.active #gNaviList li a[href^="#"]',function(){
            var href= $(this).attr('href');
            var target = $(href == "#" || href == "" ? 'html' : href);
            var position = target.offset().top;
            $('#gNavi').removeClass('active');
            $('body').removeClass('scrollFixed');
            $('html, body').animate({
                scrollTop:position
            }, 400);
            return false;
        });
    }
    // アイテム選択
    function itemSelect() {
        $document.on(click,'.flavorList li',function(){
            $('.flavorList li').find('.imgWrap .choiceIcon,.imgWrap .img').removeClass('check').addClass('circle');
            $(this).find('.imgWrap .choiceIcon,.imgWrap .img').removeClass('circle').addClass('check');
     //選択された画像を取得
             $('input:hidden[name="imgPath"]').val($(this).find('.imgWrap .choiceIcon,.imgWrap .img').children('img').attr('src'));
             //選択されたフレーバーIDを取得
             $('input:hidden[name="category_id"]').val($(this).find('.imgWrap .choiceIcon,.imgWrap .img').children('img').attr('alt'));
             
             //ハッシュタグ設定
             $('textarea[name="hashtag"]').val($('input:hidden[name="DBhashtag"]').val()+' #'+$(this).find('figcaption').html());
        });
    }
//ネスレログイン後画面リロード
    $(function(){
    	//遷移元はネスレログイン画面の場合リロードする
    	
    	var refUrl = document.referrer;

    	if(refUrl.indexOf('login.php') != -1 && refUrl.indexOf('voc/voice') != -1){    
    		if (window.name != "xyz"){
    		    location.reload();
    		    window.name = "xyz";
    		}
    	}
    });
  
    //投稿回数制限
    $(function(){
	  if($('input:hidden[name="twiceFlg"]').val() !==''){
    	
		  $('#EntryForm').addClass('formError');
	      $('#errorMessage').html('ツイート参加はお一人様一回までになります。');
	      $('textarea[name="tweet"]').css('color','#ccc');
	  }else{
		  
	    //textareaをclickすると、エラー解消、フレーバー選択すると、エラー解消　⇒　入力、送信状態に戻る
    	$('textarea[name="tweet"]').on('click',function(){
    		$('#EntryForm').removeClass('formError');   		  
    	  });
    	 $document.on(click,'.flavorList li',function(){
     		$('#EntryForm').removeClass('formError');   		  
   	  });
	  }
    });
    
    
  //文字数チェック 、フレーバー選択チェック 
    $(function(){
  	  $('#confirm').submit(function(){
  	   var tweet = $('textarea[name="tweet"]').val();
  	   

  	  if($('input:hidden[name="imgPath"]').val()==''){  
  		   
   		  $('#EntryForm').addClass('formError');
  	      $('#errorMessage').html('フレーバーを選択してください。');
  	      
	  	    return false;
  	   }else if(tweet.length > 100 ){
  		   
 	  	  $('#EntryForm').addClass('formError');
	      $('#errorMessage').html('文字数の合計が140文字を超えています。');	
	      
	      return false;
  	   }else{
  		    return true;
  	   };
  	  });
  	 });
    // フッターナビ
    function footerNavi() {
        $document.on(click,'.footerNaviBtn.close',function(){
            $(this).toggleClass('close open');
            $('.footerNaviBtn .material-icons.menu').hide();
            $('.footerNaviBtn .material-icons.clear').show();
            $('.footerNaviList').slideDown(400);
        });
        $document.on(click,'.footerNaviBtn.open,.footerNaviList li',function(){
            $(this).toggleClass('close open');
            $('.footerNaviBtn .material-icons.clear').hide();
            $('.footerNaviBtn .material-icons.menu').show();
            $('.footerNaviList').slideUp(400);
        });
    }
    // アンカーリンク
    function anchorLink() {
        $('a.anchor[href^="#"]').on('click', function() {
            var href= $(this).attr('href'),
                target = $(href == "#" || href == "" ? 'html' : href),
                position = target.offset().top;
            $('html, body').animate({
                scrollTop:position
            }, 400);
            return false;
        });
    }
    // スクロールボタン
    function scrollBtn() {
        if(uaNum >= 1) {
            var $setElem = $('#Entry .flavorList'),
                $clearElem = $('#Entry .flow.Three'),
                effectH = 0,
                winH = $window.outerHeight();
            $window.on(scroll ,function() {
                var scTop = $(this).scrollTop(),
                    scBottom = scTop + $(this).height(),
                    effectPos = scBottom + effectH;
                $setElem.each( function() {
                    var thisPos = $(this).offset().top;
                    if ( thisPos < effectPos ) {
                        $('.flow.Two .linkBtn').show();
                    } else {
                        $('.flow.Two .linkBtn').hide();
                    }
                });
                $clearElem.each( function() {
                    var thisPos = $(this).offset().top;
                    if ( thisPos < effectPos ) {
                        $('.flow.Two .linkBtn').hide();
                    }
                });
            });
        }
    }
})(jQuery);