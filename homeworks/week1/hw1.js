function printStars(n) {
    if (n > 30 || n < 1) return;
    let result = "";
    for (let i = 1; i <= n; i++) {
        result += '*' + '\n';
    }
    console.log(result);
}