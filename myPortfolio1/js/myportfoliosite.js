$(function(){

  // スマホ用画面上部ハンバーガーメニュー
  /* $('.Toggle').click (function() {
    $(this).toggleClass('active');
    $('page_nav_small').toggleClass('open');
  }); */

  $('.Toggle').click (function() {
    $(this).toggleClass('active');
    // $('.page_nav_small').toggleClass('open');
    $('.page_nav_small').slideToggle();
  });

  // woksにおける職歴タイトルのクリックイベント
  $('.js_title_link').each(function(){
      $(this).on('click',function(){
          // 指定箇所押下で開閉
          $("+.job_sub",this).slideToggle();
          // アコーディオンメニュー開閉における+=切り替え
          if ($(this).children('span').text() == "＋") {
            $(this).children('span').text('－');
          }
          else {
            $(this).children('span').text('＋');
          }
          return false;
      });
  });

});
