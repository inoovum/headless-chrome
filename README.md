# Headless Chrome print to pdf package for Neos and Flow.

**Caution: This package is in development!**

## Installation

Just run:

```
composer require steinbauerit/neos-headlesschrome
```

## Install chromium on your machine
###  Here, for example, alpine linux

```
apk update
apk upgrade
apk add chromium
```
#### Determine the binary location of your Chrome installation
```
which chromium-browser
```

## Configuration

```yaml
SteinbauerIT:
  Neos:
    HeadlessChrome:
      chromeExecutable: '/usr/bin/chromium-browser'
      defaultAttributes:
        - 'disable-gpu'
        - 'no-margins'
        - 'no-sandbox'
```

## Usage
```php
use SteinbauerIT\Neos\HeadlessChrome\Print2Pdf;

$print2Pdf = new Print2Pdf();
$print2Pdf->setSource($source);
$print2Pdf->setTargetDirectory($targetPath);
$print2Pdf->setAttributes(
    ['foo', 'bar']
);
$result = $print2Pdf->execute(); // Path to the printed PDF

```

## Author

* Company: STEINBAUER IT GmbH
* E-Mail: patric.eckhart@steinbauer-it.com
* URL: http://www.steinbauer-it.com
