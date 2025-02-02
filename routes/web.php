<?php

use App\Http\Controllers\Admin\CatigoriesController;
use App\Http\Controllers\Admin\EvaluationController;
use App\Http\Controllers\Admin\SupportManageController;
use App\Http\Controllers\Admin\TicketAdminController;
use App\Http\Controllers\Admin\UserManageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Support\TicketSupportController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\User\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('user.login');
});



//////////////////////////////// ALL ROUTE FOR Admin////////////////////////////////////////

Route::get('/admin/login', [AdminController::class, 'Adminlogin'])->name('admin.login');
Route::post('/admin/login_submit', [AdminController::class, 'AdminloginSubmit'])->name('admin.login_submit');
Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

Route::middleware('admin')->prefix('/admin')->group(function (){
    Route::get('/dashboard',[AdminController::class,'AdminDashboard'])->name('admin.dashboard');

    //Catigory
    Route::get('/catigories',[CatigoriesController::class,'showCatigories'])->name('admin.showCatigories');
    Route::post('/catigories/add',[CatigoriesController::class,'addCatigory'])->name('admin.addCatigory');
    Route::get('/catigories/destroy/{id}',[CatigoriesController::class,'destroyCatigory'])->name('admin.destroyCatigory');
    Route::put('/catigories/update/{id}', [CatigoriesController::class, 'updateCatigory'])->name('admin.updateCatigory');

    //sub Catigory
    Route::get('/sub-catigories',[CatigoriesController::class,'showSubCatigories'])->name('admin.showSubCatigories');
    Route::post('/sub-catigories/add',[CatigoriesController::class,'addSubCategory'])->name('admin.addSubCategory');
    Route::get('/sub-catigories/destroy/{id}',[CatigoriesController::class,'destroySubCatigory'])->name('admin.destroySubCatigory');
    Route::put('/sub-catigories/update/{id}', [CatigoriesController::class, 'updateSubCatigory'])->name('admin.updateSubCatigory');

    //Supports
    Route::get('/manage/support',[SupportManageController::class,'index'])->name('admin.support');
    Route::post('/manage/support/store',[SupportManageController::class,'store'])->name('admin.supportStore');
    Route::get('/manage/support/destroy/{id}',[SupportManageController::class,'destroy'])->name('admin.destroySupport');
    Route::get('/manage/support/toggle/{id}', [SupportManageController::class, 'toggleStatus'])->name('admin.toggleSupportStatus');
    Route::put('/manage/support/update/{id}', [SupportManageController::class, 'update'])->name('admin.updateSupport');

    //Users
    Route::get('/manage/user',[UserManageController::class,'index'])->name('admin.user');
    Route::post('/manage/user/store',[UserManageController::class,'store'])->name('admin.usertStore');
    Route::get('/manage/user/destroy/{id}',[UserManageController::class,'destroy'])->name('admin.destroyUser');
    Route::get('/manage/user/toggle/{id}', [UserManageController::class, 'toggleStatus'])->name('admin.toggleUserStatus');
    Route::put('/manage/user/update/{id}', [UserManageController::class, 'update'])->name('admin.updateUser');
    Route::post('users-import', [UserManageController::class, 'import'])->name('users.import');

    //Tickets
    Route::get('/all-tickets',[TicketAdminController::class,'index'])->name('admin.AllTickets');
    Route::get('/tickets-complete',[TicketAdminController::class,'completeTickets'])->name('admin.completeTickets');
    Route::get('/export-tickets',[TicketAdminController::class,'exportData'])->name('admin.exportData');
    Route::get('/assignTo/{ticket_id}/{support_id}',[TicketAdminController::class,'assignTo'])->name('admin.assignTo');
    Route::get('/ticket/destroy/{id}',[TicketAdminController::class,'destroy'])->name('admin.destroyTicket');
    Route::get('/show-ticket/{ticket}/notify_id/{notify_id}',[TicketAdminController::class,'show'])->name('admin.ShowTickets');
    Route::get('/download-fileTicket/{file}',[TicketAdminController::class,'downloadFile'])->name('admin.DownloadFileTickets');
    //Evaluation
    Route::get('/show-valuation',[EvaluationController::class,'index'])->name('admin.ShowEvaluation');
    Route::post('/evaluation',[EvaluationController::class,'evaluation'])->name('admin.Evaluation');

    //approve
    Route::get('/add-approve', function () {return view('layouts.admin.backend.approval');})->name('admin.addapproval');
}); // End middleware Admin






//////////////////////////////// ALL ROUTE FOR Support////////////////////////////////////////

Route::prefix('/support')->group(function (){
Route::get('/login', [SupportController::class, 'supportlogin'])->name('support.login');
Route::post('/login_submit', [SupportController::class, 'supportloginSubmit'])->name('support.login_submit');
Route::get('/logout', [SupportController::class, 'supportLogout'])->name('support.logout');

Route::get('/security-view', [SupportController::class, 'securityPasswordView'])->name('support.securityPasswordView');
Route::post('/security-password', [SupportController::class, 'securityPassword'])->name('support.securityPassword');
});

Route::middleware(['support', 'supportStatus' , 'SupportSecurityPass'])->prefix('/support')->group(function (){
    Route::get('/main',[SupportController::class,'SupportMain'])->name('support.main');
    Route::get('/support' , function(){view('layouts.support.master');});

//Tickets
Route::get('/all-tickets',[TicketSupportController::class,'index'])->name('support.AllTickets');
Route::get('/tickets-complete',[TicketSupportController::class,'completeTickets'])->name('support.completeTickets');
Route::get('/export-tickets',[TicketSupportController::class,'exportData'])->name('support.exportData');
Route::get('/close-ticket/{ticket_id}',[TicketSupportController::class,'closeTicket'])->name('support.closeTicket');
Route::get('/download-fileTicket/{file}',[TicketSupportController::class,'downloadFile'])->name('support.DownloadFileTickets');

}); // End middleware Support



//////////////////////////////// ALL ROUTE FOR User////////////////////////////////////////

Route::prefix('/user')->group(function (){
    Route::get('/login', [UserController::class, 'userlogin'])->name('user.login');
    Route::post('/login_submit', [UserController::class, 'userloginSubmit'])->name('user.login_submit');
    Route::get('/logout', [UserController::class, 'userLogout'])->name('user.logout');

    Route::get('/security-view', [UserController::class, 'securityPasswordView'])->name('user.securityPasswordView');
    Route::post('/security-password', [UserController::class, 'securityPassword'])->name('user.securityPassword');
});

Route::middleware(['user','UserStatus','UserSecurityPass'])->prefix('/user')->group(function (){
    Route::get('/main',[UserController::class,'UserMain'])->name('user.main');
    Route::get('/' , function(){view('layouts.user.master');});

    Route::get('/all-tickets',[TicketController::class,'index'])->name('user.AllTickets');
    Route::get('/add-ticket',[TicketController::class,'addTicket'])->name('user.addTickets');
    Route::post('/add-ticket/store',[TicketController::class,'store'])->name('user.storeTickets');
    Route::get('/get-sub-categories', [TicketController::class, 'getSubCategories'])->name('user.getSubCategories');

    Route::get('/all-approvel', function () {return view('layouts.user.backend.approval-user');})->name('user.allapproval');
}); // End middleware User

// Route::get('/pusher', function () {
//     return view('empty');
// });



