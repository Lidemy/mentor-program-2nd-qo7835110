function reverse(str) {
    let str_array = str.split('');
    let new_array = [];
    for (let i = str_array.length - 1; i >= 0; i--) {
        new_array.push(str_array[i])
    };
    console.log(new_array.join(''));
}