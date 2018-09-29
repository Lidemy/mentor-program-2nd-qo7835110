let form = document.querySelector('form');
//取得必須填的表單
let must_todo = [...form].filter(function (e) {
    return e.parentNode.className === 'block must_todo';
});
//取得必須填的表單 name，因為 type radio 比較特殊，所以不好直接取值，那就取得所有的 name
let must_todo_type = must_todo.map(function (e) {
    return e.name;
});
//取得所有的 name 包含那些不是必填的
let all_name = [...form].map(function (e) {
    return e.name;
});
//監聽 submit event
form.addEventListener('submit', function (e) {
    for (let i = 0; i < must_todo.length; i++) {
        if (!form[must_todo_type[i]].value.trim()) {
            e.preventDefault();
            must_todo[i].parentNode.style.background = 'rgba(209, 146, 151, 0.596)';
            must_todo[i].parentNode.lastChild.previousSibling.style.display = 'block';
            return
        }
        else {
            must_todo[i].parentNode.style.background = 'white';
            must_todo[i].parentNode.lastChild.previousSibling.style.display = 'none';
        }
    }
    for (let i = 0; i < form.length - 1; i++) {
        console.log(`${form[i].name}=${form[all_name[i]].value}`)
    }
    alert('成功');
});


