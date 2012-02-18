# jsRDC

jsRDC is a Remote Debug Console and usable for handling errors, notices or something else.

### Required

* [Node.js](http://nodejs.org/) && npm
  * coffee-script@1.2.0
  * coffeekup@0.3.1
  * express@2.5.5
  * socket.io@0.8.7

### Start and using

install as global package (-g) for scripts 

    npm install -g coffee-script

clone the source

    git clone git://github.com/Yitsushi/jsRDC.git
    cd jsRDC

install dependences

    npm install

start the server

    coffee app.coffee
    
Now you have a jsRDC server on port 3000 *(default)*. Open it: [http://localhost:3000/](http://localhost:3000/).
Now you can test it if you run **PHP/php_error.php**.
This file is a random error/notice/message generator in PHP.

    cd PHP
    php php_error.php
    
Now you can see the error/notice/debug message in your browser. If you run it again then you got a new error =) Is it cool? Yeah.
If you don't see these messages then sorry =/
after some feature I would fix bugs and build a better lib for PHP and some other languages.

### Planned features

1. Registration/Login
2. Redis to store messages for a short time (e.g.: 6 hours)
3. Separated application namespace. So when you are logged in you can create a new application namespace or choose an existing.
4. Dashboard (see 3rd)
5. Plugin system (e.g.: send me an email when XYZ or send me an SMS when ZYX)
6. Customizable server side highlighting.