<?php
namespace Deployer;

require 'recipe/laravel.php';

// Zone ühendus
set('application', 'hajus');
set('remote_user', 'virt110110');
set('http_user', 'virt110110');
set('keep_releases', 2);

host('tak21loho.itmajakas.ee')
    ->setHostname('tak21loho.itmajakas.ee')
    ->set('http_user', 'virt110110')
    ->set('deploy_path', '~/domeenid/www.tak21fredyait.itmajakas.ee/hajus')
    ->set('branch', 'main');

set('repository', 'git@github.com:timoloho/hajusrak.git');

// tasks
task('opcache:clear', function () {
    run('killall php82-cgi || true');
})->desc('Clear opcache');

task('build:node', function () {
    cd('{{release_path}}');
    run('npm i');
    run('npx vite build');
    run('rm -rf node_modules'); 
});

task('deploy', [
    'deploy:prepare',
    'deploy:vendors',
    'artisan:storage:link',
    'artisan:view:cache',
    'artisan:config:cache',
    'build:node',
    'deploy:publish',
    'opcache:clear',
    'artisan:cache:clear'
]);
// Hooks

after('deploy:failed', 'deploy:unlock');