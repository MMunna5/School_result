<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolResultController;
Route::get('/',fn()=>view('index')); Route::get('/marksheet.html',fn()=>view('marksheet'));
foreach(['admin-login','admin','classes','subjects','exams','individual-result','bulk-result','result-list','merit-list','tabulation','statistics','users','change-password','result-search'] as $p) Route::get('/pages/'.$p.'.html',fn()=>view('pages.'.$p));
Route::prefix('api')->group(function(){
 Route::get('/result/options',[SchoolResultController::class,'publicOptions']); Route::get('/result/search',[SchoolResultController::class,'publicSearch']); Route::get('/result/marksheet.pdf',[SchoolResultController::class,'publicPdf']);
 Route::post('/admin/login',[SchoolResultController::class,'login']); Route::post('/admin/logout',[SchoolResultController::class,'logout']); Route::get('/admin/me',[SchoolResultController::class,'me']);
 Route::middleware('web')->group(function(){
  Route::post('/admin/change-password',[SchoolResultController::class,'changePassword']);
  Route::get('/admin/classes',[SchoolResultController::class,'classes']); Route::post('/admin/classes',[SchoolResultController::class,'createClass']); Route::delete('/admin/classes/{id}',[SchoolResultController::class,'deleteClass']);
  Route::get('/admin/subjects',[SchoolResultController::class,'subjects']); Route::post('/admin/subjects',[SchoolResultController::class,'createSubject']); Route::delete('/admin/subjects/{id}',[SchoolResultController::class,'deleteSubject']);
  Route::get('/admin/exams',[SchoolResultController::class,'exams']); Route::post('/admin/exams',[SchoolResultController::class,'createExam']); Route::delete('/admin/exams/{id}',[SchoolResultController::class,'deleteExam']);
  Route::get('/admin/results',[SchoolResultController::class,'results']); Route::get('/admin/results/{id}',[SchoolResultController::class,'result']); Route::post('/admin/results/individual',[SchoolResultController::class,'createResult']); Route::put('/admin/results/{id}',[SchoolResultController::class,'updateResult']); Route::delete('/admin/results/{id}',[SchoolResultController::class,'deleteResult']); Route::put('/admin/results/{id}/publish',[SchoolResultController::class,'publish']); Route::put('/admin/results/{id}/unpublish',[SchoolResultController::class,'unpublish']); Route::delete('/admin/results/bulk',[SchoolResultController::class,'bulkDelete']); Route::post('/admin/results/publish-bulk',[SchoolResultController::class,'bulkPublish']); Route::get('/admin/dashboard-stats',[SchoolResultController::class,'dashboardStats']);
  Route::get('/admin/reports/options',[SchoolResultController::class,'reportOptions']); Route::get('/admin/reports/merit',[SchoolResultController::class,'merit']); Route::get('/admin/reports/tabulation',[SchoolResultController::class,'tabulation']); Route::get('/admin/reports/statistics',[SchoolResultController::class,'statistics']); Route::get('/admin/reports/marksheets.pdf',[SchoolResultController::class,'marksheetsPdf']);
  Route::get('/admin/export/results.csv',[SchoolResultController::class,'exportCsv']); Route::get('/admin/export/results.xlsx',[SchoolResultController::class,'exportXlsx']); Route::get('/admin/backup',[SchoolResultController::class,'backup']);
  Route::post('/admin/bulk-preview',[SchoolResultController::class,'bulkPreview']); Route::post('/admin/bulk-import',[SchoolResultController::class,'bulkImport']); Route::get('/admin/download-excel-demo',[SchoolResultController::class,'downloadExcelDemo']);
  Route::get('/admin/users',[SchoolResultController::class,'users']); Route::post('/admin/users',[SchoolResultController::class,'createUser']); Route::put('/admin/users/{id}',[SchoolResultController::class,'updateUser']); Route::post('/admin/users/{id}/reset-password',[SchoolResultController::class,'resetPassword']); Route::get('/admin/audit',[SchoolResultController::class,'audit']);
 });
});
Route::get('/verify/{id}/{sig}',[SchoolResultController::class,'verify']);
Route::get('/healthz',fn()=>response()->json(['ok'=>true]));