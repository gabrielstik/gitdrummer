/* eslint-disable */

const gulp = require('gulp'),
  gulp_rename = require('gulp-rename'),
  gulp_rm = require('gulp-rm'),
  gulp_plumber = require ('gulp-plumber'),
  gulp_sourcemaps = require ('gulp-sourcemaps'),
  gulp_notify = require('gulp-notify'),
  del = require('del'),
  // CSS/SCSS dependencies
  gulp_autoprefixer = require ('gulp-autoprefixer'),
  gulp_sass = require('gulp-sass'),
  gulp_responsive = require('gulp-responsive'),
  // JS/ES6 dependencies
  gulp_concat = require('gulp-concat'),
  // Images
  gulp_imagemin = require('gulp-imagemin'),
  // Browserify
  gutil = require('gulp-util'),
  browserify = require('browserify'),
  babelify = require('babelify'),
  source = require('vinyl-source-stream'),
  env = require('babel-preset-env')
  
const browserSync = require('browser-sync').create()
const historyApiFallback = require('connect-history-api-fallback');

const config = {
  dist: 'dist/',
  src : 'src/',
  assets: 'dist/assets/'
}

// Tasks
gulp.task('clean', () => {
  return del(config.dist).then(paths => {
    console.log('Deleted files and folders:\n', paths.join('\n'))
  })
})

gulp.task('default', ['dev'])
gulp.task('dev', ['watch'])
gulp.task('prod', ['app', 'apps', 'styles', 'vendor-styles', 'scripts', 'fonts', 'lib', 'json', 'images', 'apache'])

// SASS to SCSS, compress & prefix styles
gulp.task('styles', () => {
  return gulp.src([`${config.src}styles/**/*.scss`, `!${config.src}styles/vendor/*`])
    .pipe(gulp_plumber({errorHandler: gulp_notify.onError('Styles error:  <%= error.message %>')}))
    .pipe(gulp_sourcemaps.init())
    .pipe(gulp_concat('style.min.css'))
    .pipe(gulp_sass({
      outputStyle: 'compressed'}).on('error', gulp_sass.logError))
    .pipe(gulp_autoprefixer({
      browsers: ['last 2 versions'],
      cascade: false
    }))
    .pipe(gulp_sourcemaps.write())
    .pipe(gulp.dest(config.assets + 'css'))
})

gulp.task('vendor-styles', () => {
  return gulp.src(`${config.src}styles/vendor/*`)
    .pipe(gulp_plumber({errorHandler: gulp_notify.onError('Vendor styles error:  <%= error.message %>')}))
    .pipe(gulp.dest(`${config.assets}css/vendor`))
})

// Concat, minify & babel
gulp.task('scripts', () => {
  browserify({
    entries: `${config.src}scripts/app.js`,
    debug: true
  })
    .transform(babelify, { presets: [env] })
    .bundle()
    .on('error', gutil.log)
    .pipe(source('app.js'))
    .on('error', gutil.log)
    .pipe(gulp_rename('app.js'))
    .pipe(gulp.dest(`${config.assets}js`))
})

gulp.task('app', () => {
  return gulp.src(`${config.src}*.html`)
    .pipe(gulp_plumber({errorHandler: gulp_notify.onError('App error:  <%= error.message %>')}))
    .pipe(gulp.dest(`${config.dist}`))  
})

gulp.task('apps', () => {
  return gulp.src(`${config.src}app/**/*.html`)
    .pipe(gulp_plumber({errorHandler: gulp_notify.onError('Apps error:  <%= error.message %>')}))
    .pipe(gulp.dest(`${config.dist}app`))  
})

gulp.task('fonts', () => {
  return gulp.src(`${config.src}fonts/*`)
    .pipe(gulp_plumber({errorHandler: gulp_notify.onError('Fonts copy error:  <%= error.message %>')}))
    .pipe(gulp.dest(`${config.assets}fonts`))
})

gulp.task('json', () => {
  return gulp.src(`${config.src}scripts/*.json`)
    .pipe(gulp_plumber({errorHandler: gulp_notify.onError('Json copy error:  <%= error.message %>')}))
    .pipe(gulp.dest(`${config.assets}js`))
})

gulp.task('lib', () => {
  return gulp.src(`${config.src}lib/**`)
    .pipe(gulp_plumber({errorHandler: gulp_notify.onError('Lib copy error:  <%= error.message %>')}))
    .pipe(gulp.dest(`${config.assets}lib`))
})

gulp.task('images', () => {
  return gulp.src(`${config.src}images/**`)
    .pipe(gulp_plumber({errorHandler: gulp_notify.onError('Images copy error:  <%= error.message %>')}))
    .pipe(gulp.dest(`${config.assets}images`))
})

gulp.task('apache', () => {
  return gulp.src(`${config.src}.htaccess`)
    .pipe(gulp_plumber({errorHandler: gulp_notify.onError('Copy error:  <%= error.message %>')}))
    .pipe(gulp.dest(`${config.dist}`))
})

gulp.task('browsersync', () => {
  browserSync.init({
    server: {
      baseDir: "./dist",
      middleware: [ historyApiFallback() ]
    },
    notify: false
  })
})

// Watch tasks
gulp.task('watch', ['app', 'apps', 'styles', 'vendor-styles', 'scripts', 'fonts', 'lib', 'json', 'images', 'apache', 'browsersync'], () => {
  gulp.watch(`${config.src}*.html`, ['app']).on('change', browserSync.reload)
  gulp.watch(`${config.src}app/**/*.html`, ['apps']).on('change', browserSync.reload)
  gulp.watch(`${config.src}views/**/*.html`, ['views']).on('change', browserSync.reload)
  gulp.watch(`${config.src}actions/**/*.html`, ['actions']).on('change', browserSync.reload)
  gulp.watch([`${config.src}styles/**/*.scss`, `!${config.src}styles/vendor`], ['styles']).on('change', browserSync.reload)
  gulp.watch([`${config.src}scripts/**/*.js`, `!${config.src}scripts/vendor`], ['scripts']).on('change', browserSync.reload)
  gulp.watch(`${config.src}images/**`, ['images']).on('change', browserSync.reload)
  gulp.watch(`${config.src}fonts/**`, ['fonts']).on('change', browserSync.reload)
  gulp.watch(`${config.src}lib/**`, ['lib']).on('change', browserSync.reload)
  gulp.watch(`${config.src}scripts/*.json`, ['json']).on('change', browserSync.reload)
})