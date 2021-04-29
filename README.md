# API Helper

Provee un envoltorio para `laravel/spatie` para crear controladores de un API REST.

## Instalación

Para instalar el paquete debes agregar las siguientes lineas en el composer.json del proyecto.

En la sección `repositories`
```
        {
            "type": "vcs",
            "url": "ssh://git@github.com:nonDeath/api-helper.git"
        }
```

En la sección `require`

```
    "non-death/api-helper": "^2.0"
```

Luego ejecutar el comando `composer update`

## Configuración

### Publicar traducciones

```
php artisan vendor:publish 
```

ó

```
php artisan vendor:publish --provider='ND\ApiHelper\ApiHelperServiceProvider' 
```


## Uso

### Manejo de excepciones
En la clase App\Exceptions\Handler reemplazar

```
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;`
```

por: 

```
use ND\ApiHelper\Handler as ExceptionHandler;
```

### Controllers
Los controllers del API deben definirse así:

```php
//...
use ND\ApiHelper\LaravelApiController as ApiController;

class AccesosController extends ApiController
{
    //
}
```

### Responses

**Colección de recursos**

```php
    return $this->respond(
            $collection,
            new CollectionTransformer
        );
```

**Item de recurso**

```php
    return $this->respond($eloquentModelInstance, new EloquentModelTransformer);
```

**Response Ok con mensaje estándar**

Normalmente usado para devolver status 2xx

```php
    return $this->success('Documento digital', 'Reordenamiento');
```

Este ejemplo devolverá un json:

```
{ "messages": ["Reordenamiento de Documento Digital  realizada con éxito"]}
```

**Error interno 500**

```php
    //
    catch (\Exception $e) {
        // otro codigo de gestion de error
        return $this->errorInternal($e->getMessage());
    }
```

**Eadge Loading**

Permitir edge loading de relaciones declaradas en el Transformer.

```php
// ejemplo con colección de recursos
$collection = $modelInstance->withIncludes($request->include, new ModelTransformer());
// luego enviar el response
```
