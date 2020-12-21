var input = document.getElementsByClassName('input-editor');
for (var i = 0; i < input.length; i++) {
	input[i].addEventListener("keyup", ()=>{
		if (event.keyCode === 13) {
			document.getElementById('submit').click();
		}
	})
}
var submit = document.getElementById('submit');
submit.addEventListener('click',()=>{
	var username = document.getElementById('username').value;
	var email = document.getElementById('email').value;
	var password = document.getElementById('password').value;
	fetch('../api/editor/add.php',{
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify({username: username, email: email, password: password}),
	})
	.then(response => response.json())
	.then(data => {
		var error = document.getElementById('error');
		error.innerHTML = "";
		if (data.code == 200) {
			error.classList.remove('display');
			error.innerHTML = data.message;
			document.getElementById("username").value = "";
			document.getElementById("email").value = "";
			document.getElementById("password").value = "";
			get_list_editor();
			return;
		}
		if (data.code == 404 ) {
			error.classList.remove('display');
			error.innerHTML = data.message;
			return;
		}
	})
})
function get_list_editor() {
	fetch('../api/editor/read.php', {
		method: 'POST',
		header: {
			'Content-Type': 'application/json',
		}
	})
	.then(response => response.json())
	.then(data => {
		var editor = document.getElementById('editor');
		editor.innerHTML = '';
		editor.insertAdjacentHTML('beforeend', "<tr id='title'><th>Họ tên</th><th>Email</th><th id='like'>Tuỳ chọn</th></tr>");
		for (a of data.result) {
			editor.insertAdjacentHTML('beforeend', "<tr><td>"+a.username+"</td><td>"+a.email+"</td><td><button onclick='lock_editor("+a.id+")' class='button-delete'>"+a.status+"</button></td></tr>");
		}
	})
	.catch((error) => {
		console.error('Error:', error);
	});
}
get_list_editor();
document.getElementById('editor-sidebar').classList.add('active');