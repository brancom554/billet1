<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\UserSignupApiController;
use App\Http\Controllers\API\UserLoginApiController;
use App\Http\Controllers\API\UserLogoutApiController;
use App\Http\Controllers\API\UserApiController;
use App\Http\Controllers\API\OrganiserViewApiController;
use App\Http\Controllers\API\OrganiserApiController;
use App\Http\Controllers\API\OrganiserDashboardApiController;
use App\Http\Controllers\API\OrganiserCustomizeApiController;
use App\Http\Controllers\API\OrganiserEventsApiController;
use App\Http\Controllers\API\EventsApiController;
use App\Http\Controllers\API\EventDashboardApiController;
use App\Http\Controllers\API\EventAccessCodesApiController;
use App\Http\Controllers\API\EventAttendeesApiController;
use App\Http\Controllers\API\EventCheckInApiController;
use App\Http\Controllers\API\EventCheckoutApiController;
use App\Http\Controllers\API\EventCustomizeApiController;
use App\Http\Controllers\API\EventOrdersApiController;
use App\Http\Controllers\API\EventPromoteApiController;
use App\Http\Controllers\API\EventSurveyApiController;
use App\Http\Controllers\API\EventTicketsApiController;
use App\Http\Controllers\API\EventViewApiController;
use App\Http\Controllers\API\EventViewEmbeddedApiController;
use App\Http\Controllers\API\EventWidgetsApiController;
use App\Http\Controllers\API\RemindersApiController;














/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

/*
 * ---------------
 * Organisers
 * ---------------
 */


/*
 * ---------------
 * Events
 * ---------------
 */
// Route::resource('events', API\EventsApiController::class);


/*
 * ---------------
 * Attendees
 * ---------------
 */
// Route::resource('attendees', API\AttendeesApiController::class);


/*
 * ---------------
 * Orders
 * ---------------
 */

/*
 * ---------------
 * Users
 * ---------------
 */

Route::group(['middleware' =>  'api', 'prefix' => 'auth'], function ($router) {

    /*
    * Login
    */
    Route::post('/login',[UserLoginApiController::class, 'postLogin'])->name('api.login');

    /*
    * Forgot password
    */
    // Route::get('login/forgot-password',
    // [RemindersApiController::class, 'getRemind'])->name('forgotPassword');

    // Route::post('login/forgot-password',
    // [RemindersApiController::class, 'postRemind'])->name('postForgotPassword');

    /*
    * Reset Password
    */
    // Route::get('login/reset-password/{token}',
    // [RemindersApiController::class, 'getReset'])->name('password.reset');

    // Route::post('login/reset-password',
    // [RemindersApiController::class, 'postReset'])->name('postResetPassword');

     /*
    * Registration / Account creation
    */

    Route::get('/signup', [UserSignupApiController::class, 'showSignup'])->name('showSignup');
    Route::post('signup', [UserSignupApiController::class, 'postSignup']);

    /*
    * Confirm Email
    */
    Route::get('signup/confirm_email/{confirmation_code}', 
    [UserSignupApiController::class, 'confirmEmail'])->name('confirmEmail');
});

    


