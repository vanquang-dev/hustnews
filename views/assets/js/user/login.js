function check_email() {
    var email = document.getElementById('email').value;
    var status = document.getElementById('status');
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (re.test(email) == false) {
        status.innerHTML = 'Email không hợp lệ';
        return false;
    } else {
        status.innerHTML = "ĐĂNG NHẬP";
        return true;
    }
}
var login = document.getElementById('login');
login.addEventListener('click', () => {
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    if (check_email()) {
        fetch('api/login/login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ email: email, password: password }),
            })
            .then(response => response.json())
            .then(data => {
                var status = document.getElementById('status');
                if (data.code == 400) {
                    status.innerHTML = data.message;
                    return;
                }
                if (data.code == 404) {
                    status.innerHTML = data.message;
                    return false;
                } else {
                    window.location = 'index.php';
                }

            })
    }
})