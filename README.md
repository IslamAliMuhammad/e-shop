# E-Shop (Online Store)
An online store that consists of client app and dashboard built with Laravel framework. 
* [Dashboard Live](http://178.128.156.158/en/dashboard)
* [Clien Live](http://178.128.156.158/en/home) 

![2](/screenshots/dash1.PNG)
![1](/screenshots/5.PNG)

## Built With
* [PHP](https://www.php.net/) & [Laravel](https://laravel.com/)
* [MySQL](https://www.mysql.com/)
* [Livewire](https://laravel-livewire.com/)
* [jQuery](https://jquery.com/) 
* [Bootstrap](https://getbootstrap.com/)

## Key features:
* Clien App + Dashboard
* Support multi-languages (LTR - RTL)
* Roles and permissions functionality.
* Sales graph analysis.
* Shopping-cart.
* Whishlist.
* Blog.
* Coupons.
* Sending mails.
* Full-text search.
* Sign-in with third party.

## Getting Started  

### Prerequisites 
* XAMPP development environment [download](https://www.apachefriends.org/index.html) (*Optional*)
* Composer Dependency Manager [download](https://getcomposer.org/download/)

### Installation 
1. Clone the repo 
   ```sh
   git clone https://github.com/IslamAliMuhammad/e-shop.git
   ```
2. Install the dependencies
   ```sh
   composer install 
   ```
3. Configure your .env file.

4. Set the application key
   ```sh
   php artisan key:generate
   ```
5. Create database in your localhost.
6. Run migrations
   ```sh
   php artisan migrate --seed
   ```

### Testing
* Seed dummy data for testing

    ```sh
   php artisan db:seed --class TestSeeder
   ``` 

## License
[MIT](https://choosealicense.com/licenses/mit/)


## App Screenshots

![3](/screenshots/2.PNG)
![4](/screenshots/dash2.PNG)
![5](/screenshots/3.PNG)
![6](/screenshots/dash6.PNG)
![7](/screenshots/1.PNG)
![5](/screenshots/dash5.PNG)


