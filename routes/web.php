<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\GrupController;
use App\Http\Controllers\Backend\HighlightController;
use App\Http\Controllers\Backend\ProfileContorller;
use App\Http\Controllers\Backend\ScheduleController as BackendScheduleController;
use App\Http\Controllers\Backend\StandingController;
use App\Http\Controllers\Backend\SystemController;
use App\Http\Controllers\Backend\TestController;
use App\Http\Controllers\Backend\TimController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\RegisterController;
use App\Http\Controllers\Frontend\ScheduleController;
use App\Http\Controllers\login\LoginController;
use Illuminate\Support\Facades\Route;


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


Route::get('/about-us', function () {
    return view('frontend.aboutUs');
})->name('about.us');
Route::get('/privacy-policy', function () {
    return view('frontend.privasyPolicy');
})->name('privacy.policy');
Route::get('/peraturan', function () {
    return view('frontend.peraturan');
})->name('peraturan');


// frontend
Route::get("/", [HomeController::class, "index"])->name("home");
Route::get("/schedule", [ScheduleController::class, "index"])->name("schedule");
Route::get("/register", [RegisterController::class, "index"])->name("register");
Route::post("/register", [RegisterController::class, "store"])->name("register.store");

// login
Route::get("/login", [LoginController::class, "index"])->name("login");
Route::post("/login", [LoginController::class, "action"])->name("login.action");

Route::get("/test", [TestController::class, "index"])->name("test");
Route::get('/test/{id}/view', [TestController::class, 'view'])->name('test.view');
Route::get('/test/{id}/edit', [TestController::class, 'edit'])->name('test.edit');


Route::middleware(['auth'])->group(function () {
    Route::get("/admin", [DashboardController::class, "index"])->name("dashboard")->middleware('role:admin,peserta');

    Route::middleware(['role:admin,peserta'])->group(function () {
        // tim
        Route::get("/admin/tim/{id}", [TimController::class, "view"])->name("tim.view");
        Route::get("/admin/tim/{id}/edit", [TimController::class, "edit"])->name("tim.edit");
        Route::put("/admin/tim/{id}/update", [TimController::class, "update"])->name("tim.update");

        // schedule
        Route::get("/admin/schedule/{id}", [BackendScheduleController::class, "view"])->name("schedule.admin.view");
    });

    Route::middleware('role:admin')->group(function () {
        // tim
        Route::get("/admin/tim", [TimController::class, "index"])->name("tim.index");
        Route::delete("/admin/tim/{id}", [TimController::class, "delete"])->name("tim.delete");


        // scedule
        Route::get("/admin/schedule", [BackendScheduleController::class, "index"])->name("schedule.admin");
        Route::post("/admin/schedule", [BackendScheduleController::class, "store"])->name("schedule.store");
        Route::get("/admin/schedule/{id}/edit", [BackendScheduleController::class, "edit"])->name("schedule.edit");
        Route::put("/admin/schedule/{id}/edit", [BackendScheduleController::class, "update"])->name("schedule.update");
        Route::delete("/admin/schedule/{id}", [BackendScheduleController::class, "delete"])->name("schedule.delete");
        Route::post("/admin/schedule/notification", [BackendScheduleController::class, "notification"])->name("schedule.notification");


        // confirmation registration
        Route::get("/admin/confirmation-registration", [RegisterController::class, "konf_register"])->name("konf_register");
        Route::post('/admin/confirmation-registration/{id}', [RegisterController::class, 'uprove'])->name('uprove.registration');
        Route::delete('/admin/confirmation-registration/{id}', [RegisterController::class, 'delete'])->name('delete.registration');


        // systems
        Route::get("/admin/systems", [SystemController::class, "index"])->name("system.index");
        Route::put("/admin/systems", [SystemController::class, "update"])->name("system.update");

        // grup
        Route::get('/admin/grup', [GrupController::class, "index"])->name('grup.index');
        Route::post('/admin/grup', [GrupController::class, "store"])->name('grup.store');
        Route::get('/admin/grup/{id}/edit', [GrupController::class, "edit"])->name('grup.edit');
        Route::put('/admin/grup/{id}/edit', [GrupController::class, "update"])->name('grup.update');
        Route::delete('/admin/grup/{id}', [GrupController::class, "delete"])->name('grup.delete');


        // stending
        Route::get("/admin/standing", [StandingController::class, "index"])->name("standing.index");
        Route::get("/admin/standing/{id}/edit", [StandingController::class, "edit"])->name("standing.edit");
        Route::get("/admin/standing/standing/{id}/edit", [StandingController::class, "editStanding"])->name("standing.editStanding");
        Route::put("/admin/standing/{id}/edit", [StandingController::class, "update"])->name("standing.update");
        Route::delete("/admin/standing/{id}/edit", [StandingController::class, "delete"])->name("standing.delete");

        Route::post('/admin/standing', [StandingController::class, "store"])->name('standing.store');


        // highlight
        Route::get("/admin/highlight", [HighlightController::class, "index"])->name("highlight.index");
        Route::get("/admin/highlight/{id}/edit", [HighlightController::class, "edit"])->name('highlight.edit');
        Route::get('/admin/highlight/add', [HighlightController::class, 'add'])->name('highlight.add');
        Route::put("/admin/highlight/{id}/edit", [HighlightController::class, "update"])->name('highlight.update');
        Route::delete("/admin/highlight/{id}/edit", [HighlightController::class, "delete"])->name('highlight.delete');
        Route::post('/admin/highlight/add', [HighlightController::class, "store"])->name('highlight.store');

        // profile
        Route::get("/admin/profile", [ProfileContorller::class, "index"])->name("profile.index");
        Route::put("/admin/profile", [ProfileContorller::class, "changePassword"])->name("profile.changePassowrd");

        // user management
        Route::get("/admin/user", [UserController::class, "index"])->name("user.index");
        Route::get("/admin/user/add", [UserController::class, "add"])->name("user.add");
        Route::post("/admin/user/add", [UserController::class, "store"])->name("user.store");
        Route::get("/admin/user/{id}", [UserController::class, "edit"])->name("user.edit");
        Route::put('/admin/user/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/admin/user/{id}', [UserController::class, 'delete'])->name('user.delete');
    });


    // logout
    Route::get('/admin/logout', [LoginController::class, 'logout'])->name('logout');
});
// backend

// dashboard
