$(function(){
  $('.tab-section').hide();

  $('#header a').bind('click', function(e){
    $('#header a.current').removeClass('current');
    $('.tab-section:visible').hide();

    $(this.hash).show();
    $(this).addClass('current');
    e.preventDefault();
  }).filter(':first').click();

  $("#header ul a").click(function() {
    $('#home').hide();
      window.location = $(this).attr('href');
      return false;
   });

});