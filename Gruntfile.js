/* jshint node:true */
module.exports = function( grunt ){
	'use strict';

	grunt.initConfig({

		pkg: grunt.file.readJSON( 'package.json' ),

		// Generate POT files.
		makepot: {
			target: {
				options: {
					type: 'wp-theme',
					domainPath: 'languages',
					exclude: ['deploy/.*'],
					updateTimestamp: false,
					potHeaders: {
						'report-msgid-bugs-to': '',
						'language-team': '',
						'Language': 'en_US',
						'X-Poedit-SearchPath-0': '../../altruism',
						'plural-forms': 'nplurals=2; plural=(n != 1);',
						'Last-Translator': 'Nilambar Sharma <nilambar@outlook.com>',
						'x-poedit-keywordslist': '__;_e;__ngettext:1,2;_n:1,2;__ngettext_noop:1,2;_n_noop:1,2;_c;_nc:1,2;_x:1,2c;_ex:1,2c;_nx:4c,1,2;_nx_noop:4c,1,2;',
					}
				}
			}
		},

		// Check textdomain errors.
		checktextdomain: {
			options: {
				text_domain: 'altruism',
				keywords: [
					'__:1,2d',
					'_e:1,2d',
					'_x:1,2c,3d',
					'esc_html__:1,2d',
					'esc_html_e:1,2d',
					'esc_html_x:1,2c,3d',
					'esc_attr__:1,2d',
					'esc_attr_e:1,2d',
					'esc_attr_x:1,2c,3d',
					'_ex:1,2c,3d',
					'_n:1,2,4d',
					'_nx:1,2,4c,5d',
					'_n_noop:1,2,3d',
					'_nx_noop:1,2,3c,4d'
				]
			},
			files: {
				src: [
					'**/*.php',
					'!node_modules/**'
				],
				expand: true
			}
		},

		addtextdomain: {
			options: {
		            textdomain: 'altruism'
		        },
		        target: {
		        	files: {
		        		src: [
		        		'*.php',
		        		'**/*.php',
		        		'!node_modules/**',
		        		'!tests/**',
		        		'!docs/**',
		        		]
		        	}
		        }
	    },

		// Copy files to deploy.
		copy: {
			deploy: {
				src: [
					'**',
					'!.*',
					'!*.md',
					'!.*/**',
					'!tmp/**',
					'!Gruntfile.js',
					'!test.php',
					'!package.json',
					'!node_modules/**',
					'!sass/**',
					'!docs/**'
				],
				dest: 'deploy/<%= pkg.name %>',
				expand: true,
				dot: true
			}
		},

		// Clean the directory.
		clean: {
			deploy: ['deploy']
		},

		sass: {
			dist: {
				options: {
					sourcemap: 'none',
					style: 'expanded'
				},
				files: {
					'style.css': 'sass/style.scss'
				}
			}
		},
		watch: {
			css: {
				files: ['sass/**/*.scss'],
				tasks: ['sass'],
				options: {
					spawn: false
				}
			},
			js: {
				files: ['js/*.js'],
				tasks: ['uglify'],
				options: {
					spawn: false
				}
			}
		},

		jshint: {
			options: grunt.file.readJSON('.jshintrc'),
			all: [
				'js/*.js',
				'!js/*.min.js'
			]
		},
		uglify: {
			target: {
				files: [{
					expand: true,
					cwd: 'js',
					src: ['*.js', '!*.min.js'],
					dest: 'js',
					ext: '.min.js'
				}]
			}
		},

		// Compress files.
		compress: {
			deploy: {
				expand: true,
				options: {
					archive: 'deploy/<%= pkg.name %>.zip'
				},
				cwd: 'deploy/<%= pkg.name %>/',
				src: ['**/*'],
				dest: '<%= pkg.name %>/'
			}
		}
	});

	// Load NPM tasks to be used here
	grunt.loadNpmTasks( 'grunt-wp-i18n' );
	grunt.loadNpmTasks( 'grunt-checktextdomain' );
	grunt.loadNpmTasks( 'grunt-contrib-compress' );
	grunt.loadNpmTasks( 'grunt-contrib-copy' );
	grunt.loadNpmTasks( 'grunt-contrib-clean' );
	grunt.loadNpmTasks( 'grunt-contrib-watch' );
	grunt.loadNpmTasks( 'grunt-contrib-sass' );
	grunt.loadNpmTasks( 'grunt-contrib-jshint' );
	grunt.loadNpmTasks( 'grunt-contrib-uglify' );

	// Register tasks
	grunt.registerTask( 'default', [
		'watch'
	]);

	grunt.registerTask( 'precommit', [
		'jshint'
	]);

	grunt.registerTask( 'build', [
		'sass',
		'uglify',
		'addtextdomain',
		'makepot'
	]);

	grunt.registerTask( 'deploy', [
		'clean:deploy',
		'copy:deploy',
		'compress:deploy'
	]);

};
