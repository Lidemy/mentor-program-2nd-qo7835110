function join(str, concatStr) {
    let result = str[0];
    for (let i = 1; i < str.length; i++) {
        result += concatStr + str[i];
    }
    return result;
};

function repeat(str, times) {
    let result = '';
    for (let i = 0; i < times; i++) {
        result += str;
    }
    return result
};