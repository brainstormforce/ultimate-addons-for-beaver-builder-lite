module.exports = function( grunt ) {

	'use strict';
	var banner = '/**\n * <%= pkg.homepage %>\n * Copyright (c) <%= grunt.template.today("yyyy") %>\n * This file is generated automatically. Do not edit.\n */\n';
	// Project configuration
	grunt.initConfig( {

		pkg: grunt.file.readJSON( 'package.json' ),

		wp_readme_to_markdown: {
			your_target: {
				files: {
					'README.md': 'readme.txt'
				}
			},
		},
	    copy: {
	        main: {
	            options: {
	                mode: true
	            },
	            src: [
	                '**',
	                '*.zip',
	                '!node_modules/**',
	                '!build/**',
	                '!css/sourcemap/**',
	                '!.git/**',
	                '!bin/**',
	                '!.gitlab-ci.yml',
	                '!bin/**',
	                '!tests/**',
	                '!phpunit.xml.dist',
	                '!*.sh',
	                '!*.map',
	                '!Gruntfile.js',
	                '!package.json',
	                '!.gitignore',
	                '!phpunit.xml',
	                '!README.md',
	                '!sass/**',
	                '!codesniffer.ruleset.xml',
	                '!vendor/**',
	                '!composer.json',
	                '!composer.lock',
	                '!package-lock.json',
	                '!phpcs.xml.dist',
	            ],
	            dest: 'bb-ultimate-addon/'
	        }
	    },
	    compress: {
	        main: {
	            options: {
	                archive: 'bb-ultimate-addon.zip',
	                mode: 'zip'
	            },
	            files: [
	                {
	                    src: [
	                        './bb-ultimate-addon/**'
	                    ]

	                }
	            ]
	        }
	    },

	    clean: {
	        main: ["bb-ultimate-addon"],
	        zip: ["bb-ultimate-addon.zip"],
	    },

	    makepot: {
	        target: {
	            options: {
	                domainPath: '/',
	                mainFile: 'bb-ultimate-addon.php',
	                potFilename: 'languages/uabb.pot',
	                potHeaders: {
	                    poedit: true,
	                    'x-poedit-keywordslist': true
	                },
	                type: 'wp-plugin',
	                updateTimestamp: true
	            }
	        }
	    },
	    
	    addtextdomain: {
	        options: {
	            textdomain: 'uabb',
	        },
	        target: {
	            files: {
	                src: ['*.php', '**/*.php', '!node_modules/**', '!php-tests/**', '!bin/**', '!admin/bsf-core/**']
	            }
	        }
	    }

	});

	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-compress');
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-wp-i18n');

	grunt.registerTask('i18n', ['addtextdomain', 'makepot']);
	grunt.registerTask('release', ['clean:zip', 'copy', 'compress', 'clean:main']);


	grunt.loadNpmTasks('grunt-wp-readme-to-markdown');

	grunt.registerTask('readme', ['wp_readme_to_markdown']);

	grunt.util.linefeed = '\n';

};
