Bootstrap - готовая библиотека со стилями и frontend кодами .

### Как мы можем его подключить в PhpStorm ?

У нас Laravel 9+ версий . Обращайте на версию вашего Laravel ! 

 Step 1 :
 
```php
composer require laravel/ui
```

Step 2 :

```php
npm install bootstrap
```

В файле `resources/css/app.css` или `resources/js/app.js` подключаем Bootstrap

```js
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
```

Step 3 :

Запускаем Bootstrap

```php
npm run dev
```

