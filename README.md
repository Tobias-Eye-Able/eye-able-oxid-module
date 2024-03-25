## Eye-Able® Assist <br>
This is the Oxid Module for <a href="https://eye-able.com/assist/" target="_blank">Eye-Able® Assist</a>. Our assistance software gives your users an accessible and personalised view of your website content. Eye-Able® Assist helps to customise the website to the individual needs of visitors. In this way, the assistance software promotes digital participation and improves the user experience. 
Eye-Able® Assist contais over 25 functions for your accessibility and can be DSGVO-compliant integrated into all HTML-based interfaces.<br><br>
You will also get a preview of our <a href="https://eye-able.com/report/" target="_blank">Eye-Able Report software</a>. By activating the module, you will receive a short test report every 7 days that shows you the number of accessibility deficiencies on your homepage. If you would like a detailed report for all your subpages, please contact us under [info@eye-able.com](mailto:info@eye-able.comt)
<br><br>

**Important** <br> 
In a Demo-mode Eye-Able® Assist can be used with a limited amount of functionalities. To get the full Eye-Able® Assist Software functionalities you need to purchase a license from us. The full license lets you customize Eye-Able® Assist so that it will fit to your corporate design. For more Information check out our <a href="https://eye-able.com/assist/" target="_blank">Website</a> or contact us under [info@eye-able.com](mailto:info@eye-able.comt)
 website and contact us!

### Configuration

As of Eye-Able® Assist version 3, no configuration is required but is still possible.

In the Administrator Panel, do not change the Eye-Able® report API URL and the Eye-Able® API key unless explicitly instructed to do so by Eye-Able®

### Installation Process

### Branch compatibility

* b-6.5.x branch is compatible with OXID eShop compilation b-6.5.x
* b-7.0.x branch is compatible with OXID eShop compilation b-7.0.x
* b-7.1.x branch is compatible with OXID eShop compilation b-7.1.x

### Install via composer: 
```
cd <shopRoot>
composer require eyeable/eye-able-oxid
```

### Install for development purposes
1. Clone the repository into a suitable directory of your oxid shop, e.g. dev-packages.
```
cd <shop installation path>
git clone https://github.com/Tobias-Eye-Able/eye-able-oxid-module.git dev-packages/EyeAbleAssist --branch=b-7.0.x-report
```
2. Install Module from local path:
```
cd <shop installation path>
composer config repositories.eyeable/eye-able-oxid path dev-packages/EyeAbleAssist
composer require eyeable/eye-able-oxid:*
```
### Running integration tests

 ```
 vendor/bin/phpunit  --bootstrap=/var/www/source/bootstrap.php --testsuite=Integration  -c /var/www/vendor/eyeable/eye-able-oxid/tests/phpunit.xml 
 ```

### Running codeception tests
```
vendor/bin/codecept run --bootstrap=/var/www/source/bootstrap.php  -c /var/www/vendor/eyeable/eye-able-oxid/tests/codeception.yml
```
