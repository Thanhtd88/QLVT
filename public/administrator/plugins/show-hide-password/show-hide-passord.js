$(function(){
  $("#show_hide_current_password span").on('click', function(event) {
    event.preventDefault();
    if($('#show_hide_current_password input').attr("type") == "text"){
      $('#show_hide_current_password input').attr('type', 'password');
      $('#show_hide_current_password i').addClass( "fa-eye-slash" );
      $('#show_hide_current_password i').removeClass( "fa-eye" );
    }else if($('#show_hide_current_password input').attr("type") == "password"){
      $('#show_hide_current_password input').attr('type', 'text');
      $('#show_hide_current_password i').removeClass( "fa-eye-slash" );
      $('#show_hide_current_password i').addClass( "fa-eye" );
    }
  });
  $("#show_hide_password span").on('click', function(event) {
    event.preventDefault();
    if($('#show_hide_password input').attr("type") == "text"){
      $('#show_hide_password input').attr('type', 'password');
      $('#show_hide_password i').addClass( "fa-eye-slash" );
      $('#show_hide_password i').removeClass( "fa-eye" );
    }else if($('#show_hide_password input').attr("type") == "password"){
      $('#show_hide_password input').attr('type', 'text');
      $('#show_hide_password i').removeClass( "fa-eye-slash" );
      $('#show_hide_password i').addClass( "fa-eye" );
    }
  });
  $("#show_hide_password_confirmation span").on('click', function(event) {
    event.preventDefault();
    if($('#show_hide_password_confirmation input').attr("type") == "text"){
      $('#show_hide_password_confirmation input').attr('type', 'password');
      $('#show_hide_password_confirmation i').addClass( "fa-eye-slash" );
      $('#show_hide_password_confirmation i').removeClass( "fa-eye" );
    }else if($('#show_hide_password_confirmation input').attr("type") == "password"){
      $('#show_hide_password_confirmation input').attr('type', 'text');
      $('#show_hide_password_confirmation i').removeClass( "fa-eye-slash" );
      $('#show_hide_password_confirmation i').addClass( "fa-eye" );
    }
  });
})