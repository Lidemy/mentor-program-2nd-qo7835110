function stars(n) {
    let star = '';
    let result = [];
    for (let i = 0; i < n; i++) {
        star += '*'
        result.push(star)
    }
    return result
}
module.exports = stars;