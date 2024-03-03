# Eye-Able Assist Module

**Important** <br>
The module only works when a config file is provided. For getting a Config File you have to contact -> info@eye-able.com . If you do not have one, the Eye-Able Assist Module will not work.

## Branch compatibility

* b-6.5.x branch is compatible with OXID eShop compilation b-6.5.x
* b-7.0.x branch is compatible with OXID eShop compilation b-7.0.x
* b-7.1.x branch is compatible with OXID eShop compilation b-7.1.x

## Install via composer: 
 ```
   cd <shopRoot>
   composer require eyeable/eye-able-oxid
```

## Install for development purposes
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
