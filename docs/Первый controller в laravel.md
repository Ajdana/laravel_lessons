Как создать контроллер в Laravel ?

Шаг 1 : Написать команду 'php artisan' . Это команда как гаид . Позволит увидеть какие команды мы можем использовать .

![[Pasted image 20250825182600.png]]

Шаг 2 : Написать команду по созданию контроллера .

```cmd
php artisan make:controller  -help
php artisan make:controller MyPlaceController
```

Если у нас вышло сообщение 'Controller created successfully.' . То мы успешно создали его . 

Шаг 3 : Теперь мы можем грамотно перенести код под контроллер .

```mysql
class MyPlaceController extends Controller  
{  
    public function index() {  
        return 'this is my page';  
    }  
}
```

Шаг 4 : Чтобы его вывести нам нужно написать 

```mysql
Route::get('/my_page', 'MyPlaceController@index');
```

