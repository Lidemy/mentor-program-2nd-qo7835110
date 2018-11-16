$(document).ready(function () {
    let list = [];
    $('.board__keyin__btn').click(function (e) {
        let value = e.target.previousElementSibling.value;
        list.push(value);
        render();
        e.target.previousElementSibling.value = '';
    })
    $('.board__content').click(function (e) {
        if ($(e.target).hasClass('delete')) {
            let num = $(e.target.parentNode).data('num');
            list.splice(num, 1);
            render()
        }
    })
    function render() {
        $('.board__content').empty();
        $('.board__content').append(list.map(function (e, index) {
            return `
                    <li data-num=${index} class="list-group-item">
                        <button type="button" class="checked btn btn-success btn-sm">完成</button>
                        <p class="article">
                        ${e}
                        </p>
                        <button class="delete btn btn-danger btn-sm">delete</button>
                    </li>
                    `
        }))
    }
})