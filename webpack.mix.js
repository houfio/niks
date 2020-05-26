const mix = require('laravel-mix');

mix
  .ts('resources/ts/app.ts', 'public/js')
  .ts('resources/ts/confirm.ts', 'public/js')
  .ts('resources/ts/gallery.ts', 'public/js')
  .ts('resources/ts/tree.ts', 'public/js')
  .ts('resources/ts/form.ts', 'public/js')
  .sass('resources/sass/app.scss', 'public/css')
  .disableSuccessNotifications();

if (mix.inProduction()) {
  mix.version();
}
