function Stack() {
    let arr = [];
    this.push = function (n) {
        arr[arr.length] = n;
    }
    this.pop = function () {
        let result = arr[arr.length - 1];
        arr.splice(arr.length - 1, 1);
        return result;
    }
}
let stack = new Stack();
stack.push(10);
stack.push(5);
console.log('stack:' + stack.pop());
console.log('stack:' + stack.pop());

function Queue() {
    let arr = [];
    this.push = function (n) {
        arr[arr.length] = n;
    }
    this.pop = function () {
        let result = arr[0];
        arr.splice(0, 1);
        return result;
    }
}
let queue = new Queue();
queue.push(1);
queue.push(2);
console.log('queue:' + queue.pop());
console.log('queue:' + queue.pop());
const test = () => console.log(123);
test();
