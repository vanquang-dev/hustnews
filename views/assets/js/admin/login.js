var input = document.getElementsByClassName('input_login');
for (var i = 0; i < input.length; i++) {
	input[i].addEventListener("keyup", ()=>{
		if (event.keyCode === 13) {
			document.getElementById('login').click();
		}
	})
}
var login = document.getElementById('login');
login.addEventListener('click',()=>{
	var email = document.getElementById('email').value;
	var password = document.getElementById('password').value;
	fetch('../api/login-admin/check.php',{
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify({email: email, password: password}),
	})
	.then(response => response.json())
	.then(data => {
		var error = document.getElementById('error');
		if (data.code == 400) {
			error.innerHTML = data.message;
            return;
		}
		if (data.code == 404) {
			error.classList.remove('display');
			return;
		}
		window.location = 'index.php';
	})
})