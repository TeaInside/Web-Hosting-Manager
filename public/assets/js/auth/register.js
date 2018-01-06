class register
{
	constructor(to)
	{
		this.to = to;
	}
	listen()
	{
		var that = this;
		domId('form-register').addEventListener("submit", function () {
			var context = that.buildContext();
			if (context !== false) {
				that.action(context);
			}
		});
	}
	action(dt){
		var ch = new XMLHttpRequest();
			ch.onreadystatechange = function () {
				if (this.readyState === 4) {
					try	{
						var q = JSON.parse(this.responseText);
						if (q['message'] !== null) {
							alert(q['message']);
						}
						if (q['redirect'] !== null) {
							window.location = q['redirect'];
						}
					} catch (e) {
						alert(this.responseText);
					}
				}
			};
			ch.withCredentials = true;
			ch.open("POST", this.to);
			ch.send(dt);
	}
	buildContext()
	{
		var q = {
			"first_name": domId('fn').value,
			"last_name": domId('ln').value,
			"email": domId('email').value,
			"username": domId('uname').value,
			"password": domId('pass').value,
			"cpassword": domId('cpass').value
		};
		if (q['password']!==q['cpassword']) {
			alert("Confirm password does not match!");
			return false;
		}
		return JSON.stringify(q);
	}
}