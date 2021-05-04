const { series, parallel, src, dest } = require('gulp');
const { exec } = require('child_process');
const del = require('del');

function defaultTask(cb) {
    // place code for your default task here
    cb();
}

function clean() {
    return del(['dist/**/*']);
}

function autoload() {
    return exec('composer dumpautoload');
}

function srcCopy() {
    return src('./src/**/*')
        .pipe(dest('./dist/'));
}

function vendorCopy() {
    return src('./vendor/**/*')
        .pipe(dest('./dist/vendor/'));
}


exports.build = series(clean, autoload, parallel(srcCopy, vendorCopy));
exports.clean = clean;
exports.autoload = autoload;
exports.src = srcCopy;
exports.vendor = vendorCopy;

exports.default = defaultTask;