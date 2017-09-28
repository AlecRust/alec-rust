var gulp = require('gulp');
var uglify = require('gulp-uglify');
var minifyCss = require('gulp-cssnano');
var cache = require('gulp-cache');
var imagemin = require('gulp-imagemin');
var bump = require('gulp-bump');
var touch = require('gulp-touch');
var concat = require('gulp-concat');
var stylus = require('gulp-stylus');
var git = require('gulp-git');
var githubReleaser = require('conventional-github-releaser');
var fs = require('fs');
var stylint = require('gulp-stylint');
var clip = require('gulp-clip-empty-files');
var postcss = require('gulp-postcss');
var bemLinter = require('postcss-bem-linter');
var atImport = require('postcss-import');
var customProperties = require('postcss-custom-properties');
var customMedia = require('postcss-custom-media');
var calc = require('postcss-calc');
var autoprefixer = require('autoprefixer');

var paths = {
  styles: {
    src: 'assets/styles/**/*.styl',
    temp: './.temp'
  },
  scripts: {
    src: 'assets/scripts/**/*.js'
  },
  images: {
    src: 'assets/images/**/*',
    dest: 'assets/images'
  }
};

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
      customProperties(),
      calc(),
      customMedia(),
      autoprefixer()
    ]))
    .pipe(gulp.dest('./'));
}

function scripts() {
  return gulp.src(paths.scripts.src)
    .pipe(concat('script.js'))
    .pipe(gulp.dest('./'));
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

function watch() {
  gulp.watch(paths.styles.src, styles);
  gulp.watch(paths.scripts.src, scripts);
  gulp.watch(paths.images.src, images);
}

function bumpVersion() {
  return gulp.src([
    'package.json',
    'assets/styles/style.styl',
    'functions.php',
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
    .pipe(git.commit(version));
}

function createNewTag(cb) {
  var version = getPackageJsonVersion();
  return git.tag(version, 'Created Tag for version: ' + version, function (error) {
    if (error) {
      return cb(error);
    }
  });
}

function pushChanges(cb) {
  return git.push('origin', 'master', cb);
}

function createRelease(done) {
  githubReleaser({
    type: 'oauth',
    token: process.env.CONVENTIONAL_GITHUB_RELEASER_TOKEN
  }, done);
}

exports.scripts = scripts;
exports.images = images;

var styles = gulp.series(compileStylus, bemlint, processCss);
var build = gulp.series(gulp.parallel(styles, scripts, images));

gulp.task('watch', gulp.series(build, watch));
gulp.task('release', gulp.series(bumpVersion, build, commitChanges, createNewTag, pushChanges, createRelease));
gulp.task('build', build);
gulp.task('default', build);
