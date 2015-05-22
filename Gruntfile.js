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
            options: {
                style: 'expanded',
                lineNumbers: true,
                includePaths: [
                    'bower_components/bourbon/app/assets/stylesheets',
                    'bower_components/neat/app/assets/stylesheets'
                ]
            },
            dist: {
                files: {
                    'assets/css/bp-custom.css': 'assets/sass/index.scss'
                }
            }
        },

        autoprefixer: {
            options: {
                browsers: ['last 2 versions', 'ie 9']
            },
            dist: {
                src:  'assets/css/bp-custom.css'
            }
        },

        cmq: {
            options: {
                log: false
            },
            dist: {
                files: {
                    'assets/css/bp-custom.css': 'assets/css/bp-custom.css'
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
                files: ['assets/sass/**/*.scss'],
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
            css: ['assets/css/bp-custom.css', 'assets/css/bp-custom.min.css']
        }

    });

    grunt.registerTask('styles', ['sass', 'autoprefixer', 'cmq', 'csscomb', 'cssmin']);
    grunt.registerTask('default', ['styles']);

};