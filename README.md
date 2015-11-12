# WDS BP Project Framework

The normal method to override BuddyPress templates is to copy the BP template files over to your theme folder. This is NOT the best way if you ever want to change themes!

This plugin, creates a new template stack for BuddyPress. BuddyPress will look here first - and if the file doesn't exist? It will default to the core plugin, allowing you to totally customize BuddyPress without loosing changes.

## Features
* [Bourbon](https://github.com/thoughtbot/bourbon)
* [Neat](https://github.com/thoughtbot/neat)
* [Grunt](https://github.com/gruntjs/grunt)
* [LibSass](https://github.com/sindresorhus/grunt-sass)
* [PostCSS](https://github.com/postcss/postcss)
* LiveReload
* Javascript linting and concatenation

## Pre-Installation

Basic knowledge of the command line and the following dependencies are required:

* [Ruby](https://www.ruby-lang.org/en/documentation/installation/)
* [Node](http://nodejs.org/)
* [Grunt CLI](https://www.npmjs.com/package/grunt-cli) - `npm install -g grunt-cli`
* [Bower](http://bower.io/) - `npm install -g bower`
* [Sass](http://sass-lang.com/install) - `gem install sass`

## Install and Active Plugin

1) Like any other WordPress plugin, upload ```wds-bp-project-framework``` to your ```wp-content/plugins``` directory

2) Activate from the WordPress Plugins screen.

After activating the plugin, you can add custom code, css, javascript and edit the markup of the templates. There are currently no settings, although there maybe options in the future.

## Local Development Setup

1) From the command line, change directories to your new theme directory

```bash
cd /your-project/wp-content/plugins/wds-bp-project-framework
```

2) Install dependencies

```bash
npm install && bower install
```

When NPM and Bower are finished, you are ready to compile Sass using Grunt. Commands are as follows:

## Using Grunt

* Watch Sass files for changes, and compile automatically: ```grunt watch```
* Compile all styles on demand: ```grunt styles```
* Compile javascript on demand: ```grunt scripts```
* Do it all: ```grunt```
