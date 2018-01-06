class login
{
	constructor(url)
	{
		this.url = url;
	}

	listen()
	{
		var that = this;
		domId('form').addEventListener('submit', function () {
			var context = that.buildLoginContext();
			if (context != null) {
				var ch = new XMLHttpRequest();
					ch.onreadystatechange = function () {
						if (this.readyState === 4) {
							that.responseAction(this.responseText);
						}
					};
					ch.withCredentials = true;
					ch.open("POST", that.url);
					ch.send(JSON.stringify(context));
			}
		});
	}

	buildLoginContext()
	{
		return {
			"username": domId('username').value,
			"password": domId('password').value
		};
	}

	responseAction(data)
	{
		try {
			data = JSON.parse(data);
			if (data['message'] != "") {
				alert(data['message']);
			}
			if (data['redirect'] != "") {
				window.location = data['redirect'];
			}
		} catch (e) {
			alert(e.message);
		}
	}
}