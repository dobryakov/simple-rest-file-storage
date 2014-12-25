simple-rest-file-storage
========================

Example usage:

POST request:

curl -i -F name=test -F file=@logo.png -X POST http://hostname/api/

Returns File_ID (for example, "549a9a35933cf").

GET request:

http://hostname/files/549a9a35933cf.png

========================

Configs:

```
server {
    listen       1.2.3.4:80;
    server_name  hostname;
    access_log  /var/log/nginx/hostname-access.log;
    location /files {
        expires 1s;
        root /full/path/to/project/root;
        break;
    }
    location /api {
        proxy_pass http://127.0.0.1:80;
        #include proxy.conf;
    }
}

<VirtualHost *:80>
 ServerName hostname
 DocumentRoot /full/path/to/project/root
 AssignUserID user user
 <Directory /full/path/to/project/root>
   DirectoryIndex index.php
   AllowOverride All
   Options +FollowSymlinks
 </Directory>
 CustomLog /var/log/httpd/hostname-access_log combined
 ErrorLog /var/log/httpd/hostname-error_log
</VirtualHost>
```

========================

TODO:

- remove extension of stored files
- autodetect correct mime-type of uploaded file
- store mime-type and metadata [in database]
- send mime-type and metadata as headers of GET request
- nginx proxy_cache
