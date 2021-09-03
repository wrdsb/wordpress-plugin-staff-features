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

function chassisCopy() {
    return src('./src/Chassis/*.php')
        .pipe(dest('./dist/'));
}

function chassisClassesCopy() {
    return src('./src/Chassis/Classes/*.php')
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


exports.build = series(clean, autoload, parallel(chassisCopy, chassisClassesCopy, modulesCopy, vendorCopy));

exports.default = defaultTask;