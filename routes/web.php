<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\testTaken;
use App\Http\Middleware\isTestReviewed;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestAnswerController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/error', function() {
    return view('error');
});
Route::get('/wait', function() {
    return view('wait');
});

Route::middleware('auth')->group(function () {

    Route::middleware(isAdmin::class)->group(function() {

        Route::get('/test', [TestController::class, 'index'])->name('test.index');
        Route::get('/test/create', [TestController::class, 'create'])->name('test.create');
        Route::post('/test/create', [TestController::class, 'store'])->name('test.create.post');
        Route::get('/test/delete/{id}', [TestController::class, 'delete'])->name('test.delete.post');

        Route::get('/genres/create', [GenreController::class, 'create'])->name('genres.create');
        Route::post('/genres/create', [GenreController::class, 'store'])->name('genres.create.post');
        Route::get('/genres/delete/{id}', [GenreController::class, 'delete'])->name('genres.delete.post');

        Route::get('/moderators', function() {
            $Mods = User::where('role', 1)->get();
            return view('users.create', array('Mods' => $Mods));
        })->name('moderators.create');

        Route::post('/moderators/create', function(Request $request) {



        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required'],
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 1
        ]);
        event(new Registered($user));

        return redirect('/moderators');

        })->name('moderators.create.post');

        Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
        Route::post('/movies/create', [MovieController::class, 'store'])->name('movies.create.post');
        Route::get('/movies/delete/{id}', [MovieController::class, 'delete'])->name('movies.delete.post');

        Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
        Route::get('/reviews/user/{id}', [ReviewController::class, 'review_user'])->name('reviews.user.index');
        Route::get('/reviews/accept/{id}', [ReviewController::class, 'accept'])->name('reviews.accept');
        Route::get('/reviews/refuse/{id}', [ReviewController::class, 'refuse'])->name('reviews.refuse');


    });

    Route::middleware(isTestReviewed::class)->group(function() {

        Route::get('/movies', [MovieController::class, 'index'])->name('movies');
        Route::get('/genres', [GenreController::class, 'index'])->name('genres');

        Route::get('/movies/review/{id}', [MovieController::class, 'review'])->name('movies.create.review');
        Route::post('/movies/review', [MovieController::class, 'store_review'])->name('movies.create.review.post');

    });

    Route::get('/test', [TestController::class, 'index'])->name('test.index');
    Route::post('/test/submit', [TestAnswerController::class, 'store'])->name('answers.post');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
