<?php
/**
 * Application Routes
 */

return function (Router $router) {

    // PUBLIC ROUTES
    $router->get('/', 'home@index');
    $router->get('/home', 'home@index');

    // AUTH ROUTES
    $router->get('/auth/login', 'auth@login');
    $router->post('/auth/login', 'auth@login');
    $router->get('/auth/logout', 'auth@logout');
    $router->get('/auth/register', 'auth@register');
    $router->post('/auth/store', 'auth@store');

    // DASHBOARD
    $router->get('/dashboard', 'dashboard@index');

    // ADMIN AREA
    $router->get('/admin/daftarUser', 'admin@daftarUser');
    $router->get('/admin/tambahArea', 'admin@tambahArea');
    $router->get('/admin/tambahUser', 'admin@tambahUser');
    $router->get('/admin/tambahTarif', 'admin@tambahTarif');

    // USER MANAGEMENT
    $router->post('/user/store', 'user@store');
    $router->get('/user/delete/:id', 'user@delete');
    $router->get('/user/edit/:id', 'user@edit');
    $router->post('/user/update', 'user@updateUser');


    // PARKIR ROUTES
    $router->get('/parkir', 'parkir@index');
    $router->get('/parkir/masuk', 'parkir@masuk');
    $router->post('/parkir/masuk', 'parkir@masuk');
    $router->get('/parkir/keluar/:id', 'parkir@keluar');
    $router->get('/parkir/previewMasuk/:id', 'parkir@previewMasuk');
    $router->get('/parkir/previewKeluar/:id', 'parkir@previewKeluar');
    $router->get('/parkir/riwayat', 'parkir@riwayat');
    $router->get('/parkir/tarif', 'parkir@tarif');
    $router->get('/parkir/tambahTarif', 'admin@tambahTarif');
    $router->post('/parkir/tambahTarif', 'admin@tambahTarif');
    $router->get('/parkir/laporan', 'parkir@laporan');
    $router->get('/parkir/editTarif/:id', 'parkir@editTarif');
    $router->post('/parkir/editTarif/:id', 'parkir@editTarif');
    $router->get('/parkir/area', 'parkir@area');
    $router->get('/parkir/editArea/:id', 'parkir@editArea');
    $router->post('/parkir/editArea/:id', 'parkir@editArea');
    $router->get('/parkir/struk/:id', 'parkir@struk');
    $router->get('/parkir/strukMasuk/:id', 'parkir@strukMasuk');
    $router->get('/parkir/strukKeluar/:id', 'parkir@strukKeluar');
    
    // AREA ROUTES
    $router->post('/area/store', 'area@store');
    $router->get('/area/delete/:id', 'area@delete');

    // LOG & PROFILE
    $router->get('/log', 'log@index');
    $router->get('/profile', 'profile@index');
    $router->get('/profile/index', 'profile@index');
};
