# WDS BP Project Framework

The normal method to override BuddyPress templates is to copy the BP template files over to your theme folder. This is not the best way if you ever want to change themes and not have to move files!

This plugin creates a new template stack for BuddyPress. BuddyPress will look into this plugin first for its template files and if the file doesn't exist it will default to the core plugin.

There are also files to place custom javascript and css. Place custom javascript in bp-custom.js and css in bp-custom.css. There are also some files in ```/inc``` that are there for code placement convenience. ```bp-custom.php``` has some example code that BuddyPress contains that allows easy customization. You can customize any file in ```templates/buddypress/```. These override BuddyPress core plugin templates.

# Install BP Project Framework

1) Like any other WordPress plugin, upload ```wds-bp-project-framework``` to your ```wp-content/plugins``` directory

2) Activate from the WordPress Plugins screen.

After activating the plugin you can start adding custom code, css, javascript and edit the markup of the templates. There are currently no settings, although there maybe options in the future.

# Using Sass

The WDS BP Project Framework now includes [Bourbon](https://github.com/thoughtbot/bourbon), [Neat](https://github.com/thoughtbot/neat), and [Grunt](https://github.com/gruntjs/grunt).

Basic knowledge of the command line and the following dependencies are required:

* [Ruby](https://www.ruby-lang.org/en/documentation/installation/)
* [Node](http://nodejs.org/)
* [Grunt CLI](https://www.npmjs.com/package/grunt-cli) - `npm install -g grunt-cli`
* [Bower](http://bower.io/) - `npm install -g bower`
* [Sass](http://sass-lang.com/install) - `gem install sass`

## Installation

1) From the command line, change directories to your new theme directory

```bash
cd /your-project/wordpress/wp-content/plugins/wds-bp-project-framework
```

2) Install dependencies

```bash
npm install && bower install
```

When NPM and Bower are finished, you are ready to compile Sass using Grunt. Commands are as follows:

## Using Grunt

* Watch Sass files for changes, and compile automatically: ```grunt watch```
* Compile all styles on demand: ```grunt styles```
* Compile javascript on demand: ```grunt javascript```
* Do it all: ```grunt```
