var gulp =        require('gulp');
var browserSync = require('browser-sync');

gulp.task('serve', function () {
  browserSync({
    proxy: 'local.dev:8888/alec-rust',
    files: [
      './src/style.css',
      './src/script.js',
      './src/*.php'
    ]
  });
});