Route::group(['middleware' => ['jwt.verify']], function() {

    Route::get('/events',
    [EventsApiController::class, 'getAllEvents'])->name('getAllEvents');  
    
    Route::get('/eventD/{event_id}',
    [EventsApiController::class, 'getEventDetails'])->name('getEventDetails');

    /*
     * Logout
     */
    Route::post('/logout', [UserLogoutApiController::class, 'doLogout'])->name('logout');

    
        Route::group(['prefix' => 'user'], function () {

        /*
        * Edit User
        */
        
            Route::get('/',
                [UserApiController::class, 'showEditUser']
            )->name('showEditUser');

            Route::post('/',
                [UserApiController::class, 'postEditUser']
            )->name('postEditUser');

        });

        /*
        * Public organiser page routes
        */

        Route::group(['prefix' => 'organiser_public'], function () {

            Route::get('/{organiser_id}/{organier_slug?}',
                [OrganiserViewApiController::class, 'showOrganiserHome']
            )->name('showOrganiserHome');

        });

        Route::group(['prefix' => 'e'], function () {

            /*
             * Embedded events
             */
            // Route::get('/{event_id}/embed',
            //     [EventViewEmbeddedController::class, 'showEmbeddedEvent']
            // )->name('showEmbeddedEventPage');
    
            // Route::get('/{event_id}/calendar.ics',
            //     [EventViewController::class, 'showCalendarIcs']
            // )->name('downloadCalendarIcs');
    
            // Route::get('/{event_id}/{event_slug?}',
            //     [EventViewController::class, 'showEventHome']
            // )->name('showEventPage');
    
            // Route::post('/{event_id}/contact_organiser',
            //     [EventViewController::class, 'postContactOrganiser']
            // )->name('postContactOrganiser');
    
            // Route::post('/{event_id}/show_hidden',
            //     [EventViewController::class, 'postShowHiddenTickets']
            // )->name('postShowHiddenTickets');
    
            /*
             * Used for previewing designs in the backend. Doesn't log page views etc.
             */
            // Route::get('/{event_id}/preview',
            //     [EventViewController::class, 'showEventHomePreview']
            // )->name('showEventPagePreview');
    
            Route::post('{event_id}/checkout/',
                [EventCheckoutApiController::class, 'postValidateTickets']
            )->name('postValidateTickets');
    
            Route::post('{event_id}/checkout/validate',
                [EventCheckoutApiController::class, 'postValidateOrder']
            )->name('postValidateOrder');
    
            Route::get('{event_id}/checkout/payment',
                [EventCheckoutApiController::class, 'showEventPayment']
            )->name('showEventPayment');
    
            Route::get('{event_id}/checkout/create',
                [EventCheckoutApiController::class, 'showEventCheckout']
            )->name('showEventCheckout');
    
            Route::get('{event_id}/checkout/success',
                [EventCheckoutApiController::class, 'showEventCheckoutPaymentReturn']
            )->name('showEventCheckoutPaymentReturn');
    
            Route::post('{event_id}/checkout/create',
                [EventCheckoutApiController::class, 'postCreateOrder']
            )->name('postCreateOrder');
        });

        /*
         * Organiser routes
         */
        Route::group(['prefix' => 'organiser'], function () {

            Route::get('{organiser_id}/dashboard',
                [OrganiserDashboardApiController::class, 'showDashboard']
            )->name('showOrganiserDashboard');

            Route::get('{organiser_id}/events',
                [OrganiserEventsApiController::class, 'showEvents']
            )->name('showOrganiserEvents');

            Route::get('{organiser_id}/customize',
                [OrganiserCustomizeApiController::class, 'showCustomize']
            )->name('showOrganiserCustomize');

            Route::post('{organiser_id}/customize',
                [OrganiserCustomizeApiController::class, 'postEditOrganiser']
            )->name('postEditOrganiser');

            Route::post('create',
                [OrganiserApiController::class, 'postCreateOrganiser']
            )->name('postCreateOrganiser');

            Route::post('{organiser_id}/page_design',
                [OrganiserCustomizeApiController::class, 'postEditOrganiserPageDesign']
            )->name('postEditOrganiserPageDesign');
        });

    });

     /*
         * Events dashboard
         */
        Route::group(['prefix' => 'events'], function () {

            /*
             * ----------
             * Create Event
             * ----------
             */
            Route::get('/show',
                [EventsApiController::class, 'showCreateEvent']
            )->name('showCreateEvent');

            Route::post('/create',
                [EventsApiController::class, 'postCreateEvent']
            )->name('postCreateEvent');

            // Route::get('/',
            //     [EventsApiController::class, 'getAllEvents']
            // )->name('getAllEvents');
        });

          /*
         * Upload event images
         */
        Route::post('/upload_image',
            [EventsApiController::class, 'postUploadEventImage']
        )->name('postUploadEventImage');

        Route::group(['prefix' => 'event'], function () {

            /*
             * Dashboard
             */
            Route::get('{event_id}/dashboard/',
                [EventDashboardApiController::class, 'showDashboard']
            )->name('showEventDashboard');

            Route::get('{event_id}/',
                [EventDashboardApiController::class, 'redirectToDashboard']
            );

            Route::get('{event_id}/go_live',
                [EventsApiController::class, 'makeEventLive']
            )->name('MakeEventLive');

            /*
             * -------
             * Tickets
             * -------
             */
            Route::get('{event_id}/tickets/',
                [EventTicketsApiController::class, 'showTickets']
            )->name('showEventTickets');

            Route::get('{event_id}/tickets/edit/{ticket_id}',
                [EventTicketsApiController::class, 'showEditTicket']
            )->name('showEditTicket');

            Route::post('{event_id}/tickets/edit/{ticket_id}',
                [EventTicketsApiController::class, 'postEditTicket']
            )->name('postEditTicket');

            Route::get('{event_id}/tickets/create',
                [EventTicketsApiController::class, 'showCreateTicket']
            )->name('showCreateTicket');

            Route::post('{event_id}/tickets/create',
                [EventTicketsApiController::class, 'postCreateTicket']
            )->name('postCreateTicket');

            Route::post('{event_id}/tickets/delete',
                [EventTicketsApiController::class, 'postDeleteTicket']
            )->name('postDeleteTicket');

            Route::post('{event_id}/tickets/pause',
                [EventTicketsApiController::class, 'postPauseTicket']
            )->name('postPauseTicket');
            
            // must be test
            Route::post('{event_id}/tickets/order',
                [EventTicketsApiController::class, 'postUpdateTicketsOrder']
            )->name('postUpdateTicketsOrder');

            /*
             * -------
             * Attendees
             * -------
             */
            Route::get('{event_id}/attendees/',
                [EventAttendeesApiController::class, 'showAttendees']
            )->name('showEventAttendees');

            Route::get('{event_id}/attendees/message',
                [EventAttendeesApiController::class, 'showMessageAttendees']
            )->name('showMessageAttendees');

            Route::post('{event_id}/attendees/message',
                [EventAttendeesApiController::class, 'postMessageAttendees']
            )->name('postMessageAttendees');

            Route::get('{attendee_id}/attendees/single_message',
                [EventAttendeesApiController::class, 'showMessageAttendee']
            )->name('showMessageAttendee');

            Route::post('{attendee_id}/attendees/single_message',
                [EventAttendeesApiController::class, 'postMessageAttendee']
            )->name('postMessageAttendee');

            Route::get('{attendee_id}/attendees/resend_ticket',
                [EventAttendeesApiController::class, 'showResendTicketToAttendee']
            )->name('showResendTicketToAttendee');

            Route::post('{attendee_id}/attendees/resend_ticket',
                [EventAttendeesApiController::class, 'postResendTicketToAttendee']
            )->name('postResendTicketToAttendee');

            Route::get('{event_id}/attendees/invite',
                [EventAttendeesApiController::class, 'showInviteAttendee']
            )->name('showInviteAttendee');

            Route::post('{event_id}/attendees/invite',
                [EventAttendeesApiController::class, 'postInviteAttendee']
            )->name('postInviteAttendee');

            Route::get('{event_id}/attendees/import',
                [EventAttendeesApiController::class, 'showImportAttendee']
            )->name('showImportAttendee');

            Route::post('{event_id}/attendees/import',
                [EventAttendeesApiController::class, 'postImportAttendee']
            )->name('postImportAttendee');

            Route::get('{event_id}/attendees/print',
                [EventAttendeesApiController::class, 'showPrintAttendees']
            )->name('showPrintAttendees');

            Route::get('{event_id}/attendees/{attendee_id}/export_ticket',
                [EventAttendeesApiController::class, 'showExportTicket']
            )->name('showExportTicket');

            Route::get('{event_id}/attendees/{attendee_id}/ticket',
                [EventAttendeesApiController::class, 'showAttendeeTicket']
            )->name('showAttendeeTicket');

            Route::get('{event_id}/attendees/export/{export_as?}',
                [EventAttendeesApiController::class, 'showExportAttendees']
            )->name('showExportAttendees');

            Route::get('{event_id}/attendees/{attendee_id}/edit',
                [EventAttendeesApiController::class, 'showEditAttendee']
            )->name('showEditAttendee');

            Route::post('{event_id}/attendees/{attendee_id}/edit',
                [EventAttendeesApiController::class, 'postEditAttendee']
            )->name('postEditAttendee');

            Route::get('{event_id}/attendees/{attendee_id}/cancel',
                [EventAttendeesApiController::class, 'showCancelAttendee']
            )->name('showCancelAttendee');

            Route::post('{event_id}/attendees/{attendee_id}/cancel',
                [EventAttendeesApiController::class, 'postCancelAttendee']
            )->name('postCancelAttendee');

            /*
             * -------
             * Orders
             * -------
             */
            Route::get('{event_id}/orders/',
                [EventOrdersApiController::class, 'showOrders']
            )->name('showEventOrders');

            Route::get('order/{order_id}',
                [EventOrdersApiController::class, 'manageOrder']
            )->name('showManageOrder');

            Route::post('order/{order_id}/resend',
                [EventOrdersApiController::class, 'resendOrder']
            )->name('resendOrder');

            Route::get('order/{order_id}/show/edit',
                [EventOrdersApiController::class, 'showEditOrder']
            )->name('showEditOrder');

            Route::post('order/{order_id}/edit',
                [EventOrdersApiController::class, 'postEditOrder']
            )->name('postOrderEdit');

            Route::get('order/{order_id}/cancel',
                [EventOrdersApiController::class, 'showCancelOrder']
            )->name('showCancelOrder');

            Route::post('order/{order_id}/cancel',
                [EventOrdersApiController::class, 'postCancelOrder']
            )->name('postCancelOrder');

            Route::post('order/{order_id}/mark_payment_received',
                [EventOrdersApiController::class, 'postMarkPaymentReceived']
            )->name('postMarkPaymentReceived');

            Route::get('{event_id}/orders/export/{export_as?}',
                [EventOrdersApiController::class, 'showExportOrders']
            )->name('showExportOrders');

            Route::get('{event_id}/orders/message',
                [EventOrdersApiController::class, 'showMessageOrder']
            )->name('showMessageOrder');

            Route::post('{event_id}/orders/message',
                [EventOrdersApiController::class, 'postMessageOrder']
            )->name('postMessageOrder');

            /*
             * -------
             * Edit Event
             * -------
             */
            Route::post('{event_id}/customize',
                [EventsApiController::class, 'postEditEvent']
            )->name('postEditEvent');

            /*
             * -------
             * Customize Design etc.
             * -------
             */
            Route::get('{event_id}/customize',
                [EventCustomizeApiController::class, 'showCustomize']
            )->name('showEventCustomize');

            Route::get('{event_id}/customize/{tab?}',
                [EventCustomizeApiController::class, 'showCustomize']
            )->name('showEventCustomizeTab');

            Route::post('{event_id}/customize/order_page',
                [EventCustomizeApiController::class, 'postEditEventOrderPage']
            )->name('postEditEventOrderPage');

            Route::post('{event_id}/customize/design',
                [EventCustomizeApiController::class, 'postEditEventDesign']
            )->name('postEditEventDesign');

            Route::post('{event_id}/customize/ticket_design',
                [EventCustomizeApiController::class, 'postEditEventTicketDesign']
            )->name('postEditEventTicketDesign');

            Route::post('{event_id}/customize/social',
                [EventCustomizeApiController::class, 'postEditEventSocial']
            )->name('postEditEventSocial');

            Route::post('{event_id}/customize/fees',
                [EventCustomizeApiController::class, 'postEditEventFees']
            )->name('postEditEventFees');

            /*
             * -------
             * Event Widget page
             * -------
             */
            Route::get('{event_id}/widgets',
                [EventWidgetsApiController::class, 'showEventWidgets']
            )->name('showEventWidgets');

            /*
             * -------
             * Event Access Codes page
             * -------
             */
            Route::get('{event_id}/access_codes',
                [EventAccessCodesApiController::class, 'show']
            )->name('showEventAccessCodes');

            Route::get('{event_id}/access_codes/create',
                [EventAccessCodesApiController::class, 'showCreate']
            )->name('showCreateEventAccessCode');

            Route::post('{event_id}/access_codes/create',
                [EventAccessCodesApiController::class, 'postCreate']
            )->name('postCreateEventAccessCode');

            Route::post('{event_id}/access_codes/{access_code_id}/delete',
                [EventAccessCodesApiController::class, 'postDelete']
            )->name('postDeleteEventAccessCode');

            /*
             * -------
             * Event Survey page
             * -------
             */
            Route::get('{event_id}/surveys',
                [EventSurveyApiController::class, 'showEventSurveys']
            )->name('showEventSurveys');

            Route::get('{event_id}/question/create',
                [EventSurveyApiController::class, 'showCreateEventQuestion']
            )->name('showCreateEventQuestion');

            Route::post('{event_id}/question/create',
                [EventSurveyApiController::class, 'postCreateEventQuestion']
            )->name('postCreateEventQuestion');

            Route::get('{event_id}/question/{question_id}',
                [EventSurveyApiController::class, 'showEditEventQuestion']
            )->name('showEditEventQuestion');

            Route::post('{event_id}/question/{question_id}',
                [EventSurveyApiController::class, 'postEditEventQuestion']
            )->name('postEditEventQuestion');

            Route::post('{event_id}/question/delete/{question_id}',
                [EventSurveyApiController::class, 'postDeleteEventQuestion']
            )->name('postDeleteEventQuestion');

            Route::get('{event_id}/question/{question_id}/answers',
                [EventSurveyApiController::class, 'showEventQuestionAnswers']
            )->name('showEventQuestionAnswers');

            Route::post('{event_id}/questions/update_order',
                [EventSurveyApiController::class, 'postUpdateQuestionsOrder']
            )->name('postUpdateQuestionsOrder');

            Route::get('{event_id}/answers/export/{export_as?}',
                [EventSurveyApiController::class, 'showExportAnswers']
            )->name('showExportAnswers');

            Route::post('{event_id}/question/{question_id}/enable',
                [EventSurveyApiController::class, 'postEnableQuestion']
            )->name('postEnableQuestion');


            /*
             * -------
             * Check In App
             * -------
             */
            // Route::get('{event_id}/check_in',
            //     [EventCheckInController::class, 'showCheckIn']
            // )->name('showCheckIn');

            // Route::post('{event_id}/check_in/search',
            //     [EventCheckInController::class, 'postCheckInSearch']
            // )->name('postCheckInSearch');

            // Route::post('{event_id}/check_in/',
            //     [EventCheckInController::class, 'postCheckInAttendee']
            // )->name('postCheckInAttendee');

            // Route::post('{event_id}/qrcode_check_in',
            //     [EventCheckInController::class, 'postCheckInAttendeeQr']
            // )->name('postQRCodeCheckInAttendee');

            // Route::post('{event_id}/confirm_order_tickets/{order_id}',
            //     [EventCheckInController::class, 'confirmOrderTicketsQr']
            // )->name('confirmCheckInOrderTickets');


            


            /*
             * -------
             * Promote
             * -------
             */
            Route::get('{event_id}/promote',
                [EventPromoteApiController::class, 'showPromote']
            )->name('showEventPromote');
        });

    /*
     * -------------------------
     * Installer
     * -------------------------
     */
    // Route::get('install',[InstallerController::class, 'showInstaller'])->name('showInstaller');
    // Route::post('install',[InstallerController::class, 'postInstaller'])->name('postInstaller');



/*
 * ---------------
 * Check-In / Check-Out
 * ---------------
 */
