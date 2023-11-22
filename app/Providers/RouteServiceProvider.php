<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('web')
            ->group(base_path('routes/auth.php'));

            Route::middleware('web')
            ->group(base_path('routes/roles.php'));

            Route::middleware('web')
            ->group(base_path('routes/users.php'));

            Route::middleware('web')
            ->group(base_path('routes/course.php'));

            Route::middleware('web')
            ->group(base_path('routes/classroom.php'));

            Route::middleware('web')
            ->group(base_path('routes/course_category.php'));

            Route::middleware('web')
            ->group(base_path('routes/lesson.php'));

            Route::middleware('web')
            ->group(base_path('routes/section.php'));

            Route::middleware('web')
            ->group(base_path('routes/question.php'));

            Route::middleware('web')
            ->group(base_path('routes/quiz.php'));

            Route::middleware('web')
            ->group(base_path('routes/report.php'));

        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        RateLimiter::for('login', function(Request $request){
            $key = 'login.' .$request->ip();
            $max = 5;
            $decay = 60;
            if(RateLimiter::tooManyAttempts($key, $max)){
                return back()->with('message', 'Vui lòng chờ đợi...');
            }
            else{
                RateLimiter::hit($key, $decay);
            }
        });
    }
}
