<?php

namespace Config;

$routes = Services::routes();
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
  require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers\Init');
$routes->setDefaultController('InitController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

$routes->get('init', 'InitController::index', ['namespace' => 'App\Controllers\Init']);

$routes->group('auth', function ($routes) {
  $routes->get('login', 'LoginController::index', ['namespace' => 'App\Controllers\Auth']);
  $routes->post('login', 'LoginController::store', ['namespace' => 'App\Controllers\Auth']);
  $routes->get('logout', 'LoginController::logout', ['namespace' => 'App\Controllers\Auth']);
  $routes->post('session', 'LoginController::session', ['namespace' => 'App\Controllers\Auth']);
});

$routes->group('admin', function ($routes) {

  $routes->group('dashboard', function ($routes) {
    $routes->get('/', 'DashboardController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('detailTransaction', 'DashboardController::detailTransaction', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('getData', 'DashboardController::getData', ['namespace' => 'App\Controllers\Admin']);
  });

  $routes->group('banner', function ($routes) {
    $routes->get('/', 'BannerController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('getData', 'BannerController::getData', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('create', 'BannerController::create', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('post', 'BannerController::post', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('edit/(:any)', 'BannerController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('update', 'BannerController::update', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('detail/(:any)', 'BannerController::detail/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->delete('delete/(:any)', 'BannerController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
  });

  $routes->group('event', function ($routes) {
    $routes->get('/', 'EventController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('getData', 'EventController::getData', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('create', 'EventController::create', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('post', 'EventController::post', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('edit/(:any)', 'EventController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('postUpdate', 'EventController::postUpdate', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('detail/(:any)', 'EventController::detail/$1', ['namespace' => 'App\Controllers\Admin']);
    // $routes->delete('postDelete', 'EventController::postDelete', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('delete/(:any)', 'EventController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
    // $routes->get('listJoin/(:any)', 'EventController::listJoin/$1', ['namespace' => 'App\Controllers\Admin']);
    // $routes->post('eventJoinPresent', 'EventController::eventJoinPresent', ['namespace' => 'App\Controllers\Admin']);
    // $routes->post('eventJoinNotPresent', 'EventController::eventJoinNotPresent', ['namespace' => 'App\Controllers\Admin']);
  });

  $routes->group('news', function ($routes) {
    $routes->get('/', 'NewsController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('getData', 'NewsController::getData', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('create', 'NewsController::create', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('post', 'NewsController::post', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('edit/(:any)', 'NewsController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('update', 'NewsController::update', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('detail/(:any)', 'NewsController::detail/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('delete/(:any)', 'NewsController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
  });

  $routes->group('member', function ($routes) {
    $routes->get('/', 'MemberController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('delete/(:any)', 'MemberController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
    // $routes->get('detail/(:any)', 'MemberController::detail/$1', ['namespace' => 'App\Controllers\Admin']);
    // $routes->get('edit/(:any)', 'MemberController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
    // $routes->post('update', 'MemberController::update', ['namespace' => 'App\Controllers\Admin']);
    // $routes->post('approval', 'MemberController::approval', ['namespace' => 'App\Controllers\Admin']);
    // $routes->post('rejected', 'MemberController::rejected', ['namespace' => 'App\Controllers\Admin']);
    // $routes->post('partnership', 'MemberController::partnership', ['namespace' => 'App\Controllers\Admin']);
  });

  $routes->group('broadcast', function ($routes) {
    $routes->get('/', 'BroadcastController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('getData', 'BroadcastController::getData', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('create', 'BroadcastController::create', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('post', 'BroadcastController::post', ['namespace' => 'App\Controllers\Admin']);
  });

  $routes->group('officialStore', function ($routes) {
    $routes->get('status/(:any)', 'StoreController::index/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('getCity', 'StoreController::getCity', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('getDistrict', 'StoreController::getDistrict', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('getSubdistrict', 'StoreController::getSubdistrict', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('update', 'StoreController::update', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('create', 'StoreController::create', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('post', 'StoreController::post', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('edit', 'StoreController::edit', ['namespace' => 'App\Controllers\Admin']);
  });

  $routes->group('product', function ($routes) {
    $routes->get('/', 'ProductController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('getData', 'ProductController::getData', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('create', 'ProductController::create', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('post', 'ProductController::post', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('delete/(:any)', 'ProductController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('detail/(:any)', 'ProductController::detail/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('edit/(:any)', 'ProductController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('update', 'ProductController::update', ['namespace' => 'App\Controllers\Admin']);
  });

  $routes->group('reportOrder', function ($routes) {
    $routes->get('status/(:any)', 'OrderController::status/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('detail/(:any)', 'OrderController::detail/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('confirmed', 'OrderController::confirmed', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('submitVoucher', 'OrderController::submitVoucher', ['namespace' => 'App\Controllers\Admin']);
  });

  $routes->group('listStore', function ($routes) {
    $routes->get('/', 'ListStoreController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('getData', 'ListStoreController::getData', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('create', 'BannerController::create', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('post', 'BannerController::post', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('edit/(:any)', 'BannerController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('update', 'BannerController::update', ['namespace' => 'App\Controllers\Admin']);
    $routes->get('detail/(:any)', 'BannerController::detail/$1', ['namespace' => 'App\Controllers\Admin']);
    $routes->delete('delete/(:any)', 'BannerController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
  });

  $routes->group('listProduct', function ($routes) {
    $routes->get('/', 'ListProductController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->post('getData', 'ListProductController::getData', ['namespace' => 'App\Controllers\Admin']);
    // $routes->get('create', 'ProductController::create', ['namespace' => 'App\Controllers\Admin']);
    // $routes->post('post', 'ProductController::post', ['namespace' => 'App\Controllers\Admin']);
    // $routes->post('delete/(:any)', 'ProductController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
    // $routes->get('detail/(:any)', 'ProductController::detail/$1', ['namespace' => 'App\Controllers\Admin']);
    // $routes->get('edit/(:any)', 'ProductController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
    // $routes->post('update', 'ProductController::update', ['namespace' => 'App\Controllers\Admin']);
  });
});

// $routes->group('user', function ($routes) {
//   $routes->get('dashboard', 'DashboardController::index', ['namespace' => 'App\Controllers\User']);
//   $routes->get('timestamp', 'DashboardController::timestamp', ['namespace' => 'App\Controllers\User']);
//   $routes->get('forbidden', 'DashboardController::forbidden', ['namespace' => 'App\Controllers\User']);

//   $routes->group('product', function ($routes) {
//     $routes->get('/', 'ProductController::index', ['namespace' => 'App\Controllers\User']);
//     $routes->get('create', 'ProductController::create', ['namespace' => 'App\Controllers\User']);
//     $routes->post('post-product', 'ProductController::postProduct', ['namespace' => 'App\Controllers\User']);
//     $routes->get('detail/(:any)', 'ProductController::detail/$1', ['namespace' => 'App\Controllers\User']);
//     $routes->get('edit/(:any)', 'ProductController::edit/$1', ['namespace' => 'App\Controllers\User']);
//     $routes->post('update-product', 'ProductController::updateProduct', ['namespace' => 'App\Controllers\User']);
//     $routes->post('import-product', 'ProductController::importProduct', ['namespace' => 'App\Controllers\User']);
//     $routes->get('template-product', 'ProductController::templateProduct', ['namespace' => 'App\Controllers\User']);
//   });

//   $routes->group('order', function ($routes) {
//     $routes->get('/', 'OrderController::index', ['namespace' => 'App\Controllers\User']);
//     $routes->get('status/(:any)', 'OrderController::status/$1', ['namespace' => 'App\Controllers\User']);
//   });
// });

// $routes->group('mobile-support', function ($routes) {
//   $routes->get('/', 'MobilesupportController::index', ['namespace' => 'App\Controllers']);
// });
// $routes->group('mobile-bantuan', function ($routes) {
//   $routes->get('/', 'MobilebantuanController::index', ['namespace' => 'App\Controllers']);
// });

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
  require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
