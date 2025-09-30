Простой пример фильтраций : 

```php
$posts = Post::where('is_published', 1)
->where('category_id', 5)
->get();
```

Создаем FilterRequest - чтобы указать те самые атрибуты которые связаны с фильтрацией . 

![[Pasted image 20250925084842.png]]

В rules указываем атрибуты :

```php
public function rules()
{
	return [
		'title' => 'string',
		'content' => 'string',
		'category_id' => '',
	]
}
```

В основном Контроллере , указываем :

```php
class MainController extends Controller
{
	public function __invoke (FilterRequest $request)
	{
		$data = $request->validated();
	}
}
```

QueryString- строка запроса . Example 127.0.0.1:8000/posts?category_id

Как выглядит наша фильтрация в чуть более сложном виде:

```php
$query = Post::query();  
  
if (isset($data['category_id'])) {  
    $query->where('category_id', $data['category_id']);  
}  
  
if (isset($data['title'])) {  
    $query->where('title', 'like', "%{$data['title']}%");  
}  
  
if (isset($data['content'])) {  
    $query->where('content', 'like', "%{$data['content']}%");  
}  
  
  
$posts = $query->get();  
$posts = Post::where('is_published', 1)  
    ->where('category_id', $data['category_id'])  
    ->get();  
  
  
$posts = $query->get();
dd($posts);
```

% - процент означает что в любом месте слова будет проверятся . Не только в начале или в конце . 

Создаем папку Filters . Внутри него у нас должно быть 3 класса . 
1 AbstractFilter 
2 FilterInterface
3 PostFilter

Что мы указываем в FilterInterface ?

```php
use Illuminate\Database\Eloquent\Builder;

interface FilterInterface  
{  
    public function apply(Builder $builder);  
  
}
```

Подгружаем метод специально для Builder .
Что мы указываем в AbstractFilter ?
```php
use Illuminate\Database\Eloquent\Builder;  
  
abstract class AbstractFilter implements FilterInterface  
{  
    /** @var array */  
    private $queryParams = [];//те парметры по которым мы как раз таки хотим отфильтровать . 
  
    /**  
     * AbstractFilter constructor.     *     * @param array $queryParams  
     */  
    public function __construct(array $queryParams)  
    {  
        $this->queryParams = $queryParams;  
    } //инициализация 
  
    abstract protected function getCallbacks(): array;  //вызов массива 
  
    public function apply(Builder $builder)  
    {  
        $this->before($builder);  
  
        foreach ($this->getCallbacks() as $name => $callback) {  
            if (isset($this->queryPaams[$name]))  
            {  
                call_user_func($callback, $builder, $this->queryParams[$name]);//вызываем метод и прокидываем ему параметры
            }  
        }  
    }  
  
    /**  
     * @param Builder $builder  
     */  
    protected function before(Builder $builder)  
    {  
    }  
  
    /**  
     * @param string $key  
     * @param mixed|null $default  
     *  
     * @return mixed|null  
     */    protected function getQueryParam(string $key, $default = null)  
    {  
        return $this->queryParams[$key] ?? $default;  
    }  
  
    /**  
     * @param string[] $keys  
     *  
     * @return AbstractFilter  
     */    protected function removeQueryParam(string ...$keys){  
        foreach ($keys as $key) {  
            unset($this->queryParams[$key]);  
        }  
  
        return $this;  
    }  
}
```

Создаем папку traits . Внутри него создаем trait и называем filterable . 

```php
<?php  
  
namespace App\Models\Traits;  
  
use App\Http\Filters\FilterInterface;  
use Illuminate\Database\Eloquent\Builder;  
  
trait Filterable  
{  
    /**  
     * @param Builder $builder  
     * @param FilterInterface $filter  
     *  
     * @return Builder  
     */  
    //filter()  
    public function scopeFilter(Builder $builder, FilterInterface $filter){  
        $filter->apply($builder);  
  
        return $builder;  
    }  
}
```

PostFilter 

```php
<?php  
  
namespace App\Http\Filters;  
  
use Illuminate\Database\Eloquent\Builder;  
class PostFilter extends AbstractFilter  
{  
    public const TITLE = 'title';  
    public const CONTENT = 'content';  
    public const CATEGORY_ID = 'category_id';  
  
    protected function getCallbacks(): array  
    {  
        return [  
            self::TITLE => [$this, 'title'],  
            self::CONTENT => [$this, 'content'],  
            self::CATEGORY_ID => [$this, 'categoryId'],  
        ];  
    }  
    public function title(Builder $builder, $value)  
    {  
        $builder->where('title', 'like', "%{$value}%");  
    }  
  
    public function content(Builder $builder, $value)  
    {  
        $builder->where('content', 'like', "%{$value}%");  
    }  
  
    public function category_id(Builder $builder, $value)  
    {  
        $builder->where('category_id', $value);  
    }  
  
}
```