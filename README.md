# Homescreen Launcher

## How to Use

 * Time to wait: 10 seconds
 * Title: PageTitle
 * Favicon: https://server.com/icons/icon64.png
 * Homescreen icon: https://server.com/icons/icon180.png
 * Next URL: https://google.com

https://server.com/index.php?time=10&title=PageTitle&icon64=https%3A%2F%2Fserver.com/icons/icon64.png&icon180=https%3A%2F%2Fserver.com/icons/icon180.png&next=https%3A%2F%2Fgoogle.com

## Running On Docker

```bash
docker run -p 8080:80 -v $PWD:/app webdevops/php-nginx:7.3-alpine
```
