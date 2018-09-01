# go-pkg-control

## Apache + PHP variant

Take control of Golang package import paths atop Apache + PHP web services.

Useful as the path of least resistence when forced to use or otherwise unwilling to give up PHP on a given domain.

### Requirements

* Apache
* PHP
* mod_rewrite module installed and enabled
* Rewrite rules for desired packages

### Apache2 Configuration

The corresponding internal-only mod_rewrite rule(s) of the form:

```
     RewriteRule "^/(?:some-package|nth-package)"  "/go-pkg.php" [PT]
```

Must be placed into one of the following locations:

* VirtualHost block of the apache configuration file for the corresponding website.

* The .htaccess file residing alongside go-pkg.php.

### Nginx Configuration

Nginx is also supported.

Example configuration:

```
upstream php-fpm {
    server unix:/run/php/php7.2-fpm.sock;
}

server {
    listen 80;
    listen 443 ssl htt2;
    server_name gigawatt.io www.gigawatt.io www2.gigawatt.io api.gigawatt.io;

    if ($scheme = http) {
        return 301 https://$server_name$request_uri;
    }

    ssl_certificate /etc/ssl/gigawatt.io/full.pem;
    ssl_certificate_key /etc/ssl/gigawatt.io/private.pem;

    client_max_body_size 5M;

    proxy_buffering off;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Scheme $scheme;
    proxy_set_header Host $http_host;

    root /var/www/gigawatt.io/public_html;

    location ~ /(go-pkgs) {
        rewrite ^.*$ /go-pkg-control/apache-php/go-pkg-index.php break;
        include snippets/fastcgi-php.conf;
        include fastcgi_params;
        fastcgi_pass php-fpm;
    }

    location ~ /(go-commons|ago|awsarn|bindatafs|concurrency|diskqueue|driver|errorlib|gentle|metaflector|netlib|oslib|testlib|upstart|web|window|zklib) {
        rewrite ^.*$ /go-pkg-control/apache-php/go-pkg.php break;
        include snippets/fastcgi-php.conf;
        include fastcgi_params;
        fastcgi_pass php-fpm;
    }

    location / {
        proxy_pass http://127.0.0.1:8088;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;

        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection $connection_upgrade;
    }
}
```

### Example

```xml
 <VirtualHost ..>
     RewriteEngine on
     RewriteRule "^/(?:archive.is|html2text)"  "/go-pkg.php" [PT]
 </VirtualHost>
 ```

### Further Reading

* [mod_rewrite documentation](https://httpd.apache.org/docs/2.4/rewrite/remapping.html#page-header)

