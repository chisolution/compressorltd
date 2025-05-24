<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\QuoteRequestController;
use App\Http\Controllers\Admin\SliderController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

// Product routes
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');

// About route
Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about.index');

// Contact routes
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');
Route::get('/api/branches/{branch}', [App\Http\Controllers\ContactController::class, 'getBranch'])->name('api.branches.show');

// Blog routes
Route::get('/blog', [App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');

// Newsletter routes
Route::post('/newsletter/subscribe', [App\Http\Controllers\NewsletterController::class, 'store'])->name('newsletters.store');
Route::get('/newsletter/unsubscribe/{token}', [App\Http\Controllers\NewsletterController::class, 'unsubscribe'])->name('newsletters.unsubscribe');
Route::post('/newsletter/unsubscribe/{token}', [App\Http\Controllers\NewsletterController::class, 'processUnsubscribe'])->name('newsletters.process-unsubscribe');

// Legal pages
Route::get('/privacy-policy', [App\Http\Controllers\LegalController::class, 'privacy'])->name('legal.privacy');
Route::get('/warranty', [App\Http\Controllers\LegalController::class, 'warranty'])->name('legal.warranty');
Route::get('/terms-of-service', [App\Http\Controllers\LegalController::class, 'terms'])->name('legal.terms');

// Quote Request routes
Route::post('/quote-requests', [App\Http\Controllers\QuoteRequestController::class, 'store'])->name('quote-requests.store');

// Testimonial routes
Route::get('/testimonials', [App\Http\Controllers\TestimonialController::class, 'index'])->name('testimonials.index');
Route::get('/testimonials/create', [App\Http\Controllers\TestimonialController::class, 'create'])->name('testimonials.create');
Route::post('/testimonials', [App\Http\Controllers\TestimonialController::class, 'store'])->name('testimonials.store');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Categories
    Route::resource('categories', CategoryController::class);

    // Products
    Route::resource('products', ProductController::class);
    Route::get('products/remove-image/{image}', [ProductController::class, 'removeImage'])->name('products.remove-image');
    Route::get('products/{product}/view', [ProductController::class, 'viewProduct'])->name('products.view');
    Route::post('products/{product}/toggle-featured', [ProductController::class, 'toggleFeatured'])->name('products.toggle-featured');

    // Quote Requests
    Route::resource('quote-requests', QuoteRequestController::class);

    // Testimonials
    Route::resource('testimonials', App\Http\Controllers\Admin\TestimonialController::class);
    Route::post('testimonials/{testimonial}/approve', [App\Http\Controllers\Admin\TestimonialController::class, 'approve'])->name('testimonials.approve');
    Route::post('testimonials/{testimonial}/reject', [App\Http\Controllers\Admin\TestimonialController::class, 'reject'])->name('testimonials.reject');
    Route::post('testimonials/{testimonial}/toggle-featured', [App\Http\Controllers\Admin\TestimonialController::class, 'toggleFeatured'])->name('testimonials.toggle-featured');

    // Contact Messages
    Route::resource('contact-messages', ContactMessageController::class);
    Route::post('contact-messages/mark-as-read', [ContactMessageController::class, 'markAsRead'])->name('contact-messages.mark-as-read');

    // Newsletter
    Route::resource('newsletters', NewsletterController::class);
    Route::post('newsletters/import', [NewsletterController::class, 'import'])->name('newsletters.import');

    // Blog Categories
    Route::resource('blog-categories', BlogCategoryController::class);

    // Blogs
    Route::resource('blogs', BlogController::class);

    // Sliders
    Route::resource('sliders', SliderController::class);
    Route::post('sliders/update-order', [SliderController::class, 'updateOrder'])->name('sliders.update-order');

    // Site Settings Management
    Route::get('settings', [App\Http\Controllers\Admin\SiteSettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [App\Http\Controllers\Admin\SiteSettingController::class, 'update'])->name('settings.update');

    // Branch Management
    Route::resource('branches', App\Http\Controllers\Admin\BranchController::class);
    Route::patch('branches/{branch}/toggle-active', [App\Http\Controllers\Admin\BranchController::class, 'toggleActive'])->name('branches.toggle-active');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::post('/email/verification-notification', [ProfileController::class, 'sendVerificationNotification'])->name('verification.send');
});

require __DIR__.'/auth.php';
