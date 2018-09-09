function alphaSwap(str) {
    let result = '';
    let newArray = str.split('');
    for (let i = 0; i < newArray.length; i++) {
        if (newArray[i].toUpperCase() === newArray[i]) {
            newArray[i] = newArray[i].toLowerCase();
        }
        else {
            newArray[i] = newArray[i].toUpperCase()
        }
    }

    return (newArray.join(''))
}
module.exports = alphaSwap