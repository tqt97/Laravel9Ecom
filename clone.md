### Clone the repository from https://github.com/tqt97/Laravel9Ecom
 
- Go to the folder application using cd command on your cmd or terminal
- Run __composer install__ on your cmd or terminal
- Copy .env.example file to .env on the root folder. You can type __copy .env.example .env__ if using command prompt Windows or __cp .env.example .env__ if using terminal, Ubuntu
- Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
- Run __php artisan key:generate__
- Run __php artisan migrate__
- Run __npm run dev__
- Run __php artisan serve__
- Go to http://localhost:8000/
- You can see the application running

################################
### Aliases in cmd/command
    alias pa='php artisan $1'
    alias pas='php artisan serve'
    alias pam='php artisan make:model $1'
    alias pac='php artisan make:controller $1'
    alias pamm='php artisan make:migration $1'
    alias pamg='php artisan migrate'
    alias pamgfs='php artisan migrate:fresh --seed'
    alias pao='php artisan optimize:clear'
    alias pak='php artisan key:generate'
    alias nrd='npm run dev'
    alias nrb='npm run build'
    alias ci='composer install'
    alias c='composer $1'
    alias envc='cp .env.example .env'
    alias par='php artisan make:request $1'
    alias pammdl='php artisan make:middleware $1'
    alias cl='clear'
    alias pamsrc='php artisan make:resource $1'
