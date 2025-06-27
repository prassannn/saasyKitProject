<?php
namespace Deployer;

require 'recipe/laravel.php';

// Repository Configuration
set('repository', 'https://github.com/prassannn/saasyKitProject.git');

// Laravel-specific shared & writable settings
add('shared_files', ['.env']);
add('shared_dirs', ['storage']);
add('writable_dirs', ['storage', 'bootstrap/cache']);

// Custom task to setup PHP 8.2 properly
task('setup:php82', function () {
    // Add Ondřej Surý PPA and update package lists
    run('export DEBIAN_FRONTEND=noninteractive && apt-get update');
    run('export DEBIAN_FRONTEND=noninteractive && apt-get install -y software-properties-common');
    run('export DEBIAN_FRONTEND=noninteractive && add-apt-repository ppa:ondrej/php -y');
    run('export DEBIAN_FRONTEND=noninteractive && apt-get update');

    // Install PHP 8.2 and required extensions
    run('export DEBIAN_FRONTEND=noninteractive && apt-get install -y php8.2-bcmath php8.2-cli php8.2-curl php8.2-dev php8.2-fpm php8.2-gd php8.2-imap php8.2-intl php8.2-mbstring php8.2-mysql php8.2-pgsql php8.2-readline php8.2-soap php8.2-sqlite3 php8.2-xml php8.2-zip php8.2-opcache');

    // Configure PHP-FPM
    run('systemctl enable php8.2-fpm');
    run('systemctl start php8.2-fpm');
});

// Hosts
host('57.129.128.69')
    ->set('remote_user', 'root') // Ideally use a deployer user instead of root
    ->set('deploy_path', '/root/snap/lxd/current'); // Best practice: deploy to /var/www/projectname
// If you *must* use your LXD snap path:
// ->set('deploy_path', '/root/snap/lxd/current'); // Avoid ~ for root

// Hooks
after('deploy:failed', 'deploy:unlock');
after('deploy:success', 'artisan:migrate'); // optional: auto-migrate

// Add PHP setup to provisioning
before('provision:php', 'setup:php82');
