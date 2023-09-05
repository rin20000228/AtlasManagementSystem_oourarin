$(function () {
  //キャンセルのモーダル
  //予約日・時間・確認文言・閉じるボタン・キャンセルボタン表示
  $('.modal-cancel').on('click', function () {
    $('.js-modal-cancel').fadeIn();
    //日付
    var setting_reserve = $(this).attr('setting_reserve');
    var hide_setting_reserve = $(this).attr('setting_reserve');

    //部数
    var reservePart = $(this).attr('part');
    var setting_part = $(this).attr('part-int');
    //定義する
    $('.modal-reserve input').val(setting_reserve);
    $('.modal-reserve input').val(hide_setting_reserve);
    $('.modal-reserve-part input').val(reservePart);
    $('.modal-reserve-part input').val(setting_part);

    return false;
  });
  //閉じるボタン
  $('.js-modal-close').on('click', function () {
    $('.js-modal-cancel').fadeOut();
    return false;
  });

});
