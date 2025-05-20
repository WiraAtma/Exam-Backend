- Schema Database Bisa Langsung Command "php artisan migrate"

- Data Faker di Seeder Bisa Dilakukan satu per satu untuk mengurangi terjadinya overload Memory
AuthorSeeder.php "php artisan db:seed --class=AuthorSeeder"
CategorySeeder.php "php artisan db:seed --class=CategorySeeder"
BookSeeder.php "php artisan db:seed --class=BookSeeder"
RatingSeeder.php "php artisan db:seed --class=RatingSeeder" Atau Jika Terjadi Memory Issue Maka Bisa Dijalankan Dengan memory yang lebih besar "php -d memory_limit=1G artisan db:seed --class=RatingSeeder"
