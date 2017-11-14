var gulp = require('gulp');
var uglify = require('gulp-uglify');
var minifyCss = require('gulp-cssnano');
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

function getPackageJsonVersion() {
  // Parse the JSON file instead of using require because require
  // caches multiple calls so the version number won't be updated
  return JSON.parse(fs.readFileSync('./package.json', 'utf8')).version;
}

function compileStylus() {
  return gulp.src('assets/styles/**/*.styl')
    .pipe(stylint())
    .pipe(stylint.reporter())
    .pipe(stylus())
    .pipe(gulp.dest('./.temp'));
}

function bemlint() {
  return gulp.src('./.temp/**/*.css')
    .pipe(clip())
    .pipe(postcss([bemLinter('suit')]));
}

function processCss() {
  return gulp.src('./.temp/*.css')
    .pipe(
      postcss([
        atImport(),
        customProperties(),
        calc(),
        customMedia(),
        autoprefixer()
      ])
    )
    .pipe(minifyCss())
    .pipe(gulp.dest('./'));
}

function scripts() {
  return gulp.src('assets/scripts/**/*.js')
    .pipe(concat('script.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./'));
}

function watch() {
  gulp.watch('assets/styles/**/*.styl', styles);
  gulp.watch('assets/scripts/**/*.js', scripts);
}

function bumpVersion() {
  return (
    gulp.src(['package.json', 'assets/styles/style.styl', 'functions.php'], {
        base: './'
      })
      .pipe(bump({ keys: ['version', 'stable tag'] }))
      .pipe(gulp.dest('./'))
      // Touch the files to ensure changes are
      // picked up by Git: https://git.io/vMNKZ
      .pipe(touch())
  );
}

function commitChanges() {
  var version = getPackageJsonVersion();
  return gulp.src('.')
    .pipe(git.add())
    .pipe(git.commit(version));
}

function createNewTag(cb) {
  var version = getPackageJsonVersion();
  return git.tag(version, 'Created Tag for version: ' + version, function(
    error
  ) {
    if (error) {
      return cb(error);
    }
  });
}

function pushChanges(cb) {
  return git.push('origin', 'master', cb);
}

function createRelease(done) {
  githubReleaser(
    {
      type: 'oauth',
      token: process.env.CONVENTIONAL_GITHUB_RELEASER_TOKEN
    },
    done
  );
}

exports.scripts = scripts;

var styles = gulp.series(compileStylus, bemlint, processCss);
var build = gulp.series(gulp.parallel(styles, scripts));

gulp.task('watch', gulp.series(build, watch));
gulp.task(
  'release',
  gulp.series(
    bumpVersion,
    build,
    commitChanges,
    createNewTag,
    pushChanges,
    createRelease
  )
);
gulp.task('build', build);
gulp.task('default', build);
