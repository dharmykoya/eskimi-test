<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Advert Campaigns
This is a simple monolith app used for creating advert campaigns.

### Front End:

- Landing page(all campaigns).
- View campaign modal
- Create campaign
- Edit campaign
- View single campaign

### Backend End Architecture:

- Cached response with redis.
- Well written tests.
- Well documented api
- Static analysis compliant
- Containerized with Docker for development - available on request for production.

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Requirements
> 1. You must have the docker registry installed on host machine
> 2. It safer you have php7.4 and above running but you should be fine within a docker environment

## Setup

### Installation

```bash
  git git clone https://github.com/dharmykoya/eskimi-test.git && cd eskimi-test
  
  cp .env.example .env

  cd note-taker

  ./vendor/bin/sail down --rmi all -v || true #Optional - This will remove images that may interfere with the installation
  
  ./vendor/bin/sail build

  ./vendor/bin/sail up -d
  
  ./vendor/bin/sail composer install --ignore-platform-reqs
  
  ./vendor/bin/sail artisan key:generate
  
  ./vendor/bin/sail artisan jwt:secret
  
  ./vendor/bin/sail artisan migrate --seed
  
  ./vendor/bin/sail npm install
  
  ./vendor/bin/sail npm run dev
```


> *Note:* if you want to stop the service just run:
> - **./sail down**


### Test
```bash
  ./vendor/bin/sail test
```


### Analyses

> - *./vendor/bin/phpcbf*
> - *./vendor/bin/phpcs* and
> - *./vendor/bin/phpstan analyse --memory-limit=2G*

### Application
> Access the application in your local host with
```bash
  http://127.0.0.1:9999 #Or any port you used in during deployment

```

### API Collection

[![Run in Postman](https://run.pstmn.io/button.svg)](https://go.postman.co/workspace/My-Workspace~1aec4e96-8df5-4fb3-8ddf-9dda69da60c4/collection/7508184-5c4c6935-c930-4d88-80a8-759dde8843c5)

> *Note:* if you experience any issues viewing this you can check the apiCollection.json file
> at the root of the project



## Author

Damilola Adekoya - dharmykoya38@gmail.com
PLease do reach out for any clarification. Thank you. Cheers!😉

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
