var status = 'login'

document.querySelectorAll(".nav-link").forEach(ele => {
    ele.addEventListener('click', evt => {
        // Check duplicate click and ignore the operation
        if (ele.classList.contains("active")) return;

        status = (status == 'login') ? 'signup' : 'login'
        document.getElementById("checkpwd").classList.toggle("d-none")

        document.querySelectorAll(".nav-link").forEach(ele => {
            ele.classList.toggle("active")
        })
    })
})

document.getElementById("task-form").addEventListener('submit', evt => {
    evt.preventDefault()

    var msg = document.getElementById("result-msg");

    fetch('backend/' + status + '.php', {
        method: 'POST',
        body: new FormData(evt.target)
    })
    .then(response => response.json())
    .catch((error) => {
        msg.classList.add("bg-danger", "text-white")
        msg.innerText = error
    })
    .then((res) => {
        if (msg.classList.contains("d-none")) msg.classList.remove("d-none")

        if (res.errcode != 0) {
            msg.classList.add("bg-danger", "text-white")
            msg.innerText = res.errmsg
        } else {
            msg.classList.remove("bg-danger", "text-white")
            msg.innerHTML = (status == 'signup') ? ('注册成功！') : (
                '<p>登录成功！ 这是你的第 ' + res.data.number_of_times + ' 次登录</p>' +
                '<p>最近一次登录在 ' + res.data.last_login_time + '</p>'
            );
        }
    })    
})
