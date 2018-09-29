let q = function (e) {
    return document.querySelector(e);
};
Object.prototype.hide = function () {
    this.style.display = 'none';
    console.log(this);
}
Object.prototype.show = function () {
    this.style.display = 'block';
    console.log(this)
}
let h1 = q('h1');
q('.hide').addEventListener('click', function () {
    h1.hide();
})
q('.show').addEventListener('click', function () {
    h1.show();
})
