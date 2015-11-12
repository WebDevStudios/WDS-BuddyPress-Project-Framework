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

		sass: {
			options: {
				style: 'expanded',
				lineNumbers: true,
				includePaths: [
					'assets/bower/bourbon/app/assets/stylesheets',
					'assets/bower/neat/app/assets/stylesheets'
				]
			},
			dist: {
				files: {
					'templates/css/buddypress.css': 'assets/sass/buddypress.scss'
				}
			}
		},

		postcss: {
			options: {
				map: true,
				processors: [
					require('autoprefixer')({ browsers: ['last 2 versions'] }),
			]},
			dist: {
				src: 'templates/css/buddypress.css'
			}
		},

		cmq: {
			options: {
				log: false
			},
			dist: {
				files: {
					'templates/css/buddypress.css': 'templates/css/buddypress.css'
				}
			}
		},

		cssnano: {
			options: {
				sourcemap: true,
				autoprefixer: false,
				zindex: false
			},
			dist: {
				files: {
					'templates/css/buddypress.min.css': 'templates/css/buddypress.css'
				}
			}
		},

		concat: {
			dist: {
				src: ['assets/js/concat/*.js'],
				dest: 'assets/js/bp-custom.js',
			}
		},

		uglify: {
			build: {
				options: {
					mangle: false
				},
				files: [{
					expand: true,
					cwd: 'assets/js/',
					src: ['**/*.js', '!**/*.min.js', '!concat/*.js'],
					dest: 'assets/js/',
					ext: '.min.js'
				}]
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

			scripts: {
				files: ['assets/js/**/*.js'],
				tasks: ['scripts'],
				options: {
					spawn: false,
					livereload: true,
				},
			},
		},

	});

	grunt.registerTask('styles', ['sass', 'cmq', 'cssnano']);
	grunt.registerTask('scripts', ['concat', 'uglify']);
	grunt.registerTask('default', ['styles', 'scripts']);

};