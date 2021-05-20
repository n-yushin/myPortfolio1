$(function(){

  $('.js_title_link').each(function(){
      $(this).on('click',function(){
          $("+.job_sub",this).slideToggle();
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
