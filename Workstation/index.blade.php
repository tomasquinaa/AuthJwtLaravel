JWT AUTH:

1. Instalar Via Composer: 
composer require tymon/jwt-auth
2. Add the service provider to the providers array in the config/app.php config file as follows:
'providers' => [

    ...

    Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
]
3. Publish the config
Run the following command to publish the package config file:
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"

4. Generate secret key:
php artisan jwt:secret

5. Update your User model: 
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}

6. Configure Auth guard:
Inside the config/auth.php file you will need to make a few changes to configure Laravel to use the jwt guard to power your application authentication:
'defaults' => [
    'guard' => 'api',
    'passwords' => 'users',
],

...

'guards' => [
    'api' => [
        'driver' => 'jwt',
        'provider' => 'users',
    ],
]

7. 