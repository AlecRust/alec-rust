var gulp = require('gulp');
var opn =  require('opn');

gulp.task('serve', function () {
  opn('http://localhost:8888/alec-rust/');
});