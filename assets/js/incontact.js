var icpForm13729 = document.getElementById('icpsignup13729');

if (document.location.protocol === "https:") {
	icpForm13729.action = "https://app.icontact.com/icp/signup.php";
}

function verifyRequired13729() {
	if (icpForm13729["fields_email"].value == "") {
		icpForm13729["fields_email"].focus();
		alert("Don't forget your email address.");
		return false;
	}
	return true;
}
