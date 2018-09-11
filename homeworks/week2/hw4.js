function isPalindromes(str) {
    let result = '';
    if (str.split('').reverse().join('') === str) {
        result = true;
    }
    else {
        result = false
    }
    return result;
}
module.exports = isPalindromes