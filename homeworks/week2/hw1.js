function stars(n) {
    let result = [];
    for (let i = 1; i <= n; i++) {
        if (n > 30) return;
        result.push('*'.repeat(i))
    }
    return result;
}

module.exports = stars;