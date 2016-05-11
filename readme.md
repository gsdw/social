# Laravel Gsdw Social

## Introduction

### install
    composer require laravel/socialite
    composer require gsdw/social

    or add code to composer.json
    
    "require": {
        "laravel/socialite": "^2.0",
        "gsdw/social": "dev-master"
    },
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/gsdw/social"
        }
    ],

### Configuration

register the Provider in your `config/app.php` configuration file:

    'providers' => [
        // Other service providers...
        Laravel\Socialite\SocialiteServiceProvider::class,
        Gsdw\Social\Providers\SocialServiceProvider::class,
    ],

Also, add the `Socialite` facade to the `aliases` array in your `app` configuration file:

    'Socialite' => Laravel\Socialite\Facades\Socialite::class,

Add information app project in `config/services.php` configuration file

    'google' => [
        'client_id' => 'your-github-app-id',
        'client_secret' => 'your-github-app-secret',
        'redirect' => url('social/handle/google'),
    ],

### Add link Login
Default link to login social is `/social/redirect/google`.
Can use html output link: \Gsdw\Social\Helpers\Output::googleButton()

### Notification
Add code in layout to show notification
    `@if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif`

#### Reference 
https://github.com/laravel/socialite
