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
                    'templates/css/bp-custom.css': 'templates/sass/index.scss'
                }
            }
        },

        autoprefixer: {
            options: {
                browsers: ['last 2 versions', 'ie 9']
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
                    'templates/css/bp-custom.css': 'templates/css/bp-custom.css'
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

        concat: {
            dist: {
                src: [
                    'templates/js/concat/*.js'
                ],
                dest: 'templates/js/bp-custom.js'
            }
        },

        uglify: {
            build: {
                options: {
                    mangle: false
                },
                files: [{
                    expand: true,
                    cwd: 'js/',
                    src: ['**/*.js', '!**/*.min.js', '!concat/*.js'],
                    dest: 'js/',
                    ext: '.min.js'
                }]
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
            css: ['templates/css/bp-custom.css', 'templates/css/bp-custom.css']
        }

    });

    grunt.registerTask('styles', ['sass', 'autoprefixer', 'cmq', 'csscomb', 'cssmin']);
    grint.registerTask('javascript', ['concat', 'uglify'])
    grunt.registerTask('default', ['styles', 'javascript']);

};