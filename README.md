# Laravel Sanctum Api

Api hecha en laravel para probar este paquete y su herramienta para generar tokens, validar tokens y un middleware del token
***

## Laravel Sanctum

**Instalar el paquete**

```
composer require laravel/sanctum
```

**Publicar el Provider del Paquete**

```
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

**Ejecutar las migraciones del paquete**
```
php artisan migrate
```

**Verificar que el modelo de Usuario use el trait adecuado**

```php
use Laravel\Sanctum\HasApiTokens;

use HasApiTokens; //on Model User
```

**Instalar el paquete del proveedor fruitcake para manejar correctamente los Cors**

```
composer require fruitcake/laravel-cors
```

**Generar Token**

```php
$token = $user->createToken("auth_token")->plainTextToken;
```

**Validar la autenticación de los datos mediante email - password**

```php
$check_login_data = ['email' => $request_data["email"], 'password' => $request_data["password"]];
$loginCorrect = Auth::attempt($check_login_data);
```

**Aplicar Middleware a las Rutas**
```php
use App\Http\Controllers\AuthController;

Route::post('/profile', [AuthController::class, 'profileUser'])->middleware('auth:sanctum');
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Author

> Stalin Maza - Software Developer
