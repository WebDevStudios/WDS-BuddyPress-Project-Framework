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

*Please checkout/download the [Sass](https://github.com/WebDevStudios/WDS-BuddyPress-Project-Framework/tree/sass) branch of this plugin to use Sass.*

