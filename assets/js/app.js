$(function() {

    $(document).on('click', '.js-like', function() {
        // user_id, feed_id 取得できているか確認
        // $(this) 今のイベントを発動させた部品
        var feed_id = $(this).siblings('.feed-id').text();
        var user_id = $('#signin_user').text();
        var like_btn = $(this);
        var like_count = $(this).siblings('.like_count').text();


        console.log(feed_id);
        console.log(user_id);

        // ajaxで動作させてい処理を記述
        $.ajax({
          // {}の中は実行させたい処理 送信先、送信するデーターなどを記憶（目的の処理）
            url:'like.php', //実行したいプログラム
            type:'POST', //送信方法
            datatype: 'json', //受信してくるデータのタイプの形式
            data:{
              'feed_id':feed_id,
              'user_id':user_id,
              'is_liked':true
            }
        })
        .done(function(data){
          // 目的の処理が成功したときの処理
            if (data == 'true') {
                like_count++;
                like_btn.siblings('.like_count').text(like_count);
                like_btn.removeClass('js-like');
                like_btn.addClass('js-unlike');
                like_btn.children('span').text('いいねを取り消す');
            }

          // console.log(data);
        })
        .fail(function(err){
          // 目的の処理が失敗したときの処理
          console.log('error');
        })

    });

    $(document).on('click', '.js-unlike', function(){
        var feed_id = $(this).siblings('.feed-id').text();
        var user_id = $('#signin_user').text();
        var like_btn = $(this);
        var like_count = $(this).siblings('.like_count').text();

        console.log(feed_id);
        console.log(user_id);

      $.ajax({
          url: 'like.php',
          type:'POST',
          datatype: 'json',
          data:{
            'feed_id':feed_id,
            'user_id':user_id,
          }

      })
      .done(function(data){
          if (data == 'true') {
              like_count--;
              like_btn.siblings('.like_count').text(like_count);
              like_btn.removeClass('js-unlike');
              like_btn.addClass('js-like');
              like_btn.children('span').text('いいね');


          }
          // console.log(data);


      })
      .fail(function(err){

      })

    });

});
