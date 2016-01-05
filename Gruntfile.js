module.exports = function(grunt) {

	// load all grunt tasks in package.json matching the `grunt-*` pattern
	require('load-grunt-tasks')(grunt);

	var pkg = grunt.file.readJSON('package.json');

	grunt.initConfig({

		pkg: pkg,

		githooks: {
			all: {
				'pre-commit': 'default'
			}
		},

		sass: {
			options: {
				outputStyle: 'expanded',
				sourceComments: true,
				sourceMap: true,
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
					require('autoprefixer')({ browsers: ['last 2 versions', 'ie 9'] }),
					require('css-mqpacker')({ sort: true }),
			]},
			dist: {
				src: ['templates/css/buddypress.css', '!*.min.css']
			}
		},

		cssnano: {
			options: {
				autoprefixer: false,
				safe: true,
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
					sourceMap: true,
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

			scripts: {
				files: ['assets/js/**/*.js'],
				tasks: ['javascript'],
				options: {
					spawn: false,
					livereload: true,
				},
			},

			css: {
				files: ['assets/sass/**/*.scss'],
				tasks: ['styles'],
				options: {
					spawn: false,
					livereload: true,
				},
			},
		},
	});

	grunt.registerTask('styles', ['sass', 'postcss', 'cssnano']);
	grunt.registerTask('javascript', ['concat', 'uglify']);
	grunt.registerTask('default', ['styles', 'javascript']);

};
