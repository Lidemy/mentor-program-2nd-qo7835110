let first_num = '';
let sec_num = '';
let count_sign = '';
let screen = '';
//設定 querySelector 的簡稱
let q = function (n) {
    return document.querySelector(n)
};
//監聽數字按鍵
document.querySelectorAll('.num_btn').forEach(function (el) {
    el.addEventListener('click', function () {
        screen += this.value;
        if (screen.length > 15) {
            alert('超過太多我算不出來');
            screen = '';
        }
        if (first_num !== '' && sec_num !== '') {
            sec_num = '';
            screen = '';
            screen += this.value;
        }
        q('.calultor__input').textContent = screen;
    })
})
//AC
q('#AC').addEventListener('click', function () {
    screen = '';
    first_num = '';
    sec_num = '';
    count_sign = '';
    q('.calultor__input').textContent = '';
})
//監聽等於
q('#equal').addEventListener('click', function () {
    equal();
})
//監聽運算鍵
document.querySelectorAll('.count_sign').forEach(function (el) {
    el.addEventListener('click', function () {
        count_sign = this.value;
        count();
    })
})
//運算
function count() {
    if (first_num === '') {
        first_num = screen;
        q('.calultor__input').textContent = '';
        screen = '';
    }
    else if (first_num !== '') {
        equal();
    }
}
function equal() {
    sec_num = screen;
    switch (count_sign) {
        case '+':
            q('.calultor__input').textContent = parseFloat(first_num) + parseFloat(sec_num);
            screen = parseFloat(first_num) + parseFloat(sec_num);
            first_num = screen;
            break;
        case '-':
            q('.calultor__input').textContent = parseFloat(first_num) - parseFloat(sec_num);
            screen = parseFloat(first_num) - parseFloat(sec_num);
            first_num = screen;
            break;
        case '*':
            q('.calultor__input').textContent = parseFloat(first_num) * parseFloat(sec_num);
            screen = parseFloat(first_num) * parseFloat(sec_num);
            first_num = screen;
            break;

            break;
        case '÷':
            q('.calultor__input').textContent = parseFloat(first_num) / parseFloat(sec_num);
            screen = parseFloat(first_num) / parseFloat(sec_num);
            first_num = screen;
            break;
    }
}

