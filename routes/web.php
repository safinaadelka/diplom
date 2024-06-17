<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\KursController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\RegLogController;
use App\Http\Controllers\StudyController;
use App\Http\Controllers\WordController;
use App\Models\Kurs;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Word;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\text;


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
})->name('home');




Route::get('/modul/{id}', function ($id) {
    return view('modul', ['lessons' => Lesson::all()], ['kurs' => Kurs::findOrFail($id)]);
})->name('modul');



Route::controller(RegLogController::class)->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', 'edit')->name('login');
        Route::post('/login', 'login');


        Route::get('/register', 'create');
        Route::post('/register', 'register');
    });

    Route::middleware('auth')->group(function () {
        Route::post('/logout', 'logout');

        // Route::get('/lesson', function () {
        //     return view('lesson');
        // })->name('lesson');


        Route::get('/profile', function () {
            if (Auth::user() && Auth::user()->role_id == 2) {
                return view('profile');
            } else if (Auth::user() && Auth::user()->role_id == 3) {
                return redirect(route('admin'));
            }
        })->name('profile');

        // Route::get('/lesson/{id}', function ($id) {
        //     return view('lesson', ['lessons' => Lesson::all()], ['lesson' => Lesson::findOrFail($id)]);
        // });
        Route::get('/modul/{id}/lesson/{id_lesson}', function ($id, $id_lesson) {
            return view('lesson', ['id' => $id, 'id_lesson' => $id_lesson, 'lessons' => Lesson::all(), 'lesson' => Lesson::findOrFail($id_lesson), 'kurs' => Kurs::findOrFail($id)]);
        })->name('modul_lesson');


        Route::controller(WordController::class)->group(function (){
            Route::post('/save_dictionary' , 'save_dictionary'); 
            Route::post('/delete_dictionary' , 'delete_dictionary'); 
            Route::post('/learn_dictionary' , 'learn_dictionary'); 
            Route::post('/forget_dictionary' , 'forget_dictionary');
        }); 
        

        Route::post('/edit_profile', 'update');
        Route::post('/edit_password', 'edit_password');
    });
});


Route::middleware('admin')->group(function () {
    Route::controller(LessonController::class)->group(function () {
        Route::post('/add_lesson', 'add_lesson');

        Route::post('/lesson/{id}/edit', 'update');

        Route::get('/add', function () {
            return view('add')->with('words', Word::all());
        })->name('add');

        // Route::get('/fuck', 'fuck')->name('fuck');
        // Route::post('/fuck','fuck')->name('add_lesson');
        Route::post('/lesson/{id}/delete', 'destroy')->name('destroy_lesson');

        Route::get('/lesson/{id}/edit', function ($id) {
            return view('edit', ['lesson' => Lesson::findOrFail($id)], ['words' => Word::all()]);
        });
    });


    Route::controller(WordController::class)->group(function () {
        Route::post('/add_word', 'create');

        Route::post('/add_ajax_word', 'createAjax');
        
        Route::post('/word/{id}/delete', 'destroy')->name('destroy_word');
        Route::post('/word/{id}/edit', 'update')->name('update_word');
        
    });


    Route::controller(KursController::class)->group(function () {
        Route::get('/add_kurs', 'create');
        Route::post('/add_kurs', 'add_kurs');


        Route::get('/edit_kurs/{id}', function ($id) {
            return view('edit_kurs', ['kurs' => Kurs::findOrFail($id)]);
        });
        Route::get('/hide_kurs/{id}', 'hide_kurs');
        Route::get('/publish_kurs/{id}', 'publish_kurs');

        Route::post('/edit_kurs/edit_kurs/{id}', 'edit_kurs');

        // Route::post('/edit_kurs/edit_kurs/{id}', 'edit_kurs')->name('edit_kurs');
        // Route::get('/word/{id}/delete', 'destroy')->name('destroy_word');
        // Route::post('/word/{id}/edit', 'update')->name('update_word');
    });


});



Route::middleware('admin')->group(function () {
    Route::get('/admin', function () {
        return view('admin', ['lessons' => Lesson::all()], ['words' => Word::all()], ['users' => User::all()])->with('user', Auth::user());
    })->name('admin');
});



Route::controller(StudyController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/modul/{id}/lesson/{id_lesson}/done', 'done_lesson');
        Route::get('/modul/{id}/lesson/{id_lesson}/stop', 'stop_lesson');
        Route::post('/delete_study/{id}', 'delete_study');
        Route::post('/create_study/{id}', 'create_study');
    });
});

Route::controller(CertificateController::class)->group(function ($id) {
    Route::get('/generate-certificate/{id}', 'generate')->name('generate.certificate');

    Route::get('/certificate/{id}', function ($id) {
        return view('certificate', ['id' => $id, 'kurs' => Kurs::findOrFail($id)]);
    })->name('certificate');
});



Route::get('/test', function () {
    return view('test');
});
