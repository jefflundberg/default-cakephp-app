module.exports = function(grunt){

	require("matchdep").filterDev("grunt-*").forEach(grunt.loadNpmTasks);

	grunt.registerTask('default', ['jshint', 'uglify', 'copyto', 'smushit', 'phplint']);


	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		watch: {
			js: {
				files: ['app/webroot/js/*.js'],
				tasks: ['jshint', 'uglify']
			},
			css: {
				files: ['lib/twitter/bootstrap/less/*.less'],
				tasks: ['less']
			},
			img: {
				files: ['app/webroot/img/*.png', 'app/webroot/img/*.jpg'],
				tasks: ['smushit']
			},
			php: {
				files: ['**/*.php'],
				tasks: ['phplint'],
				options: {
					nospawn: true,
				},
			}
		},

		//JavaScript
		jshint: {
			all: ['app/webroot/js/base.js']
		},

		uglify: {
			build: {
				files: {
					'app/webroot/js/base.min.js': ['lib/components/jquery/jquery.js', 'lib/twitter/bootstrap/dist/js/bootstrap.js', 'app/webroot/js/base.js']
				}
			}
		},

		//CSS
		less: {
			development: {
				options: {

				},
					files: {
						"app/webroot/css/cake.dev.css": "lib/twitter/bootstrap/less/bootstrap.less"
				}
			},
			production: {
				options: {
					compress: true,
					cleancss: true
				},
					files: {
						"app/webroot/css/cake.min.css": "lib/twitter/bootstrap/less/bootstrap.less"
				}
			}
		},

		//Images
		smushit: {
			production: {
				src: ['app/webroot/img/*.png', 'app/webroot/img/*.jpg'],
				dest: 'app/webroot/img/min'
			}
		},

		//Copy files for production
		copyto: {
			fontawesome: {
				files: [
					{cwd: 'lib/fortawesome/font-awesome/', src: 'css/*.css', dest: 'app/webroot/'},
					{cwd: 'lib/fortawesome/font-awesome/', src: 'fonts/*.*', dest: 'app/webroot/'}
				]
			}
			// bootstrap: {
			// 	files: [
			// 		{cwd: 'lib/twitter/bootstrap/dist/js/', src: 'bootstrap.min.js', dest: 'app/webroot/js/'}
			// 	]
			// }
		},

		//PHP
		phplint: {
			all: ['Config/*.php', 'Console/*.php', 'Model/*.php', 'View/*.php']
		}



		// htmlhint: {
		// 	build: {
		// 		options: {
		// 			'tag-pair': true,
		// 			'tagname-lowercase': true,
		// 			'attr-lowercase': true,
		// 			'attr-value-double-quotes': true,
		// 			'doctype-first': true,
		// 			'spec-char-escape': true,
		// 			'id-unique': true,
		// 			'head-script-disabled': true,
		// 			'style-disabled': true
		// 		},
		// 		src: ['app/webroot/index.php']
		// 	}
		// }
	});


	// Event handling
	grunt.event.on('watch', function(action, filepath) {
		//only lint the changed file
		grunt.config(['phplint', 'all'], filepath);
	});

};