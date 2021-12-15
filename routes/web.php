<?php

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


use App\Http\Controllers\AcceptAnswerController;
use App\Http\Controllers\AnswersController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\VoteQuestionController;

Auth::routes();

Route::get('/', [HomeController::class, 'index']);

Route::resource('questions', QuestionsController::class)->except('show', 'store');
Route::post('/questions/store', [QuestionsController::class, 'store'])->name('questions.store');

Route::post('/questions/{question}/answers', [AnswersController::class, 'store'])->name('answers.store');
Route::resource('questions.answers', AnswersController::class)->except(['create', 'show']);
Route::get('/questions/{slug}', [QuestionsController::class, 'show'])->name('questions.show');
Route::post('/answers/{answer}/accept', AcceptAnswerController::class)->name('answers.accept');

Route::post('/answers/{reply}/favorites', [FavoritesController::class, 'store'])->name('answers.favorite');
Route::delete('/answers/{reply}/favorites', [FavoritesController::class, 'destroy'])->name('answers.unfavorite');

Route::post('/questions/{question}/favorites', [FavoritesController::class, 'store'])->name('questions.favorite');
Route::delete('/questions/{question}/favorites', [FavoritesController::class, 'destroy'])->name('questions.unfavorite');

Route::post('/questions/{question}/vote', VoteQuestionController::class);
Route::post('/answers/{answer}/vote', VoteQuestionController::class);

Route::resource('tags', AnswersController::class)->except(['show']);

Route::get('/tags/{tag:slug }', [TagsController::class, 'show'])->name('tag.show');

Route::post('question/{question}/comment', [CommentController::class, 'store'])->name('comment.store');
Route::post('comment/{comment}/reply', [CommentController::class, 'replyStore'])->name('reply.store');

Route::get('/profile/{users:slug}', [ProfilesController::class, 'show'])->name('profile.show');

