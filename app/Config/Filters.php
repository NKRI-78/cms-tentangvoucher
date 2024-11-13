<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
	public $aliases = [
		'isLoggedIn' => \App\Filters\isLoggedIn::class,
		'csrf'     => \CodeIgniter\Filters\CSRF::class,
		'toolbar'  => \CodeIgniter\Filters\DebugToolbar::class,
		'honeypot' => \CodeIgniter\Filters\Honeypot::class,
	];

	public $globals = [
		'after'  => [
			'toolbar',
		],
	];

	public $methods = [];

	public $filters = [
		'isLoggedIn' => [
			'before' => [
				'/',
				'init',
				'admin/dashboard',
				'admin/banner',
				'admin/member',
				'admin/officialStore/status/confirmed',
				'admin/officialStore/status/packing',
				'admin/officialStore/status/shipping',
				'admin/officialStore/status/delivered',
				'admin/officialStore/status/done',
				'admin/officialStore/status/cancel',
				// 'admin/studentGeneration/student/(:num)',
				'admin/officialStore',
				'admin/officialStore/edit',
				'admin/product',
				'admin/product/create',
				'admin/product/edit/(:num)',
				'admin/listStore',
				'admin/listProduct',
			],
			'after'  => [
				'/',
				'auth/login'
			]
		],
	];
}
