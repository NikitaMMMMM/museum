# museum-pages (перенос шаблонов)

В этой папке уже подготовлены Blade-шаблоны (layout/partials/pages) для переноса из исходных HTML.

## Куда что положено
- `resources/views/layouts/app.blade.php`
- `resources/views/layouts/auth.blade.php`
- `resources/views/partials/site-header.blade.php`
- `resources/views/partials/site-footer.blade.php`
- `resources/views/partials/exhibits-breadcrumb.blade.php`
- `resources/views/pages/*.blade.php` (index/about/exhibits/exhibit/history/login/register/profile)

## Важно
Шаблоны пока используют статические ссылки вида `index.html`, `exhibits.html` и т.п. Их лучше заменить на `route()` после настройки маршрутов.

JS (`js/app.js`) и CSS (`css/styles.css`) подключаются как в оригинальных HTML.

