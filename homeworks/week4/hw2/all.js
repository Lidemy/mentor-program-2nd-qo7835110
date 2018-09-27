let form = document.querySelector('form');
let must_todo = [...form].filter(function (e) {
    return e.parentNode.className === 'block must_todo';
});
let must_todo_type = must_todo.map(function (e) {
    return e.name;
})

form.addEventListener('submit', function (e) {
    e.preventDefault();
    for (let i = 0; i < must_todo.length; i++) {
        if (!form[must_todo_type[i]].value) {
            e.preventDefault();
            must_todo[i].parentNode.style.background = 'rgba(209, 146, 151, 0.596)';
            must_todo[i].parentNode.lastChild.previousSibling.style.display = 'block'
            return
        }
        else {
            must_todo[i].parentNode.style.background = 'white';
            must_todo[i].parentNode.lastChild.previousSibling.style.display = 'none'
        }
    }
    for (let i = 0; i < must_todo.length; i++) {
        console.log(`${must_todo_type[i]}:${form[must_todo_type[i]].value}`)
    }
});


