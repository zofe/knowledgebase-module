# Laravel Knowledgebase Module

This is a knowledge-base module for a Laravel application (>= 8).

# Installation & configuration 

```
composer require zofe/knowledgebase-module

php artisan migrate 
php artisan db:seed --class="App\\Modules\\Knowledgebase\\Database\\Seeders\\KnowledgeBaseSeeder"
```



# Usage
This command will create a folder "Knowledgebase" in your /app/Modules/ folder, then a demo will be enabled in `/kb/` route

