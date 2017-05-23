В этой главе рассказывается, как добавить поддержку библиотеки в Laravel Framework.

## Установка

- `composer require serafim/railgun`

## Интеграция с Laravel 5.1+

- [laravel/framework](https://github.com/laravel/framework)

### Добавляем сервис-провайдер

Стоит открыть файл `~/config/app.php`, там найти строчку `providers` и добавить следующий код:

```php
    'providers' => [
        // ...
        Serafim\Railgun\Providers\Laravel\LaravelServiceProvider::class,
    ]
``` 

### Создаём контроллер

```php
use Serafim\Railgun\Endpoint;
use Serafim\Railgun\Requests\RequestInterface;

class MyController
{
    // Роут: $router->get('/graphql', 'MyController@some');
    public function some(RequestInterface $request, Endpoint $endpoint): array
    {
        return $endpoint->request(Factory::create($request));
    }
}
```

### Публикуем конфигурацию

Достаточно выполнить команду `php artisan vendor:publish` и наслаждаться 
файлом конфигурации, который располагается в файле `~/config/railgun.php`

## Прочее

### DI-контейнер

После установки «сервис-провайдера» следующие сервисы 
станут доступны для получения через «сервис-локацию», 
«автовайринг» и «двойную диспатчеризацию», т.е. будут находиться внутри контейнера:

- `Serafim\Railgun\Requests\RequestInterface::class` - возвращает GraphQL объект-запрос, связанный 
с текущим HTTP-запросом.
- `Serafim\Railgun\Contracts\Adapters\EndpointInterface::class` - уже сконфигурированный GraphQL Endpoint, 
содержащий нужный набор запросов (queries) и мутаторов (mutations).
- `Serafim\Railgun\Contracts\TypesRegistryInterface::class` - реестр зарегистрированных GraphQL типов.

### События

Подписку на события можно осуществить, обратившись к [сервису событий](https://laravel.com/docs/5.4/events).

- `railgun.type:creating` - вызывается перед регистрацией нового типа
- `railgun.type:created` - вызывается после регистрации нового типа
- `railgun.schema:creating` - вызывается перед созданием cхемы
- `railgun.schema:created` - вызывается после создания схемы