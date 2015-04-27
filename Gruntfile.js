module.exports = function(grunt) {

    // load all grunt tasks in package.json matching the `grunt-*` pattern
    require('load-grunt-tasks')(grunt);

    grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),

        githooks: {
            all: {
                'pre-commit': 'default'
            }
        },

        csscomb: {
            dist: {
                files: [{
                    expand: true,
                    cwd: '',
                    src: ['**/*.css'],
                    dest: '',
                }]
            }
        },

        sass: {
            dist: {
                options: {
                    style: 'expanded',
                    lineNumbers: true
                },
                files: {
                    'style.css': 'templates/sass/buddypress.scss'
                }
            }
        },

        autoprefixer: {
            options: {
                browsers: ['> 1%', 'last 2 versions', 'Firefox ESR', 'Opera 12.1']
            },
            dist: {
                src:  'templates/css/bp-custom.css'
            }
        },

        cmq: {
            options: {
                log: false
            },
            dist: {
                files: {
                    'style.css': 'templates/css/bp-custom.css'
                }
            }
        },

        cssmin: {
            minify: {
                expand: true,
                cwd: '',
                src: ['*.css', '!*.min.css'],
                dest: '',
                ext: '.min.css'
            }
        },

        watch: {

            css: {
                files: ['templates/sass/**/*.scss'],
                tasks: ['sass'],
                options: {
                    spawn: false,
                    livereload: true,
                },
            },
        },

        shell: {
            grunt: {
                command: '',
            }
        },

        clean: {
            css: ['templates/css/bp-custom.css', 'templates/css/bp-custom.min.css']
        }

    });

    grunt.registerTask('styles', ['sass', 'autoprefixer', 'cmq', 'csscomb', 'cssmin']);
    grunt.registerTask('default', ['styles']);

};