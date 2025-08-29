<?php

use App\Http\Controllers\ActivityTrackerController;
use App\Http\Controllers\Export\ExportController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CertificateController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\CourseContentController;
use App\Http\Controllers\Frontend\CourseController;
use App\Http\Controllers\Frontend\CoursePageController;
use App\Http\Controllers\Frontend\EnrolledCourseController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\InstructorDashboardController;
use App\Http\Controllers\Frontend\InstructorOrderController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\StudentDashboardController;
use App\Http\Controllers\Frontend\StudentOrderController;
use App\Http\Controllers\Frontend\WithdrawController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    Route::get('/test-session', function () {
        session(['foo' => 'bar']);

        return session('foo');
    });
});

Route::post('/track-activity', [ActivityTrackerController::class, 'track']);

Route::get('/test', function () {
    return view('test');
});

Route::get('/debug-session-prefix', function () {
    $redis = app('redis')->connection('session');

    return $redis->getConfig('prefix') ?? 'prefix not found';
});

Route::get('/', [FrontendController::class, 'index'])->name('home');

Route::get('/courses', [CoursePageController::class, 'index'])->name('courses.index');
Route::get('/courses/{slug}', [CoursePageController::class, 'show'])->name('courses.show');
Route::post('newsletter-subscribe', [FrontendController::class, 'subscribe'])->name('newsletter.subscribe');
// about route
Route::get('about', [FrontendController::class, 'about'])->name('about.index');
// contact route (GET tanpa middleware, POST dengan middleware)
Route::get('contact', [ContactController::class, 'index'])->name('contact.index');

