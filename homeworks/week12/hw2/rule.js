let rules = () => {
    const rule = [];
    //     橫的
    for (let i = 0; i < 361; i = i + 19) {
        for (let j = i; j < i + 15; j++) {
            let array = [j, j + 1, j + 2, j + 3, j + 4];
            rule.push(array);
        }
    }
    //     直的
    for (let i = 0; i < 19; i++) {
        for (let j = i; j < 361; j = j + 19) {

            let array = [j, j + 19, j + 38, j + 57, j + 76];
            rule.push(array)

        }
    }
    return rule
}
export default rules;