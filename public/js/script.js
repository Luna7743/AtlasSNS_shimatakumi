
$('.menu-btn').click(function () {
  $(this).toggleClass('is-open');
  $(this).siblings('.nav-menu').toggleClass('is-open');
});

// 削除の確認
$('.delete-button').on('click', function () {
  return confirm('この投稿を削除してもよろしいですか・')
});

// 編集処理のモーダル
$(function () {
  //編集ボタン(class="js-modal-open")が押されたら発火
  $('.js-modal-open').on('click', function () {
    // モーダルの中身(class="js-modal")の表示
    $('.js-modal').fadeIn();
    // 押されたボタンから投稿内容を取得し変数へ格納
    var post = $(this).data('post');
    // 押されたボタンから投稿のidを取得し変数へ格納（どの投稿を編集するか特定するのに必要な為）
    var post_id = $(this).data('post_id');

    // 取得した投稿内容をモーダルの中身へ渡す
    $('.modal_post_content').val(post);
    // 取得した投稿のidをモーダルの中身へ渡す
    $('.modal_post_id').val(post_id);
    return false;
  });

  // 背景部分や閉じるボタン(js-modal-close)が押されたら発火
  $('.modal__bg').on('click', function () {
    // モーダルの中身(class="js-modal")を非表示
    $('.js-modal').fadeOut();
    return false;
  });
});

// ファイル選択のイベントリスナーを追加
$('#file_upload').on('change', function () {
  var fileName = this.files[0] ? this.files[0].name : '';
  $('#file_name').text(fileName);
});
