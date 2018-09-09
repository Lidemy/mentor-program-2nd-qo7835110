function add(a, b) {
    let result = [];
    let aArray = a.split('').reverse();
    let bArray = b.split('').reverse();
    console.log('aArray:' + aArray);
    console.log('bArray:' + bArray);
    if (aArray.length > bArray.length) {
        for (let i = 0; i < aArray.length; i++) {
            if (bArray[i] === undefined) {
                bArray[i] = 0;
            }
            result.push(parseInt(aArray[i]) + parseInt(bArray[i]))
        }
    }
    else if (bArray.length > aArray.length) {
        for (let i = 0; i < bArray.length; i++) {
            if (aArray[i] === undefined) {
                aArray[i] = 0;
            }
            result.push(parseInt(aArray[i]) + parseInt(bArray[i]))
        }
    }
    else if (aArray.length === bArray.length) {
        for (let i = 0; i < aArray.length; i++) {
            result.push(parseInt(aArray[i]) + parseInt(bArray[i]))
        }
    }
    for (let i = 0; i < result.length; i++) {
        if (result[i] >= 10) {
            result[i] = result[i] - 10;
            result[i + 1] += 1;
        }
    }
    return (result.reverse().join(''))
}
console.log(add('12312383813881381381', '129018313819319831'))
module.exports = add;