// Categories list
Route::get('/categories', [FrontendController::class, 'categories'])->name('categories.index');
Route::middleware(['auth', 'verified'])->group(function () {
    // Contact POST
    Route::post('contact', [ContactController::class, 'sendMail'])->name('send.contact');
    // Cart routes
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart-count', [CartController::class, 'cartCount'])->name('cart.count');
    Route::post('add-to-cart/{course}', [CartController::class, 'addToCart'])->name('add-to-cart');
    Route::get('remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('remove-from-cart');
    // Payment routes
    Route::post('/midtrans/create-transaction', [PaymentController::class, 'createMidtransTransaction'])->name('midtrans.createTransaction');
    Route::post('/order/store', [PaymentController::class, 'storeAfterPayment']);

    Route::post('/midtrans/notification', [PaymentController::class, 'handleNotification']);

    Route::get('checkout', CheckoutController::class)->name('checkout.index');
    Route::get('paypal/payment', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment');
    Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');
    Route::get('midtrans/payment', [PaymentController::class, 'midtransCallback'])->name('midtrans.payment');
    Route::get('stripe/payment', [PaymentController::class, 'payWithStripe'])->name('stripe.payment');
    Route::get('stripe/success', [PaymentController::class, 'stripeSuccess'])->name('stripe.success');
    Route::get('stripe/cancel', [PaymentController::class, 'stripeCancel'])->name('stripe.cancel');
    Route::get('order-success', [PaymentController::class, 'orderSuccess'])->name('order.success');
    // Blog comment route
    Route::post('blog/comment/{id}', [BlogController::class, 'storeComment'])->name('blog.comment.store');
    // Review routes
    Route::post('review', [CoursePageController::class, 'storeReview'])->name('review.store');
});

// Routes tanpa middleware auth & verified
Route::get('order-failed', [PaymentController::class, 'orderFailed'])->name('order.failed');

// custom page routes
Route::get('page/{slug}', [FrontendController::class, 'customPage'])->name('custom-page');

// blog routes
Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Student Routes
Route::group(['middleware' => ['auth:web', 'verified', 'check_role:student'], 'prefix' => 'student', 'as' => 'student.'], function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
    Route::get('/become-instructor', [StudentDashboardController::class, 'becomeInstructor'])->name('become-instructor');
    Route::post('/become-instructor/{user}', [StudentDashboardController::class, 'becomeInstructorUpdate'])->name('become-instructor.update');

    // profile routes
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('profile/update', [ProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::post('profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
    Route::post('profile/update-social', [ProfileController::class, 'updateSocial'])->name('profile.update-social');

    // enroll course routes
    Route::get('enrolled-courses', [EnrolledCourseController::class, 'index'])->name('enrolled-courses.index');
    Route::get('course-player/{slug}', [EnrolledCourseController::class, 'playerIndex'])->name('course-player.index');
    Route::get('get-lesson-content', [EnrolledCourseController::class, 'getLessonContent'])->name('get-lesson-content');
    Route::post('update-watch-history', [EnrolledCourseController::class, 'updateWatchHistory'])->name('updateWatchHistory');
    Route::post('update-lesson-completion', [EnrolledCourseController::class, 'updateLessonCompletion'])->name('update-lesson-completion');
    Route::get('file-download/{id}', [EnrolledCourseController::class, 'fileDownload'])->name('file-download');

    // certificate routes
    Route::get('certificate/{course}', [CertificateController::class, 'download'])->name('certificate.download');

    // review routes
    Route::get('review', [StudentDashboardController::class, 'review'])->name('review.index');
    Route::delete('review/{id}', [StudentDashboardController::class, 'reviewDestroy'])->name('review.destroy');

    Route::get('orders', [StudentOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [StudentOrderController::class, 'show'])->name('orders.show');
});

// Instructor Routes
Route::group(['middleware' => ['auth:web', 'verified', 'check_role:instructor'], 'prefix' => 'instructor', 'as' => 'instructor.'], function () {
    // profile routes
    Route::get('/dashboard', [InstructorDashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [ProfileController::class, 'instructorIndex'])->name('profile.index');
    Route::post('profile/update', [ProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::post('profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
    Route::post('profile/update-social', [ProfileController::class, 'updateSocial'])->name('profile.update-social');
    Route::post('profile/update-gateway-info', [ProfileController::class, 'updateGatewayInfo'])->name('profile.update-gateway-info');

    // enroll course routes
    Route::get('enrolled-courses', [EnrolledCourseController::class, 'index'])->name('enrolled-courses.index');
    Route::get('course-player/{slug}', [EnrolledCourseController::class, 'playerIndex'])->name('course-player.index');
    Route::get('get-lesson-content', [EnrolledCourseController::class, 'getLessonContent'])->name('get-lesson-content');
    Route::post('update-watch-history', [EnrolledCourseController::class, 'updateWatchHistory'])->name('updateWatchHistory');
    Route::post('update-lesson-completion', [EnrolledCourseController::class, 'updateLessonCompletion'])->name('update-lesson-completion');
    Route::get('file-download/{id}', [EnrolledCourseController::class, 'fileDownload'])->name('file-download');

    // certificate routes
    Route::get('certificate/{course}', [CertificateController::class, 'download'])->name('certificate.download');

    // review routes
    Route::get('review', [InstructorDashboardController::class, 'review'])->name('review.index');
    Route::delete('review/{id}', [InstructorDashboardController::class, 'reviewDestroy'])->name('review.destroy');

    Route::get('orders', [InstructorOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [InstructorOrderController::class, 'show'])->name('orders.show');

    Route::post('document-update/{user}', [InstructorDashboardController::class, 'documentUpdate'])->name('document.update');

    // orders routes
    Route::get('course-sales', [OrderController::class, 'index'])->name('course-sales.index');
    // withdrawal routes
    Route::get('withdrawals', [WithdrawController::class, 'index'])->name('withdraw.index');

    Route::middleware(['auth', 'verified.document'])->group(function () {
        // course routes
        Route::get('instructors/{id}/data-course', [CourseController::class, 'getAllCourse'])->name('data-course');
        Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
        Route::get('courses/students', [CourseController::class, 'students'])->name('courses.students');
        Route::get('courses/create', [CourseController::class, 'create'])->name('courses.create');
        Route::post('courses/create', [CourseController::class, 'storeBasicInfo'])->name('courses.store-basic-info');
        Route::get('courses/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
        Route::post('courses/update', [CourseController::class, 'update'])->name('courses.update');
        Route::get('course-content/{course}/create-chapter', [CourseContentController::class, 'createChapterModal'])->name('course-content.create-chapter');
        Route::post('course-content/{chapter}/create-chapter', [CourseContentController::class, 'storeChapter'])->name('course-content.store-chapter');
        Route::get('course-content/{chapter}/edit-chapter', [CourseContentController::class, 'editChapterModal'])->name('course-content.edit-chapter');
        Route::post('course-content/{chapter}/edit-chapter', [CourseContentController::class, 'updateChapterModal'])->name('course-content.update-chapter');
        Route::delete('course-content/{chapter}/chapter', [CourseContentController::class, 'destroyChapter'])->name('course-content.destroy-chapter');
        Route::get('course-content/create-lesson', [CourseContentController::class, 'createLesson'])->name('course-content.create-lesson');
        Route::post('course-content/create-lesson', [CourseContentController::class, 'storeLesson'])->name('course-content.store-lesson');
        Route::get('course-content/edit-lesson', [CourseContentController::class, 'editLesson'])->name('course-content.edit-lesson');
        Route::post('course-content/{id}/edit-lesson', [CourseContentController::class, 'updateLesson'])->name('course-content.update-lesson');
        Route::delete('course-content/{id}/lesson', [CourseContentController::class, 'destroyLesson'])->name('course-content.destroy-lesson');
        Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
        Route::post('course-chapter/{chapter}/sort-lesson', [CourseContentController::class, 'sortLesson'])->name('course-chapter.sort-lesson');
        Route::get('course-content/{course}/sort-chapter', [CourseContentController::class, 'sortChapter'])->name('course-content.sort-chapter');
        Route::post('course-content/{course}/sort-chapter', [CourseContentController::class, 'updateSortChapter'])->name('course-content.update-sort-chapter');

        Route::get('withdrawals/request-payout', [WithdrawController::class, 'requestPayoutIndex'])->name('withdraw.request-payout');
        Route::post('withdrawals/request-payout', [WithdrawController::class, 'requestPayout'])->name('withdraw.request-payout.create');

        Route::get('export/students', [ExportController::class, 'studentExportOrders'])->name('export.students');
        Route::match(['GET', 'POST'], 'export/students-pdf', [ExportController::class, 'studentExportSelected'])->name('export.students-pdf');
    });
    // lfm routes
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        UniSharp\LaravelFilemanager\Lfm::routes();
    });
});

require __DIR__ . '/auth.php';

require __DIR__ . '/admin.php';