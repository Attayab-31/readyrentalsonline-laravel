<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\superAdminAccess;
use App\Http\Middleware\AdminAccess;
use App\Http\Controllers\InvoicePaymentController;
use App\Http\Controllers\StripeWebhookController;



Route::get('/invoices/pay/{i_invoice_number}', [InvoicePaymentController::class, 'pay_invoice'])->name('invoices.pay');
Route::post('/create-intent-for-ach-payment', [InvoicePaymentController::class, 'createIntentForACHPayment'])->name('stripe.createIntentForACHPayment');
Route::post('/verify-microdeposits-for-ACH', [InvoicePaymentController::class, 'verifyMicrodeposits_for_ACH']);
Route::post('/stripe/webhook', [StripeWebhookController::class, 'handleWebhook']);
Route::post('/process-card-payment', [InvoicePaymentController::class, 'processCardPayment'])->name('stripe.processCardPayment');


 Route::post('/share-property', [App\Http\Controllers\PropertyController::class, 'shareProperty'])->name('share.property');


Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index']);
Route::get('/about-us', [App\Http\Controllers\WelcomeController::class, 'about_us']);
Route::get('/terms-and-conditions-for-applications', [App\Http\Controllers\PageController::class, 'terms_and_conditions_for_applications']);
 
Route::get('/contact-us', [App\Http\Controllers\WelcomeController::class, 'contact_us']);
Route::post('contact-us/process-form', [App\Http\Controllers\WelcomeController::class, 'process_form']);

Route::get('our-properties', [App\Http\Controllers\PropertyController::class, 'index']);
Route::get('properties/explore-details/{p_slug}', [App\Http\Controllers\PropertyController::class, 'property_details']);
Route::post('properties/process-inquiry-form', [App\Http\Controllers\PropertyController::class, 'process_inquiry_form']);

Route::get('applications', [App\Http\Controllers\PropertyController::class, 'applications']);

Route::get('applications/apply-online', [App\Http\Controllers\PropertyController::class, 'apply_online']);
Route::post('applications/apply-online/process-form', [App\Http\Controllers\PropertyController::class, 'apply_online_process_form']);
    

Route::get('applications/submit-application-form', [App\Http\Controllers\PropertyController::class, 'apply_with_form_as_attachment']);
Route::post('applications/submit-application-form/process-form', [App\Http\Controllers\PropertyController::class, 'apply_with_form_as_attachment_process_form']);

Route::get('applications/upload-application-form', [App\Http\Controllers\PropertyController::class, 'upload_application']);
Route::post('applications/upload-application-form/process-form', [App\Http\Controllers\PropertyController::class, 'upload_application_process_form']);
 
Route::get('application-form-wizard', [App\Http\Controllers\PropertyController::class, 'application_form_wizard_with_steps']);

  


// Routes for Online Application With Steps Start Here
Route::get('online-application', [App\Http\Controllers\PropertyController::class, 'online_application']);
Route::post('process-online-application', [App\Http\Controllers\PropertyController::class, 'process_online_application']);


Route::get('online-application/step-2/{pa_tracking_id}', [App\Http\Controllers\PropertyController::class, 'online_application_step_2']);
Route::post('process-online-application/step-2/{pa_tracking_id}', [App\Http\Controllers\PropertyController::class, 'process_online_application_step_2']);


Route::get('online-application/step-3/{pa_tracking_id}', [App\Http\Controllers\PropertyController::class, 'online_application_step_3']);
Route::post('process-online-application/step-3/{pa_tracking_id}', [App\Http\Controllers\PropertyController::class, 'process_online_application_step_3']);


Route::get('online-application/step-4/{pa_tracking_id}', [App\Http\Controllers\PropertyController::class, 'online_application_step_4']);
Route::post('process-online-application/step-4/{pa_tracking_id}', [App\Http\Controllers\PropertyController::class, 'process_online_application_step_4']);

Route::get('online-application/step-5/{pa_tracking_id}', [App\Http\Controllers\PropertyController::class, 'online_application_step_5']);
Route::post('process-online-application/step-5/{pa_tracking_id}', [App\Http\Controllers\PropertyController::class, 'process_online_application_step_5']);

Route::get('online-application/step-6/{pa_tracking_id}', [App\Http\Controllers\PropertyController::class, 'online_application_step_6']);
Route::post('process-online-application/step-6/{pa_tracking_id}', [App\Http\Controllers\PropertyController::class, 'process_online_application_step_6']);

Route::get('online-application/step-7/{pa_tracking_id}', [App\Http\Controllers\PropertyController::class, 'online_application_step_7']);
Route::post('process-online-application/step-7/{pa_tracking_id}', [App\Http\Controllers\PropertyController::class, 'process_online_application_step_7']);

Route::get('online-application/step-8/{pa_tracking_id}', [App\Http\Controllers\PropertyController::class, 'online_application_step_8']);
Route::post('process-online-application/step-8/{pa_tracking_id}', [App\Http\Controllers\PropertyController::class, 'process_online_application_step_8']);

Route::get('online-application/step-9/{pa_tracking_id}', [App\Http\Controllers\PropertyController::class, 'online_application_step_9']);
Route::post('process-online-application/step-9/{pa_tracking_id}', [App\Http\Controllers\PropertyController::class, 'process_online_application_step_9']);
// Routes for Online Application With Steps End Here
 

