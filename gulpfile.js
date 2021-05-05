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

function keelCopy() {
    return src('./src/Keel/*.php')
        .pipe(dest('./dist/'));
}

function keelClassesCopy() {
    return src('./src/Keel/Classes/*.php')
        .pipe(dest('./dist/src/'));
}

function modulesCopy() {
    return src('./src/Modules/**/*')
        .pipe(dest('./dist/src/Modules/'));
}

function vendorCopy() {
    return src('./vendor/**/*')
        .pipe(dest('./dist/vendor/'));
}


exports.build = series(clean, autoload, parallel(keelCopy, keelClassesCopy, modulesCopy, vendorCopy));

exports.default = defaultTask;