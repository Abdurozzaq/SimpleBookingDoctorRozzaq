SERVER VERSION:
- MYSQL: 8.0.25-15
- PHP: 8.2.13



INSTALLATION:
1. Clone Repo
2. buka terminal dan masuk ke direktori projek
3. run ```composer install```
4. ubah nama file ```.env.example``` menjadi ```.env```
5. creata database mysql dengan nama ```booking_rozzaq``` atau dengan nama lain tapi di setting di ```.env``` berikut:
   ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=booking_rozzaq
    DB_USERNAME=root
    DB_PASSWORD=root
   ``` 
6. run ```php artisan key:generate```
7. run ```php artisan migrate```
8. run ```php artisan db:seed```
9. run ```php artisan jwt:secret```
10. run ```php artisan serve```
11. buka paka web browser ```localhost:8000```
