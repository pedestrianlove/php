<script type="text/javascript">

var baseUrl = "$GB_PG[base_url]" + "/image.php";
var captchaLang = "$_locale";

var randval = function() {
	return Math.random().toString(36).substr(2);
};

var getRandToken = function() {
	var ret = "";
	ret = randval() + randval() + randval() + randval();
	return ret.substring(0, 32);
};

var getNewTokenUrl = function(token) {
	var captchaUrl = baseUrl + "?id=" + token + "&lang=" + captchaLang;
	return captchaUrl;
}

var setCaptcha = function() {
	var token = getRandToken();
	$('#gb_token').val(token);
	$('#captchaUrl').attr("src", getNewTokenUrl(token));	
}

$(document).ready(function(){
	setCaptcha();
	$('#refreshCaptcha').click(function() {
		setCaptcha();
	});
});
</script>
		<table border="0" cellspacing="2">
			<tr>
				<td>
					<img src="$GB_PG[base_url]/img/loading.gif" id="captchaUrl" border="0">
					<img src="$GB_PG[base_url]/img/refresh_16.png" id="refreshCaptcha" border="0">
					<br />
					<input type="text" name="gb_captcha" size="55">
					<input type="hidden" name="gb_token" id="gb_token" value="">
				</td>
			</tr>
		</table>
