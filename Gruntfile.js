module.exports = function(grunt) {
        'use strict';

        grunt.initConfig({
                compass: {
                        compile: {
                                options: {
                                        config: 'config.rb'
                                }
                        },
                        watch: {
                                options: {
                                        config: 'config.rb',
                                        watch: true
                                }
                        }
                },
                imagemin: {
                        options: {
                                cache: false
                        },
                        soft: {
                                options: {
                                        optimizationLevel: 1,
                                //      pngquant: true
                                },
                                files: [{
                                        expand: true,
                                        cwd: 'src/Team/MusisBundle/Resources/public/img/',
                                        src: ['**/*.{png,jpg,gif}'],
                                        dest: 'web/built/img/'
                                }]
                        },
                        aggressive: {
                                options: {
                                        optimizationLevel: 7,
                                        pngquant: true,
                                },
                                files: [{
                                        expand: true,
                                        cwd: 'src/Team/MusisBundle/Resources/public/img/',
                                        src: ['**/*.{png,jpg,gif}'],
                                        dest: 'web/built/img/'
                                }]
                        }
                },
                jshint: {
                        options: {
                                //TODO + Ajouter JSHINT au watcher 
                                eqnull: true,
                                reporter: require('jshint-stylish')
                        },
                        defaults: ['Gruntfile.js', 'src/Team/MusisBundle/Resources/public/js/scripts.js']
                },
                clean: {
			concat: {
				src: ['src/Team/MusisBundle/Resources/public/js/concat/output.js']
			},
                        img: {
                                src: ['web/built/img/**/*']
                        }
		},
                concat: {
			options: {
                                separator: ';'
                        },
                        local: {
                                src: ['src/Team/MusisBundle/Resources/public/js/**/*.js'],
                                dest: 'src/Team/MusisBundle/Resources/public/js/concat/output.js'
                        }
                },
                uglify: {
                        ugly: {
                                files: {
                        		'web/built/js/scripts.min.js': ['src/Team/MusisBundle/Resources/public/js/concat/output.js']
        		        }
                        }
                },
                watch: {
                        livereload: {
                                files: ['web/built/css/style.css'],
                                options: {
                                        livereload: true,
                                }
                        },
                        scripts: {
                                files: ['src/Team/MusisBundle/Resources/public/js/*.js'],
                                tasks: ['jshint:defaults','clean:concat','concat','uglify'],
                                options: {
                                        spawn: false,
                                },
                        },
                        images: {
                                files: ['src/Team/MusisBundle/Resources/public/img/**/*.{png,jpg,gif}'],
                                tasks: ['clean:img','imagemin:soft'],
                        }
                },
                concurrent: {
                        watch: {
                                tasks: ['compass:watch', 'watch:livereload', 'watch:scripts', 'watch:images'],
                                options: {
                                        logConcurrentOutput: true,
                                        limit: 5
                                }
                        }
                }
        });

        grunt.loadNpmTasks('grunt-contrib-compass');
        grunt.loadNpmTasks('grunt-contrib-concat');
        grunt.loadNpmTasks('grunt-contrib-uglify');
        grunt.loadNpmTasks('grunt-contrib-watch');
        grunt.loadNpmTasks('grunt-contrib-imagemin');
        grunt.loadNpmTasks('grunt-concurrent');
        grunt.loadNpmTasks('grunt-contrib-clean');
        grunt.loadNpmTasks('grunt-contrib-jshint');

        grunt.registerTask('default', 'concurrent');
        grunt.registerTask('jscrush', ['clean:concat', 'concat', 'uglify']);
        grunt.registerTask('imgcrush', ['clean:img', 'imagemin:soft']);
        grunt.registerTask('build', ['compass:compile', 'imgcrush', 'jscrush']);
};
