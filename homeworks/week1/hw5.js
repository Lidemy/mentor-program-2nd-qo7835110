function join(str, concatStr) {
    let result = '';
    for (let i = 0; i < str.length; i++) {
        result += str[i] + concatStr;
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