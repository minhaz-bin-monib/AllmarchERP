- Laravel framework 8.x 
--- 

-- Some Basic Command 

- command list 

        => php artisan list
 - Run
    
        => php artisan serve

- Clear Application Cache

        => php artisan cache:clear
        => php artisan route:clear
        => php artisan config:clear
        => php artisan view:clear

- Database

        => php artisan migrate
        => php artisan migrate:rollback
        => php artisan migrate:refresh   
          Be carefull about refresh

        => php artisan make:migration migration_name
        
        => php artisan make:migration add_columns_to_customers_table
        
- Controllers and Models

        => php artisan make:controller ControllerName

        => php artisan make:model ModelName
        
        =>php artisan make:model ModelName -m

        

- 
