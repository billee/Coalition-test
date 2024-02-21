Steps:

-   setup the application in xampp\htdocs
-   install laravel project. Include Breeze for authentication of users
-   inside env, set up the mysql section for the db name, username and password.
-   setup the phpmyadmin using Xampp control panel
-   run 'php artisan migrate' to setup the database
-   Uncomment the lines inside DatabaseSeeder.php and run 'php artisan db:seed' only once and comment them again.
-   run 'npm run dev'
-   run 'php artisan serve' and point to 'http://localhost:8000/tasks'

Note:

-   This application does not have project creation, so the data for projects table is being factory created and seeded with 2 items.
-   This uses javascript/jquery for front end interaction.
-   This uses Tailwind as the css.
-   This uses jquery UI for drag and drop feature.
-   The whole app is uploaded to my github as: https://github.com/billee/Coalition-test
