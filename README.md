# Start server:
    php artisan serve

# Create controller: 
    php artisan make:controller WorkerController

# Create model and migration:
    php artisan make:model Worker -m

# Install migration:
    php artisan migrate
# Delete data from migration tables:
    php artisan migrate:fresh


# Create request:
    php artisan make:request Worker/StoreRequest

# Create command:
    php artisan make::command DevCommand