// Route::get('/invoices/pay/{i_invoice_number}', [App\Http\Controllers\WelcomeController::class, 'pay_invoice'])->name('WelcomeController.pay_invoice');
// Route::post('/invoices/process-invoice-payment/{i_invoice_number}', [App\Http\Controllers\WelcomeController::class, 'process_invoice_payment'])->name('WelcomeController.process_invoice_payment');

Route::get('/send-unread-message-email-alert', [App\Http\Controllers\WelcomeController::class, 'sendUnreadMessagesAlert'])->name('WelcomeController.sendUnreadMessagesAlert');




Route::post('/complete-payment', [App\Http\Controllers\WelcomeController::class, 'completePayment'])->name('WelcomeController.completePayment');
Route::post('/create-payment-intent', [App\Http\Controllers\WelcomeController::class, 'createPaymentIntent'])->name('WelcomeController.createPaymentIntent');







Route::prefix('accounts')->middleware(['auth'])->group(function ()
{
    Route::get('/', [App\Http\Controllers\Account\AccountController::class, 'index'])->name('AccountController.index');
    
    // User Profile Updates 
    Route::get('/edit-profile',[App\Http\Controllers\Account\ProfileController::class, 'index']);
    Route::post('/update-profile',[App\Http\Controllers\Account\ProfileController::class, 'update']);

    // Chat UI
    Route::get('/chat', [App\Http\Controllers\Account\ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/messages/{unique_identifier}', [App\Http\Controllers\Account\ChatController::class, 'fetchMessages'])->name('chat.fetchMessages');
    Route::post('/chat/send', [App\Http\Controllers\Account\ChatController::class, 'sendMessage'])->name('chat.send');
    Route::post('chat/fetch-new-messages', [App\Http\Controllers\Account\ChatController::class, 'fetchNewMessages']);
    

    Route::get('/chat/print_converstaion/{unique_identifier}', [App\Http\Controllers\Account\ChatController::class, 'print_conversation'])->name('chat.print_conversation');
    Route::get('/chat/delete_converstaion/{unique_identifier}', [App\Http\Controllers\Account\ChatController::class, 'delete_conversation'])->name('chat.delete_conversation');
 


    // Chat UI
    Route::get('/invoices', [App\Http\Controllers\Account\InvoiceController::class, 'index'])->name('InvoiceController.index');

    Route::middleware([AdminAccess::class])->group(function ()
    {   
        Route::get('/invoices/delete/{id}', [App\Http\Controllers\Account\InvoiceController::class, 'delete'])->name('InvoiceController.delete');
        Route::get('/invoices/create', [App\Http\Controllers\Account\InvoiceController::class, 'create'])->name('InvoiceController.create');
        Route::post('/invoices/store', [App\Http\Controllers\Account\InvoiceController::class, 'store'])->name('InvoiceController.store');
        Route::get('/invoices/edit/{id}', [App\Http\Controllers\Account\InvoiceController::class, 'edit'])->name('InvoiceController.edit');
        Route::post('/invoices/update/{id}', [App\Http\Controllers\Account\InvoiceController::class, 'update'])->name('InvoiceController.update');
        Route::get('/invoices/view/{id}', [App\Http\Controllers\Account\InvoiceController::class, 'viewDetails'])->name('InvoiceController.viewDetails');

        
        // App Caches
        Route::get('caches/clear-app-cache', [App\Http\Controllers\Account\AccountController::class, 'clearAppCache'])->name('AccountController.clearAppCache');
        Route::get('caches/clear-content-cache', [App\Http\Controllers\Account\AccountController::class, 'cacheContentCache'])->name('AccountController.cacheContentCache');


        // Users
        Route::get('/users/resend-verification-email/{user_id?}', [App\Http\Controllers\Account\UserController::class, 'resend_verification_email_to_all_unverified_users'])->name('users.resend_verification_email_to_all_unverified_users');
        Route::post('/users/delete-users-in-bulk', [App\Http\Controllers\Account\UserController::class, 'delete_users_in_bulk'])->name('users.delete_users_in_bulk');
        Route::get('/users/delete/{id}', [App\Http\Controllers\Account\UserController::class, 'delete'])->name('users.delete');
        Route::get('/users/update-status/{id}/{status}', [App\Http\Controllers\Account\UserController::class, 'update_status'])->name('users.update_status');
        Route::resource('users', App\Http\Controllers\Account\UserController::class);
         
        
        Route::get('/properties/applications', [App\Http\Controllers\Account\PropertyController::class,'application_listings']);
        Route::get('/properties/view-application-details/{appplication_id}', [App\Http\Controllers\Account\PropertyController::class,'application_details']);
        Route::get('/properties/print-application-details/{appplication_id}',[App\Http\Controllers\Account\PropertyController::class,'print_application_details']);
        Route::get('/properties/applications/delete-permanently/{appplication_id}', [App\Http\Controllers\Account\PropertyController::class,'delete_application_permanently']);
        Route::get('/properties/delete-property-permanently/{id}', [App\Http\Controllers\Account\PropertyController::class,'delete_property_permanently']);
        Route::get('/properties/change-active-status/{id}/{status}', [App\Http\Controllers\Account\PropertyController::class,'change_activate_status']);
        Route::resource('properties', App\Http\Controllers\Account\PropertyController::class);

    });
 
});



require __DIR__.'/auth.php';
