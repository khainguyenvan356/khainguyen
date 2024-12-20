<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IssueController;


Route::get('/', [IssueController::class, 'index']); // Định nghĩa route mặc định
Route::resource('issues', IssueController::class); // Các route cho các hành động khác