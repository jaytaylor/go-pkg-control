# go-pkg-control

## Apache + PHP variant

Take control of Golang package import paths atop Apache + PHP web services.

Useful as the path of least resistence when forced to use or otherwise unwilling to give up PHP on a given domain.

### Requirements

* Apache
* PHP
* mod_rewrite module installed and enabled
* Rewrite rules for desired packages

### Configuration

 The corresponding internal-only mod_rewrite rule(s) of the form:

```
     RewriteRule "^/(?:some-package|nth-package)"  "/go-pkg.php" [PT]
```

Must be placed into one of the following locations:

* VirtualHost block of the apache configuration file for the corresponding website.

* The .htaccess file residing alongside go-pkg.php.

### Example

```xml
 <VirtualHost ..>
     RewriteEngine on
     RewriteRule "^/(?:archive.is|html2text)"  "/go-pkg.php" [PT]
 </VirtualHost>
 ```

### Further Reading

* [mod_rewrite documentation](https://httpd.apache.org/docs/2.4/rewrite/remapping.html#page-header)

