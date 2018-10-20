var status = 'login';

document.querySelectorAll(".nav-link").forEach(ele => {
    ele.addEventListener('click', function() {
        status = (status == 'login') ? 'signup' : 'login';
        document.getElementById("checkpwd").classList.toggle("d-none");

        document.querySelectorAll(".nav-link").forEach(ele => {
            ele.classList.toggle("active");
        });
    })
});
