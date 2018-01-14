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
							that.action(this.responseText);
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
		}, z;
		if (context['password'] !== context['cpassword']) {
			alert("Confirm password does not match!");
			return false;
		}
		for(z in context) {
			this.domId(z).disabled = 1;
		}
		return JSON.stringify(context);
	}

	action(data)
	{
		try	{
			var context = {
				"full_name": 1,
				"email": 1,
				"address": 1,
				"phone": 1,
				"username": 1,
				"password": 1,
				"cpassword": 1
			}, z;
			for(z in context) {
				this.domId(z).disabled = 0;
			}
			data = JSON.parse(data);
			if (data['message'] !== null) {alert(data['message'])}
			if (data['redirect'] !== null) {window.location = data['redirect']}
		} catch (e) {
			alert(e.message + "\n\n" + JSON.stringify(data));
		}
	}
}