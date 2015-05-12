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
                    'inc/bp-custom.css': 'inc/sass/index.scss'
                }
            }
        },

        autoprefixer: {
            options: {
                browsers: ['last 2 versions', 'ie 9']
            },
            dist: {
                src:  'inc/bp-custom.css'
            }
        },

        cmq: {
            options: {
                log: false
            },
            dist: {
                files: {
                    'inc/bp-custom.css': 'inc/bp-custom.css'
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
                    'inc/js/concat/*.js'
                ],
                dest: 'inc/bp-custom.js'
            }
        },

        uglify: {
            build: {
                options: {
                    mangle: false
                },
                files: [{
                    expand: true,
                    cwd: 'inc/js/',
                    src: ['**/*.js', '!**/*.min.js', '!concat/*.js'],
                    dest: 'inc/js/',
                    ext: '.min.js'
                }]
            }
        },

        watch: {

            scripts: {
                files: ['inc/js/**/*.js'],
                tasks: ['javascript'],
                options: {
                    spawn: false,
                    livereload: true
                }
            },

            css: {
                files: ['inc/sass/**/*.scss'],
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
            js: ['inc/js/project*', 'js/**/*.min.js'],
            css: ['inc/bp-custom.css', 'inc/bp-custom.min.css']
        }

    });

    grunt.registerTask('styles', ['sass', 'autoprefixer', 'cmq', 'csscomb', 'cssmin']);
    grunt.registerTask('javascript', ['concat', 'uglify'])
    grunt.registerTask('default', ['styles', 'javascript']);

};