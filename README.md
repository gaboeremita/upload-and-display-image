# Upload And Display Images

This small Laravel and VueJS application allows a user to upload images to a specified server and see the images they have uploaded.

## Prerequisites

You need composer and npm to install this repository

## Installation

Clone the repo and run:

```
composer install
cp .env.example .env
```

Configure in your .env file your database connection.
Now you need to run

```
php artisan key:generate
php artisan migrate --seed
npm install
npm run dev
```

In your .env file add the following variable:
```
REMOTE_HOSTING_SERVICE_URL=https://yourhostingservice.com
```

And you should be all set up.

You can deploy the site however you want, but the easiest way is by running:

```
php artisan serve
```

Now you just need to go to [localhost:8000](http://localhost:8000/) and voilá

## License

You can do whatever you want with this software. [MIT license](http://opensource.org/licenses/MIT).
