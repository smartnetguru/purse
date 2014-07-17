var gulp = require('gulp');
var stylus = require('gulp-stylus');
var nib = require('nib');

gulp.task('stylus', function() {
  gulp.src('./views/stylus/*.styl')
      .pipe(stylus({use: [nib()], errors: true, compress: true}))
      .pipe(gulp.dest('./public/stylesheets/'));
});

gulp.task('watch', function() {
  gulp.watch('./views/stylus/*.styl', ['stylus']);
});

gulp.task('default', ['watch']);
