const postcss = require('gulp-postcss');
const gulp = require('gulp');
const autoprefixer = require('autoprefixer');
const mqpacker = require('css-mqpacker');
const csswring = require('csswring');
const pcssImport = require('postcss-import');
const customProps = require('postcss-custom-properties');
const nested = require('postcss-nested');
const mediaQueries = require('postcss-custom-media');
const csso = require('postcss-csso');
const pseudoEl = require('postcss-pseudoelements');
const rename = require('gulp-rename');

const processors = [
    pcssImport,
    autoprefixer({browsers: ['last 4 versions', '> 1%', 'ie 10', 'ie 9', 'Firefox ESR'], flexbox: true}),
    mqpacker,
    customProps,
    nested,
    mediaQueries,
    pseudoEl,
    csswring,
];

// One time build
gulp.task('default', ['css']);

// Dev watch
gulp.task('watch:css', ['css'], function() {
  gulp.watch('./src/pcss/*.pcss', ['css']);
  gulp.watch('./src/pcss/**/*.pcss', ['css']);
});

// PCSS -> CSS
gulp.task('css', function() {
    return gulp.src('./src/pcss/main.pcss')
        .pipe(postcss(processors))
        .pipe(rename({extname: ".css"}))
        .pipe(gulp.dest('./public/css'));
});
