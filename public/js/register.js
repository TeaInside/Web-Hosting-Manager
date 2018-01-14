class register
{
	constructor(url)
	{
		this.url = url;
	}

	listen()
	{
		var that = this;
		this.domId('form').addEventListener('submit', function (event) {
			var x = that.buildContext();
			if (x !== false) {
				var ch = new XMLHttpRequest();
					ch.onreadystatechange = function () {
						if (this.readyState === 4) {
							alert(this.responseText);
						}
					};
					ch.withCredentials = true;
					ch.open("POST", that.url);
					ch.send(x);
			}
		});
	}

	domId(id)
	{
		return document.getElementById(id);
	}

	buildContext()
	{
		var context = {
			"full_name": this.domId('full_name').value,
			"email": this.domId('email').value,
			"address": this.domId('address').value,
			"phone": this.domId('phone').value,
			"username": this.domId('username').value,
			"password": this.domId('password').value,
			"cpassword": this.domId('cpassword').value
		};
		if (context['password'] !== context['cpassword']) {
			alert("Confirm password does not match!");
			return false;
		}
		return JSON.stringify(context);
	}
}