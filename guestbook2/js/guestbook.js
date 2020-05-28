function getEmail(email) {
	var stringPos = false;
	var stringEmail = "";
	if (email.length>0) {
		for (var i=0; i<email.length; i++) {
			stringPos = (i % 2) ? false : true;
			if (stringPos == true) {
				stringEmail = stringEmail + "%" + email.charAt(i);
			} else {
				stringEmail = stringEmail + email.charAt(i);
			}
		}
		stringEmail = unescape(stringEmail);
		window.location.href = stringEmail;
	}
}
