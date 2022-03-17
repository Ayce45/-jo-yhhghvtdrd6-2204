<?php

use App\Http\Controllers\FileUpload;
use Illuminate\Support\Facades\Route;

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

Route::get('login', [Controller::class, 'login'])->name('login');

  Route::get('/', [FileUpload::class, 'createForm']);
  Route::post('/upload-file', [FileUpload::class, 'fileUpload'])->name('fileUpload');
  Route::get('/files/{file}/download', [FileUpload::class, 'fileDownload'])->name('fileDownload');

  /**
 * BEGIN: Injected from .gp/snippets/laravel/routes/web/allow-mixed-web.snippet
 */

$url = config('app.url');
resolve(\Illuminate\Routing\UrlGenerator::class)->forceRootUrl($url);
resolve(\Illuminate\Routing\UrlGenerator::class)->forceScheme('https');

 /**
 * END: Injected from .gp/snippets/laravel/routes/web/allow-mixed-web.snippet
 */
