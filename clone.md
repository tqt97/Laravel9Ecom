### Clone the repository from https://github.com/tqt97/Laravel9Ecom
 
- Go to the folder application using cd command on your cmd or terminal
- Run __composer install__ on your cmd or terminal
- Copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt Windows or cp .env.example .env if using terminal, Ubuntu
- Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
- Run __php artisan key:generate__
- Run __php artisan migrate__
- Run __php artisan serve__
- Go to http://localhost:8000/
