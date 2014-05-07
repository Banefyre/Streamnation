$(document).ready(function(){

$('.ui.radio.checkbox')
  .checkbox();

$('#send_quiz').click(function ()
{

	$('#loader').show();
	$('#res').hide();


	var duration = 500000;
	var pizza = 0;
	var popcorn = 0;
	var icecream = 0;
	var chillaxed = 0;
	var omg = 0;
	var amazing = 0;
	var critic = "yes";

	if ($('#pizza').is(':checked'))
		pizza = 1;
	if ($('#popcorn').is(':checked'))
		popcorn = 1;
	if ($('#icecream').is(':checked'))
		icecream = 1;
	if ($('#chillaxed').is(':checked'))
		chillaxed = 1;
	if ($('#omg').is(':checked'))
		omg = 1;
	if ($('#amazing').is(':checked'))
		amazing = 1;

	if ($('#duration_low').is(':checked'))
		duration = 60 * 60;
	if ($('#duration_medium').is(':checked'))
		duration = 60 * 60 * 2;
	if ($('#duration_high').is(':checked'))
		duration = 60 * 60 * 100;

	if ($('#critic_yes').is(':checked'))
		critic = "yes";
	if ($('#critic_ok').is(':checked'))
		critic = "ok";
	if ($('#critic_no').is(':checked'))
		critic = "no";

	$.ajax({
			url : 'compute_quiz.php',
			method : 'POST',
			data : { duration : duration, pizza : pizza, icecream : icecream, popcorn : popcorn, chillaxed : chillaxed, omg : omg, amazing : amazing, critic : critic },
			success : function(res)
			{
				res = jQuery.parseJSON(res);
				console.log(res);
				$('#res_img').attr('src', res.object.covers[0].uri);
				$('#res_name').text(res.object.name);
				$('#res_likes').text('Likes '+res.object.like_count);
				$('#loader').hide();
				$('#res').show();

			}
		});
});


});
