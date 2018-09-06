function capitalize(str) {
    let array = str.split('');
    if (array[0].toUpperCase() !== array[0].toLowerCase()) {
        array[0] = array[0].toUpperCase()
    }
    return array.join('');
}