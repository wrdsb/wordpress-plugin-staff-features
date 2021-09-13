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

function composerCopy() {
    return src('./composer*')
        .pipe(dest('./dist/'));
}

function autoload() {
    return exec('composer dumpautoload -d ./dist/');
}

function composerInstallProd() {
    return exec('composer install -d ./dist/ --no-dev --optimize-autoloader');
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


exports.build = series(clean, composerCopy, autoload, composerInstallProd, parallel(chassisCopy, chassisClassesCopy, modulesCopy));

exports.default = defaultTask;