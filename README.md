# Unofficial Laravel notification channel Package for sms.ir

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rezahmady/smsir.svg?style=flat-square)](https://packagist.org/packages/rezahmady/smsir)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/rezahmady/smsir/master.svg?style=flat-square)](https://travis-ci.org/rezahmady/smsir)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/:sensio_labs_id.svg?style=flat-square)](https://insight.sensiolabs.com/projects/:sensio_labs_id)
[![Quality Score](https://img.shields.io/scrutinizer/g/rezahmady/smsir.svg?style=flat-square)](https://scrutinizer-ci.com/g/rezahmady/smsir)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/rezahmady/smsir/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/rezahmady/smsir/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/rezahmady/smsir.svg?style=flat-square)](https://packagist.org/packages/rezahmady/smsir)

This package makes it easy to send notifications using [Smsir](https://sms.ir) with Laravel 5.5+, 6.x, 7.x , 8.x and 9.x


## Contents

- [Installation](#installation)
	- [Setting up the Smsir service](#setting-up-the-Smsir-service)
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

```
composer require rezahmady/smsir
```

### Setting up the Smsir service

First add these environment variables in your .env file:

```
SMSIR_API_KEY="xxxx"
SMSIR_SECRET_KEY="xxxx"
SMSIR_LINE_NUMBER="xxxx"
```

then add this method to your User model

```
public function routeNotificationForSmsir()
{
    return $this->mobile;
}
```


## Usage

sample notification class:

```
namespace App\Notifications\Sms;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Rezahmady\Smsir\SmsirChannel;
use Rezahmady\Smsir\SmsirMessage;

class VerificationCode extends Notification
{
    use Queueable;

    public $parameter;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($parameter)
    {
        $this->parameter = $parameter;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [SmsirChannel::class];
    }

    public function toSmsir($notifiable)
    {
        return (new SmsirMessage())
                ->setMethod('ultraFastSend')
                ->setTemplateId('47119')
                ->setParameters([
                    'VerificationCode' => $this->parameter
                ]);
        
    }

}
```

sample trigger this notification :

```
return auth()->user()->notify(new VerificationCode('1234'));

```

### Available Message methods

A list of all available options

**setMethod**

is require
```
->setMethod('METHOD_NAME')
```
smsir has two method for send sms :


**1. ultraFastSend**
require attributes is `parameters` (array) and `templateId` (string)
set them with this chain methods :

```
->setTemplateId('THEMPLATE_ID')
->setParameters([...]);
```
**2. sendVerificationCode**

require attributes is `code` (string)
set it with this chane method :

```
->setCode('YOUR_CODE')
```


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email ahmadireza15@gmail.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Reza Ahmadi Sabzevar](https://github.com/rezahmady)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


**Note:**
This package has been used to develop [amirbagh75/smsir-php](https://github.com/amirbagh75/smsir-php)
Thanks to Amirhossein Baghaie
