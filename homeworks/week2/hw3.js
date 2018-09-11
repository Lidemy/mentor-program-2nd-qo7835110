function isPrime(n) {
    let result = false;
    let count = 0;
    if (n <= 1) {
        return result
    }
    for (let i = 1; i < n; i++) {
        if (n % i === 0) {
            count += 1;
        }
    }
    if (count === 1) {
        result = true
    }
    return result
}
module.exports = isPrime