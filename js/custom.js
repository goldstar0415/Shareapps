$(function () {
  $('body').delegate('#terms-form', 'submit', function (e) {
    e.preventDefault();
    var form = $(this);
    var temsOfservice = $(this).find('div.panel-body').html();
    var formaction =  $(this).attr("action");
    var token = $(this).find("input[name=_token]").val();

    $.ajax({
      type: "POST",
      url: formaction,
      data: {'_token': token, 'terms':temsOfservice},
      cache: false,
      success: function(data){
        form.find('.alert').css('display','block');
      }
    });
  });
  $('body').delegate('#privacy-form', 'submit', function (e) {
    e.preventDefault();
    var form = $(this);
    var privacypolicy = $(this).find('div.panel-body').html();
    var formaction =  $(this).attr("action");
    var token = $(this).find("input[name=_token]").val();

    $.ajax({
      type: "POST",
      url: formaction,
      data: {'_token': token, 'privacy':privacypolicy},
      cache: false,
      success: function(data){
        form.find('.alert').css('display','block');
      }
    });
  });
  $('body').delegate('#about-us-form', 'submit', function (e) {
    e.preventDefault();
    var form = $(this);
    var aboutus = $(this).find('div.panel-body').html();
    var formaction =  $(this).attr("action");
    var token = $(this).find("input[name=_token]").val();

    $.ajax({
      type: "POST",
      url: formaction,
      data: {'_token': token, 'aboutus':aboutus},
      cache: false,
      success: function(data){
        form.find('.alert').css('display','block');
      }
    });
  });

  $('.site-about-us-form-div-close-btn').on('click', function(){
    console.log('ddd');
    $('.login-register-formoverlay').css({visibility:'hidden',opacity:'0'})
  })

  $('.admin-mode-button').on('change', function(){
    var qqq = $('.admin-mode-button').val();
    console.log(qqq);
  })
});
