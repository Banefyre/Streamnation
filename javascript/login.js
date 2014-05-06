$(document).ready(function(){

 $('#login-button').click(function ()
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
	});
});
