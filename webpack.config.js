const path = require('path');

module.exports = {
    entry: './homeworks/week10/hw2/index.js',
    output: {
        path: path.resolve(__dirname, 'build'),
        filename: 'bundle.js'
    }
};