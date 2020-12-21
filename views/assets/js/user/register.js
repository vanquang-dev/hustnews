function check_pass() {
    var password = document.getElementById('password').value;
    var status = document.getElementById('status');
    if (password.length < 6) {
        status.innerHTML = 'Mật khẩu phải dài hơn 6 ký tự';
        return false;
    } else {
        status.innerHTML = "ĐĂNG KÝ";
        return true;
    }
}

function check_repass() {
    var password = document.getElementById('password').value;
    var repassword = document.getElementById('repassword').value;
    var status = document.getElementById('status');
    if (password != repassword) {
        status.innerHTML = 'Mật khẩu chưa khớp';
        return false;
    } else {
        status.innerHTML = "ĐĂNG KÝ";
        return true;
    }
}

function check_email() {
    var email = document.getElementById('email').value;
    var status = document.getElementById('status');
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (re.test(email) == false) {
        status.innerHTML = 'Email không hợp lệ';
        return false;
    } else {
        status.innerHTML = "ĐĂNG KÝ";
        return true;
    }
}

register.addEventListener('click',()=>{
    var email = document.getElementById('email').value;
    var name = document.getElementById('name').value;
    var password = document.getElementById('password').value;
    var repassword = document.getElementById('repassword').value;
    if (check_pass()) {
        if (check_repass()) {
            if (check_email()) {
                fetch('api/register/create.php', {
                    method: 'POST',
                    headers: {
                    'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({name: name, email: email, password: password, repassword: repassword}),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.code == 404) {
                        return;
                    }
                    setTimeout(()=>{
                        window.location = 'index.php';
                    },1000)
                })
            }
        }
    }
})