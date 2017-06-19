# 

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]


This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

## Structure

If any of the following are applicable to your project, then the directory structure should follow industry best practises by being named the following.

```
bin/        
config/
src/
tests/
vendor/
```


## Install

Via Composer

``` bash
$ composer require /
```

## Usage

####Create shipment
``` php
$shipment = Unifaun::shipment()
            ->pdfConfig("laser-a4", 0, 0)
            ->sender("Markus Strömgren", "Torpvägen 12", 64134, "Katrineholm", "SE", "+46709459777", "markus.stromgren@dialect.se")
            ->receiver("Andreas Strömgren", "Köpmangatan 5", 64130, "Katrineholm", "SE", "+46709459777", "andreas.stromgren@dialect.se")
            ->addSenderPartners("PLAB", "0000000000")
            ->senderReference("Thomas Söderlind")
            ->receiverReference("Fredrik Bentzer")
            ->orderNo("1337")
            ->addParcel("Shipment1", 1, 1)
            ->addParcel("Shipment2",1,1)
            ->service("P15")
            ->create();
```

####Store shipment
``` php
$shipment = Unifaun::shipment()
            ->sender("Markus Strömgren", "Torpvägen 12", 64134, "Katrineholm", "SE", "+46709459777", "markus.stromgren@dialect.se")
            ->receiver("Andreas Strömgren", "Köpmangatan 5", 64130, "Katrineholm", "SE", "+46709459777", "andreas.stromgren@dialect.se")
            ->addSenderPartners("PLAB", "0000000000")
            ->senderReference("Thomas Söderlind")
            ->receiverReference("Fredrik Bentzer")
            ->orderNo("1337")
            ->addParcel("Shipment1", 1, 1)
            ->addParcel("Shipment2",1,1)
            ->service("P15")
            ->store();
```



## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email markus.stromgren@dialect.se instead of using the issue tracker.

## Credits

- [Markus Strömgren][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v//.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis///master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g//.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g//.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt//.svg?style=flat-square

[link-packagist]: https://packagist.org/packages//
[link-travis]: https://travis-ci.org//
[link-scrutinizer]: https://scrutinizer-ci.com/g///code-structure
[link-code-quality]: https://scrutinizer-ci.com/g//
[link-downloads]: https://packagist.org/packages//
[link-author]: https://github.com/
[link-contributors]: ../../contributors
