$(document).ready(function () {
    //取得資料
    $('.board__keyin__btn').click(function (e) {
        let value = '';
        let result_html = '';
        value = e.target.previousElementSibling.value;
        result = `
        <li class="list-group-item">
            <button type="button" class="checked btn btn-success btn-sm">完成</button>
            <p class="article">
              ${value}
            </p>
            <button class="delete btn btn-danger btn-sm">delete</button>
        </li>
        `
        $('.board__content').append(result);
        e.target.previousElementSibling.value = '';
    })
    $('.board__content').click((e) => {
        //刪除
        if ($(e.target).hasClass('delete')) {
            $(e.target.parentNode).remove();
        }//checked
        else if ($(e.target).hasClass('checked')) {
            $(e.target.nextElementSibling).toggleClass('bg-success');
        }
    })
})