$(function(){

    // いいねボタンのクリック
    $(document).on('click', '.js-like', function() {
        let diaryId = $(this).siblings('.diary-id').val();
        let $clickedBtn = $(this);
        // console.log(diaryId);
        // console.log($clickedBtn);

        // like 関数を実行
        like(diaryId, $clickedBtn);
    });

    // like 関数を作成
    function like(diaryId, $clickedBtn) {
        $.ajax({
            url: 'diary/' + diaryId + '/like',
            type: 'POST',
            dataType: 'json',
            // LaravelではCSRF対策として、tokenを送信しないとエラーが発生します。
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        })
        .then(
            function(data) {
                changeLikeBtn($clickedBtn);
                // いいねの数を1増やす
                let num = Number($clickedBtn.siblings('.js-like-num').text());
                $clickedBtn.siblings('.js-like-num').text(num + 1);
            },
            function() {
                console.log('なんでやねん');
                console.log(error);
            }
        )
    }



    // いいね, いいね解除でボタンの色を変更、
    // js-like, js-dislikeでいいね, いいね解除の切り替えをしてるためクラスの付け替え
    function changeLikeBtn(btn) {
        btn.toggleClass('far').toggleClass('fas');
        btn.toggleClass('js-like').toggleClass('js-dislike');
    }
})