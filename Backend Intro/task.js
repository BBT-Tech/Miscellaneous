var status = 'login'

document.querySelectorAll(".nav-link").forEach(ele => {
    ele.addEventListener('click', function() {
        status = (status == 'login') ? 'signup' : 'login'
        document.getElementById("checkpwd").classList.toggle("d-none")

        document.querySelectorAll(".nav-link").forEach(ele => {
            ele.classList.toggle("active")
        })
    })
})

document.getElementById("task-form").addEventListener('submit', e => {
    e.preventDefault()

    var ele = document.getElementById("result-msg");
    ele.classList.add("d-none")

    // fetch('Mockdata/fail.json', {
    fetch('Mockdata/' + status + '-succ.json', {
        method: 'POST',
        body: new FormData(e.target)
    })
    .then(response => response.json())
    .then((res) => {
        ele.classList.remove("d-none")

        if (res.errcode != 0) {
            ele.classList.add("bg-danger", "text-white")
            ele.innerText = res.errmsg
        } else {
            ele.classList.remove("bg-danger", "text-white")
            ele.innerHTML = (status == 'signup') ? ('注册成功！') : (
                '<p>登录成功！ 这是你的第 ' + res.data.number_of_times + ' 次登录</p>' +
                '<p>最近一次登录在 ' + res.data.last_login_time + '</p>'
            );
        }
    })
})
