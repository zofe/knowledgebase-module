# Laravel Knowledgebase Module

This is a knowledge-base module for a Laravel application (>= 8).

# Installation & configuration 

```
composer require zofe/knowledgebase-module

php artisan migrate 
php artisan db:seed --class="App\\Modules\\Knowledgebase\\Database\\Seeders\\KnowledgeBaseSeeder"
```

Note knowledge-base module use layout-module you may need to do:

```
cd app/Modules/Layout/

npm i
npm run dev
```

this will compile scss and copy css assets to your public project folder


# Usage
This module will be created in /app/Modules/Knowledgebase folder, 
then a demo will be enabled in `/kb` route

