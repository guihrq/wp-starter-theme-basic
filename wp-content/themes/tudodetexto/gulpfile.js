import gulp from 'gulp';
import browserSync from 'browser-sync';
import gulpSass from 'gulp-sass';
import * as dartSass from 'sass';
import autoprefixer from 'gulp-autoprefixer';
import uglifycss from 'gulp-uglifycss';
import uglify from 'gulp-uglify';
import rename from 'gulp-rename';
import imagemin from 'gulp-imagemin';

// Configuração do Sass
const sass = gulpSass(dartSass);

// Configuração do BrowserSync
const browser = browserSync.create();

// Tarefa para compilar Sass
function compileSass() {
  return gulp.src('./assets/sass/main.scss')
    .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(gulp.dest('./assets/css'))
    .pipe(browser.stream());
}

// Tarefa para iniciar o servidor de desenvolvimento
function serve(done) {
  browser.init({
    proxy: "http://tudodetexto.local.host/",
    notify: false
  });
  done();
}

// Tarefa para observar mudanças
function watchFiles() {
  gulp.watch('./assets/sass/**/*.scss', compileSass);
  gulp.watch('./*.php').on('change', browser.reload);
}

// Minificar CSS
function compressCss() {
  return gulp.src('./assets/css/main.css')
    .pipe(uglifycss({
      "maxLineLen": 80,
      "uglyComments": true
    }))
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(gulp.dest('./assets/css/min/'));
}

// Minificar JS
function compressJs() {
  return gulp.src('./assets/js/*.js')
    .pipe(uglify())
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(gulp.dest('./assets/js/min/'));
}

// Otimizar imagens
function compressImages() {
  return gulp.src('./assets/images/**')
    .pipe(imagemin({
      interlaced: true,
      progressive: true,
      optimizationLevel: 5,
      verbose: true
    }))
    .pipe(gulp.dest('./assets/images/'));
}

// Otimizar imagens de uploads
function compressUpload() {
  return gulp.src('../../uploads/**')
    .pipe(imagemin({
      interlaced: true,
      progressive: true,
      optimizationLevel: 5,
      verbose: true
    }))
    .pipe(gulp.dest('../../uploads'));
}

// Tarefa de produção
function compileProd() {
  return gulp.src('./assets/sass/main.scss')
    .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
    .pipe(gulp.dest('./assets/css'));
}

// Tarefa de desenvolvimento
const compileDev = gulp.series(
  compileSass,
  serve,
  watchFiles
);

// Exportar tarefas
export { 
  compileSass,
  serve,
  watchFiles,
  compressCss,
  compressJs,
  compressImages,
  compressUpload,
  compileProd,
  compileDev
};