<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
// Exceptions
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(web: __DIR__ . '/../routes/web.php', api: __DIR__ . '/../routes/api.php', commands: __DIR__ . '/../routes/console.php', health: '/up')
    ->withMiddleware(function (Middleware $middleware) {
        // Translations
        $middleware->web(append: [SetLocale::class]);
        // Use appendToGroup() to add the middleware to the 'web' group.
        /* $middleware->appendToGroup('web', SetLocale::class); */
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Test exceptions
        $exceptions->render(function (Exception $e, Request $request) {
            $errorPath = $request->getRequestUri();
            // set locale to show the custom error in the correct language
            $locale = $request->session()->get('locale', 'es');
            App::setLocale($locale);
            //dd($e);
            if ($e->getPrevious() instanceof ModelNotFoundException) {
                // Log the miss
                Log::error('404. NotFound: ', ['path' => $errorPath, 'userId' => Auth::id(), 'message' => $e->getMessage()]);
                //return response()->json(['message' => 'Not Found'], 404);
                return response()->view('errors.404', ['errorPath' => $errorPath], 404);
            }
            if ($e instanceof ErrorException) {
                // Log the miss
                Log::error('ErrorException: ', ['path' => $errorPath, 'userId' => Auth::id(), 'message' => $e->getMessage(), 'file' => $e->getFile()]);
                //return response()->json(['message' => 'Not Found'], 404);
                return response()->view('errors.404', ['errorPath' => $errorPath], 404);
            }
            /* if ($e instanceof HttpException) {
                // Log the miss
                Log::error('HttpException: ', ['path' => $errorPath, 'userId' => Auth::id(), 'message' => $e->getMessage(), 'file' => $e->getFile(), 'code' => $e->getStatusCode()]);
                //return response()->json(['message' => 'Not Found'], 404);
                return response()->view('errors.500', ['errorPath' => $errorPath], 500);
            } */
        });
    })
    ->create();
