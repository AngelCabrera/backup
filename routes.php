<?php

require_once('vendor/autoload.php');

use Aura\Router\RouterContainer;

$routerContainer = new RouterContainer();
$map = $routerContainer->getMap();

$map->get('index', '/', [
    'controller' => 'App\Controllers\IndexController',
    'action' => 'getIndexAction'
]);

$map->get('getAddJob', '/curriculum/jobs/add', [
    'controller' => 'App\Controllers\JobsController',
    'action' => 'getAddJobAction'
]);

$map->post('postAddJob', '/jobs/add', [
    'controller' => 'App\Controllers\JobsController',
    'action' => 'postAddJobAction'
]);

$map->get('getAddProject', '/curriculum/projects/add', [
    'controller' => 'App\Controllers\ProjectsController',
    'action' => 'getAddProjectAction'
]);

$map->post('postAddProject', '/curriculum/projects/add', [
    'controller' => 'App\Controllers\ProjectsController',
    'action' => 'postAddProjectAction'
]);

$map->get('getAddResume', '/resume/add', [
    'controller' => 'App\Controllers\ResumeController',
    'action' => 'getAddResumeAction'
]);

$map->post('postAddResume', '/resume/add', [
    'controller' => 'App\Controllers\ResumeController',
    'action' => 'postAddResumeAction'
]);

$map->get('getAddSkill', '/skills/add', [
    'controller' => 'App\Controllers\SkillsController',
    'action' => 'getAddSkillsAction'
]);

$map->post('postAddSkill', '/skills/add', [
    'controller' => 'App\Controllers\SkillsController',
    'action' => 'postAddSkillsAction'
]);

$map->get('getAddLanguage', '/languages/add', [
    'controller' => 'App\Controllers\LanguagesController',
    'action' => 'getAddLanguagesAction'
]);

$map->post('postAddLanguage', '/languages/add', [
    'controller' => 'App\Controllers\LanguagesController',
    'action' => 'postAddLanguagesAction'
]);

$map->get('getAdmin', '/admin', [
    'controller' => 'App\Controllers\AdminController',
    'action' => 'getAdminAction'
]);
