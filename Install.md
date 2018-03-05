# Marketing_Wizard Laravel Project Install Guide.
1.download zip from git repo.


2.extract and copy and paste to apache web service root directory.
  if using xampp, go to xampp/htdocs/marketing_wizard. if use wamp, go to wamp/www/marketing_wizard
  
  
3.create marketing_wizard database and import sql file.


4.config DB info in .env file and config/database.php
  like below
            {'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'marketing_wizard'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),}....
            
            
5.install composer on root directory(marketing_wizard). run command: composer install. or composer update

6.migrate db. command: php artisan migrate

7.Import template_videos.sql from root directory.(this is for template_videos tables.)

8.after sucessfuly installed and key generate. command: php artisan key:generate


9.end: visit like this: http://localhost.com/marketing_wizard/public (customer side), http://localhost.com/marketing_wizard/public/admin (admin side)


10.for login use email:dk1986830@gmail.com, password:123456
  it can be changed on DB
# Marketing_Wizard Laravel Project Email Setting Guide.
1.Add Mail setting on .env like bellow
	MAIL_DRIVER=smtp
	MAIL_HOST=smtp.mailtrap.io
	MAIL_PORT=2525
	MAIL_USERNAME=c356fb2369e09d //for test, should create new mailtrap account and add you user name.
	MAIL_PASSWORD=ac9e594529085b //for test, should create new mailtrap account and add you user password.
	MAIL_ENCRYPTION=tls


2.Restart Apache Service.


3.run command: php artisan config:catch
