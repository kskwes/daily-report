// モーダルが複数ある場合
$(function () {
    // モーダルのボタンをクリックした時
    $('.modal_trigger .modal_btn').on('click', function() {
        var btnIndex = $(this).index(); // 何番目のモーダルボタンかを取得
        $('.modal_area .modal_box').eq(btnIndex).fadeIn(); // クリックしたモーダルボタンと同じ番目のモーダルを表示する
    });

    // ×やモーダルの背景をクリックした時
    $('.modal_close , .modal_bg').click(function(){
        $('.modal_box').fadeOut(); // モーダルを非表示にする
    });
});