<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseEnrollmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DegreeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\PdfController;
use App\Http\Controllers\Admin\ExcelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('role:teacher')->group(function () {
    Route::get('/users/{id}/first-login', [UserController::class, 'showFirstLoginChangePasswordForm'])->name('user.password.first-login.form');
    Route::post('/users/{id}/first-login', [UserController::class, 'submitFirstLoginChangePassword'])->name('user.password.first-login.submit');
});

Route::middleware('role:admin,teacher,student')->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::middleware('role:admin')->group(function () {
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::match(['put', 'patch'], '/students/{id}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');

    Route::resource('/users', UserController::class)->except(['show']);
    Route::resource('/degrees', DegreeController::class);
    Route::resource('/courses', CourseController::class);
    Route::resource('/course-enrollments', CourseEnrollmentController::class);
    Route::resource('/profiles', ProfileController::class);
    Route::resource('/posts', PostController::class);
    Route::resource('/pages', PagesController::class);

    Route::get('/maintenance', [PagesController::class, 'maintenance'])->name('maintenance.get');
    Route::post('/maintenance', [PagesController::class, 'maintenance'])->name('maintenance');

    Route::get('/pdf', [PdfController::class, 'index'])->name('admin.pdf.index');
    Route::get('/pdf/download', [PdfController::class, 'download'])->name('admin.pdf.download');
    Route::get('/excel', [ExcelController::class, 'index'])->name('admin.excel.index');
    Route::get('/excel/export', [ExcelController::class, 'export'])->name('admin.excel.export');
    Route::post('/excel/import', [ExcelController::class, 'import'])->name('admin.excel.import');
});

Route::middleware('role:admin,teacher')->group(function () {
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
});

Route::middleware('role:admin,student')->group(function () {
    Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');
    Route::get('/students/{id}/change-password', [StudentController::class, 'showChangePasswordForm'])->name('student.password.change.form');
    Route::post('/students/{id}/change-password', [StudentController::class, 'changePassword'])->name('student.password.change');
    Route::get('/students/{id}/first-login', [StudentController::class, 'showFirstLoginChangePasswordForm'])->name('student.password.first-login.form');
    Route::post('/students/{id}/first-login', [StudentController::class, 'submitFirstLoginChangePassword'])->name('student.password.first-login.submit');
});

Route::get('/demo', [PagesController::class, 'demo']);

Route::get('/demo-data', function () {
    return response()->json([
        'message' => 'Hello from Laravel AJAX ðŸš€',
    ]);
});
// Route::get('/welcome', [PSUController::class,'welcome'])->name('welcome');
// Route::get('/mission', [PSUController::class,'mission'])->name('mission');
// Route::get('/vision', [PSUController::class,'vision'])->name('vision');
// Route::get('/EOMSPolicy', [PSUController::class,'EOMSPolicy'])->name('EOMSPolicy');
// Route::get('/student/{name}/{course}', [PSUController::class,'student'])->name('psu.student');

// Route::resource('/client',ClientController::class);






//Route::prefix('admin')->group(
   // function () {
   // Route::get('/dashboard', function () {
   //     return "This is the dashboard page for admin";
   // });
   // Route::get('/profile', function () {
   //     return "This is the profile page for admin";
   // });
   // Route::get('/configuration', function () {
   //     return "This is the configuration page for admin";
   // });
//});

//task 1:
// Route::get('/home', function () {
//     return "Iam john carlo. welcome to the home page";
// })->name('home.page');

// // task 2
// Route::get('/redirect-home', function () {
//     return redirect()->route('home.page');
// });

// // task 3
// Route::get('/greet/{name}', function ($name) {
//     return "Hello: " . $name;
// })->name('user.page');

// // task 4
// Route::get('/student/{name?}', function ($name = "John Carlo") {
//     return "Hello: {$name} ";
// });


// //task 5
// Route::prefix('administrator')->group(
//  function () {
//    Route::get('/dashboard', function () {
//         return "Dashboards";
//     })->name('dashboard.page');
//     Route::get('/profile', function () {
//         return "Welcome to my Profile";
//     });
//     Route::get('/settings', function () {
//         return "setting page";
//     });
// });

// //task 6
// Route::get('/redirectAdminDashboard', function () {
//     return redirect()->route('dashboard.page');
// });
// routing and resource controller
//when inputing data or CRUD its better to use resource controller rather than routing

//php artisan migration make:model Student -m or --migration //automatic to
//create migration

//next php artisan migrate after mo sya gawan ng attributes
