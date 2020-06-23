<?php

use App\Events\OrderCompleted;
use App\Exceptions\CalcException;
use App\Jobs\ConfirmUpload;
use App\Jobs\Exception;
use App\Mail\Image;
use App\Mail\Inspire;
use App\Mail\Quote;
use App\Notifications\Welcome;
use App\Post;
use App\Services\CalcService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $quote = 'coffee in the morning saves your life';
    $author = 'wise old man';
    //Mail::to('test@test.de')->send(new Inspire($quote, $author));
    dispatch(new Exception());

    return view('welcome', ['posts' => Post::all()]);
});

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/verify/phone', 'Auth\VerifyPhoneController@create')->name('verify/phone');
    Route::post('/verify/phone', 'Auth\VerifyPhoneController@store')->name('verify/phone');
    Route::get('/verify/email', 'Auth\VerifyEmailController@create')->name('verify/email');
    Route::post('/verify/email', 'Auth\VerifyEmailController@store')->name('verify/email');
});

Route::get('/secret', function () {
    return 'secure';
})->middleware('verified.email');

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('post/{post}/toggle', function (App\Post $post) {
    if (Gate::none(['togglePost', 'always-toggle-post'], $post)) {
        abort(403);
    }
    $post->toggleActivity();

    return redirect('/');
});

Route::get('user/{user}/delete', function (App\User $user) {
    if (Gate::none(['delete-user', 'delete-other-users'], $user)) {
        abort(403);
    }
    $user->oauth()->delete();
    $user->delete();

    return redirect('/');
});

Route::get('upload/', function () {
    $path = 'public/'.auth()->user()->id;
    Storage::makeDirectory($path);
    $files = Storage::allFiles($path);
    $directories = Storage::allDirectories($path);

    return view('upload', compact('files', 'directories'));
});

Route::post('directory', function (Request $request) {
    $path = 'public/'.auth()->user()->id;
    Storage::makeDirectory($path.'/'.$request->directory);

    return redirect('upload/');
});

Route::post('upload', function (Request $request) {
    $path = 'public/'.auth()->user()->id;
    if ($request->file('image')->isValid()) {
        $request->validate([
            'image' => 'required|max:1024|mimes:png',
        ]);

        //Storage::putFile($path, $request->image);
        $request->image->store('/html/advanced-laravel/', Str::lower($request->disk));

        dispatch(new ConfirmUpload(auth()->user()->email));

        return redirect('/upload');
    }
});

Route::get('notification', function () {
    auth()->loginUsingId(10);
    Notification::send(auth()->user(), new Welcome());

    return 'notification send';
});

Route::get('log', function () {
    Log::info('Aufgabe ausgeführt');

    dispatch(function () {
        Log::info('Aufgabe in der Queue ausgeführt');
    });
});

Route::get('ordercompleted', function () {
    event(new OrderCompleted());
});
Route::get('calc/', function () {
    return view('calc');
});

Route::post('calc', function (Request $request, CalcService $calcService) {
    $request->validate([
        'x' => 'required',
        'y' => 'required',
    ]);

    try {
        $result = $calcService->plus($request->x, $request->y);
    } catch (CalcException $e) {
        report($e);

        return back()->withErrors($e->getMessage());
    }

    return $result;
});

Route::get('product', function () {
    return view('product-search');
});

Route::post('product', function (Request $request) {
    $request->validate([
        'barcode' => 'required',
    ]);

    $response = cache()->rememberForever("product.{$request->barcode}", function () {
        return Http::beforeSending(function () {
            info('Anfrage bezüglich des Barcodes'.request()->barcode.'gesendet.');
        })->get('https://de.openfoodfacts.org/api/v0/product/'.request()->barcode)->json();
    });

    return view('product-search', compact('response'));
});
