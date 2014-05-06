$(document).ready(function(){

 $('#login-button').click(login);

  $(document).keypress(function(e) {
    if(e.which == 13) {
        login();
    }
  });

function login()
{
  $.ajax({
      url : 'login.php',
      method : 'POST',
      data : { login : $('#login').val(), password : $('#password').val()},
      success : function(res)
      {
        res = jQuery.parseJSON(res);
        console.log(res);
        if (res.error)
        {
          console.log("error");
          $('.input').addClass("error");
        }
        else if (res.auth_token)
        {
          console.log("connected");
          location.reload();
        }
      }
    });
}
});
