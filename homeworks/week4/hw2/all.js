let email = document.querySelector('#email');
let name = document.querySelector('#name');
let junior = document.querySelector('#junior');
let engineer = document.querySelector('#engineer');
let level = '';
let code_exp = document.querySelector('#code_exp');
let other = document.querySelector('#other')
let btn = document.querySelector('.btn');
// 離開焦點時，如果沒有內容，則出現警告
email.addEventListener('blur', function (e) {
    if (email.value.trim() == '') {
        document.querySelector('#email+.warning_tips').style.display = 'block';
        email.parentNode.style.background = 'rgb(255, 214, 214)';
    }
    else {
        document.querySelector('#email+.warning_tips').style.display = 'none';
        email.parentNode.style.background = 'none';
    }
})
name.addEventListener('blur', function (e) {
    if (name.value.trim() == '') {
        document.querySelector('#name+.warning_tips').style.display = 'block';
        name.parentNode.style.background = 'rgb(255, 214, 214)';
    }
    else {
        document.querySelector('#name+.warning_tips').style.display = 'none';
        name.parentNode.style.background = 'none';
    }
})
junior.addEventListener('click', function (e) {
    document.querySelector('#junior~.warning_tips').style.display = 'none';
    junior.parentNode.style.background = 'none';
    level = 'junior';
})
engineer.addEventListener('click', function (e) {
    document.querySelector('#junior~.warning_tips').style.display = 'none';
    engineer.parentNode.style.background = 'none';
    level = 'engineer';
})
code_exp.addEventListener('blur', function (e) {
    if (code_exp.value.trim() == '') {
        document.querySelector('#code_exp+.warning_tips').style.display = 'block';
        code_exp.parentNode.style.background = 'rgb(255, 214, 214)';
    }
    else {
        document.querySelector('#code_exp+.warning_tips').style.display = 'none';
        code_exp.parentNode.style.background = 'none';
    }
})
// 送出表單時驗證
document.querySelector('form').addEventListener('submit', function (e) {
    for (let i = 0; i < e.target.length - 2; i++) {
        if (e.target[i].value.trim() === "") {
            e.preventDefault();
            e.target[i].parentNode.style.background = 'rgba(247, 156, 164, 0.596)';
            e.target[i].parentNode.lastChild.previousSibling.style.display = 'block';
            return
        }
        else if (e.target[2].checked === false && e.target[3].checked === false) {
            e.preventDefault();
            e.target[2].parentNode.style.background = 'rgba(247, 156, 164, 0.596)';
            e.target[2].parentNode.lastChild.previousSibling.style.display = 'block';
            return
        }

    }
    console.log(`email=${email.value}&name=${name.value}&level=${level}&code_exp=${code_exp.value}&other=${other.value}`)
    alert('成功')
})
