function query() {
    fetch('process.php?stuno=' + getStuNo())
    .then((resp) => resp.text())
    .then((data) => setResult(data))
    .catch(err => setResult(err));
}

function reset() {
    if (confirm('是否确认重置操作？')) {
        fetch('process.php?reset=1&stuno=' + getStuNo())
        .then((resp) => resp.text())
        .then((data) => setResult(data))
        .catch(err => setResult(err));
    }
}

function getStuNo() {
    return document.getElementById("stuno").value;
}

function setResult(html, succ =false) {
    document.getElementById("result").innerHTML = html;
}
