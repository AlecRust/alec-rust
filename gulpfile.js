var gulp = require('gulp');
var gulpIf = require('gulp-if');
var uglify = require('gulp-uglify');
var minifyCss = require('gulp-cssnano');
var del = require('del');
var cache = require('gulp-cache');
var imagemin = require('gulp-imagemin');
var bump = require('gulp-bump');
var touch = require('gulp-touch');
var concat = require('gulp-concat');
var stylus = require('gulp-stylus');
var git = require('gulp-git');
var fs = require('fs');
var stylint = require('gulp-stylint');
var clip = require('gulp-clip-empty-files');
var postcss = require('gulp-postcss');
var bemLinter = require('postcss-bem-linter');
var atImport = require('postcss-import');
var at2x = require('postcss-at2x');
var customProperties = require('postcss-custom-properties');
var customMedia = require('postcss-custom-media');
var calc = require('postcss-calc');
var autoprefixer = require('autoprefixer');

var paths = {
  dist: './.openshift/themes/alec-rust',
  styles: {
    src: 'src/assets/styles/**/*.styl',
    dest: 'src',
    temp: './.temp'
  },
  scripts: {
    src: 'src/assets/scripts/**/*.js',
    dest: 'src'
  },
  images: {
    src: 'src/assets/images/**/*',
    dest: 'src/assets/images'
  }
};

function clean() {
  return del([ paths.dist ]);
}

function getPackageJsonVersion() {
  // Parse the JSON file instead of using require because require
  // caches multiple calls so the version number won't be updated
  return JSON.parse(fs.readFileSync('./package.json', 'utf8')).version;
}

function compileStylus() {
  return gulp.src(paths.styles.src)
    .pipe(stylint())
    .pipe(stylint.reporter())
    .pipe(stylus())
    .pipe(gulp.dest(paths.styles.temp));
}

function bemlint() {
  return gulp.src('./.temp/**/*.css')
    .pipe(clip())
    .pipe(postcss([
      bemLinter('suit')
    ]));
}

function processCss() {
  return gulp.src('./.temp/*.css')
    .pipe(postcss([
      atImport(),
      at2x(),
      customProperties(),
      calc(),
      customMedia(),
      autoprefixer()
    ]))
    .pipe(gulp.dest(paths.styles.dest));
}

function scripts() {
  return gulp.src(paths.scripts.src)
    .pipe(concat('script.js'))
    .pipe(gulp.dest(paths.scripts.dest));
}

function images() {
  return gulp.src(paths.images.src)
    .pipe(cache(imagemin({
      progressive: true,
      interlaced: true,
      svgoPlugins: [{ cleanupIDs: false }]
    })))
    .pipe(gulp.dest(paths.images.dest));
}

function copy() {
  return gulp.src([
    'src/**/*',
    '!src/assets/scripts',
    '!src/assets/scripts/**',
    '!src/assets/styles',
    '!src/assets/styles/**'
  ], {
    dot: true
  })
  .pipe(gulpIf('*.js', uglify()))
  .pipe(gulpIf('*.css', minifyCss()))
  .pipe(gulp.dest(paths.dist));
}

function watch() {
  gulp.watch(paths.styles.src, styles);
  gulp.watch(paths.scripts.src, scripts);
  gulp.watch(paths.images.src, images);
  gulp.watch('src/**/*.php', copy);
}

function bumpVersion() {
  return gulp.src([
    'package.json',
    'src/assets/styles/style.styl',
    'src/functions.php',
  ], { base: './' })
  .pipe(bump())
  .pipe(gulp.dest('./'))
  // Touch the files to ensure changes are
  // picked up by Git: https://git.io/vMNKZ
  .pipe(touch());
}

function commitChanges() {
  var version = getPackageJsonVersion();
  return gulp.src('.')
    .pipe(git.add())
    .pipe(git.commit('Release version ' + version));
}

function createNewTag(cb) {
  var version = getPackageJsonVersion();
  return git.tag(version, 'Created Tag for version: ' + version, function (error) {
    if (error) {
      return cb(error);
    }
  });
}

exports.clean = clean;
exports.scripts = scripts;
exports.images = images;

var styles = gulp.series(compileStylus, bemlint, processCss);
var build = gulp.series(clean, gulp.parallel(styles, scripts, images), copy);

gulp.task('watch', gulp.series(build, watch));
gulp.task('release', gulp.series(bumpVersion, build, commitChanges, createNewTag));
gulp.task('build', build);
gulp.task('default', build);
