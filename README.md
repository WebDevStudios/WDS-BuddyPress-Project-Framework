BP Project Framework
======

This plugin is a boilerplate for new custom BuddyPress projects.

The normal method to override BuddyPress templates is to copy the BP template files over to your theme folder. This is not the best way if you ever want to change themes and not have to move files. This plugin creates a new template stack for BuddyPress. BuddyPress will look into this plugin first for its template files and if the file doesn't exist it will default to the core plugin.

There are also files to place custom javascript and css. Place custom javascript in bp-custom.js and css in bp-custom.css. There are also some files in /inc that are there for code placement convenience. bp-custom.php has some example code that BuddyPress contains that allows easy customization. You can customize any file in templates/buddypress/. These override BuddyPress core plugin templates.

Install
-----
To install you upload bp-project-framework folder to your WordPress and activate. There are currently no settings, although there maybe options in the future. After activating the plugin you can start adding custom code, css, javascript and edit the markup of the templates.