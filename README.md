# cms-inferno

This is a simple content management software for CodeIgniter 3.

## Routes

This section should be added to application/config/routes.php file.

```php
/*
 * CMS Inferno
 */
$route['default_controller'] = 'cms/home';
$route['404_override'] = 'cms/show_404';
$route['blog'] = 'cms/blog';
$route['post/(:any)'] = 'cms/post/$1';
$route['login'] = 'cms/login';
$route['logout'] = 'cms/logout';
$route['posts'] = 'cms/posts';
$route['posts/add'] = 'cms/add_post';
$route['posts/edit/(:any)'] = 'cms/edit_post/$1';
$route['posts/delete/(:any)'] = 'cms/delete_post/$1';
$route['pages'] = 'cms/pages';
$route['pages/add'] = 'cms/add_page';
$route['pages/edit/(:any)'] = 'cms/edit_page/$1';
$route['pages/delete/(:any)'] = 'cms/delete_page/$1';
$route['page/(:any)'] = 'cms/page/$1';
$route['links'] = 'cms/links';
$route['links/add'] = 'cms/add_link';
$route['links/edit/(:any)'] = 'cms/edit_link/$1';
$route['links/delete/(:any)'] = 'cms/delete_link/$1';
```
