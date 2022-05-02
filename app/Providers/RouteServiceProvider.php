<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(function ($router) {
                require base_path('routes/web.php');
                require base_path('routes/catalogos.php');
                require base_path('routes/usuarios.php');
                require base_path('routes/materias.php');
                require base_path('routes/personas.php');
                require base_path('routes/domicilios.php');
                require base_path('routes/media_filiacion.php');
                require base_path('routes/escolaridad.php');
                require base_path('routes/referencias.php');
                require base_path('routes/contacto_referencia.php');
                require base_path('routes/domicilio_referencia.php');
                require base_path('routes/meritos.php');
                require base_path('routes/sanciones.php');
                require base_path('routes/planestudios.php');
                require base_path('routes/cursos.php');
                require base_path('routes/planestudiomaterias.php');
                require base_path('routes/maestros.php');
                require base_path('routes/asignaciones.php');
                require base_path('routes/cursos_alumnos.php');
                require base_path('routes/colegiados.php');
                require base_path('routes/documentos.php');
                require base_path('routes/evaluaciones.php');
                require base_path('routes/control.php');
                require base_path('routes/cambios.php');
                require base_path('routes/bajas.php');
                require base_path('routes/nombramientos.php');
                require base_path('routes/evidencias.php');
                require base_path('routes/eventos.php');
                require base_path('routes/evento_evidencias.php');
                require base_path('routes/reportes.php');
                require base_path('routes/profile.php');
            });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
