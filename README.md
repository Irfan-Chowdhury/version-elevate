<div align="center">
    <h1>Version Elevate</h1>
</div>

## About
In the context of software development, situations often arise where existing applications, already utilized by a substantial client base, require updates either to introduce novel features or rectify unexpected bugs. In both scenarios, a reliable system is essential to effectively notify your established client base, encouraging them to seamlessly transition to the latest version or promptly apply bug fixes. This process resembles the strategies employed by various software platforms.

By seamlessly integrating this feature into your application, you can precisely orchestrate the desired outcome. When envisioning this integration, consider the intricate balance between innovation and stability. On one hand, new features enhance your application's utility; on the other hand, addressing bugs showcases a commitment to quality and user satisfaction.

## Requirements
```php
"require": {
    "php": ">= 8.0",
    "laravel/framework": ">= 9.0"
},
```

## Installation
You can install the package via composer:
```php
composer require irfan-chowdhury/version-elevate
```

## Configuration
After completing the installation, you can publish with:
```php
php artisan vendor:publish --provider="IrfanChowdhury\VersionElevate\VersionElevateServiceProvider"
```

Service Provider Registration In `config/app.php`, add in providers array -
```php
'providers' => [
    /*
    * Package Service Providers...
    */
    Irfan\LaravelUniqueSlug\UniqueSlugServiceProvider::class,
],
```

#### Environement Variable (.ENV) 
```php
# DEMO | DEVELOPER | CLIENT)
PRODUCT_MODE=DEMO 
VERSION=1.2.3
DOMAIN_URL="https://your_domain.com"
```
Here we used <b>DEMO</b> which indicate the original app which is now online server.


## Notes
#### (i) PRODUCT_MODE :
- <b>DEVELOPER</b> : To access for developers.
- <b>CLIENT</b> : For production I mean when the clients use your application and they can get notification and update.
- <b>DEMO</b> : Client's product have to connect with a main server to transfer files and others from main server to client server. So there should be a primary server for control. 

#### (ii) For Version Upgrade - you should follow these points for Demo/Main App :

- Client Version Number >= Minimum Required Version
- In general setting, Latest Version Upgrade should be <b><i>Checked</i></b>
- Product Mode  have to set <b><i>DEMO</i></b>
- Demo Version Number > Client Version Number

<br>

<div align="center">
    <h2>Developer Section</h2>
    <p>(This section will be not visible to the clients)</p>
</div>


### General Setting 
- Goto the url to access: [your_domain_name.com/developer-section]()
- Product mode should be <b>DEVELOPER</b> and you have to set it and control from <b>`.env`</b> file.
- A version number has required.
- A minimum version number has been required. Suppose you have a lot of versions `v1.0.0` to `v5.0.0` . In some case old version can not support with latest version feaures. Let if any version is `v3.0.0` then it will migrate to latest version easily without any hassle. This time it should be minimum required version.
- <b>Latest Version Upgrade</b> : You have to enable this when a new version will be released so that old clients get notification and can update.
- <b>Latest Version DB Migrate</b> : If need to DB migrate, then you have to enable this also. 
- <b>Version Upgrade URL :</b>  In your server, you have to create a directory and all necessary files have to import there so that the files from here can transfer into client server.

![General Section](https://snipboard.io/dFx3hT.jpg)

### Version Upgrade Setting
- In <b>Files</b> section you have to input file name which file you want to transfer from your main server to client server.
- In <b>Logs</b> section clients can see the change log details.
- In <b>Short Note</b> section, you can set a important note for the clients if need.

![Version Upgrade Setting](https://snipboard.io/i1tBSJ.jpg)


<div align="center">
    <h2>Client Section</h2>
</div>
- Goto the url to access: [your_domain_name.com/version-elevate-dashboard]()
- If any new version release, then client will get a notification message in dashboard. They have to click on <b><i>Click Here</i></b> option to see the details page. 

![Version Upgrade Notification](https://snipboard.io/dxfblN.jpg)

### Version Upgrade Page

- Client will see all details such version number, note and change log details.

![Version Upgrade Page](https://snipboard.io/W5HBkf.jpg)

- After clicking Upgrade button, it will upgrade process automatically then will see a success message and new version number will setup in your application automatically.

![Version Upgrade page](https://snipboard.io/VDHoXi.jpg)

<i><b>Some Challenge : </b></i> <br>
- If any issues arise, then clients have to contact with the support team. 

![Version Upgrade Error](https://snipboard.io/7W46AY.jpg)


## Visit
```php
Packagist : https://packagist.org/packages/irfan-chowdhury/version-elevate
```

## Credits
- Structure follow from - [spatie/package-skeleton-laravel](https://github.com/spatie/package-skeleton-laravel)
