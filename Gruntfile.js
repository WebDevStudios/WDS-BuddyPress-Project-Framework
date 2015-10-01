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
					'bower_components/bourbon/app/assets/stylesheets',
					'bower_components/neat/app/assets/stylesheets'
				]
			},
			dist: {
				files: {
					'templates/css/buddypress.css': 'assets/sass/buddypress.scss'
				}
			}
		},

		autoprefixer: {
			options: {
				browsers: ['last 2 versions', 'ie 9'],
				map: {
					inline: false,
					sourcesContent: false
				}
			},
			dist: {
				src: ['templates/css/buddypress.css']
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

		cssmin: {
			minify: {
				expand: true,
				cwd: '',
				src: ['templates/css/buddypress.css', '!*.min.css'],
				dest: '',
				ext: '.min.css'
			}
		},

		csscomb: {
			dist: {
				files: [{
					expand: true,
					cwd: '',
					src: ['templates/css/buddypress.css'],
					dest: '',
				}]
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
					dest: 'js/',
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
		},

		shell: {
			grunt: {
				command: '',
			}
		},

		clean: {
			css: ['templates/css/buddypress.css', 'templates/css/buddypress.min.css']
		}

	});

	grunt.registerTask('styles', ['sass', 'autoprefixer', 'cmq', 'csscomb', 'cssmin']);
	grunt.registerTask('javascript', ['concat', 'uglify']);
	grunt.registerTask('default', ['styles', 'javascript']);

};