<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'Laravel Deployer Project');

// Project repository
set('repository', 'git@github.com:hapo-tuannd/laravel-base.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts
host('103.107.182.61')
    ->user('deployer')
    // ->identityFile('~/.ssh/deployerkey')
    ->set('branch', 'develop')
    ->set('deploy_path', '/var/www/html/laravel-app');    
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

// Ignore artisan optimize
task('artisan:optimize', function () {});

