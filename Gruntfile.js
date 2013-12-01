module.exports = function (grunt) {
    require('load-grunt-tasks')(grunt);

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        watch: {

            less: {
                files: 'assets/less/**/*.less',
                tasks: ['less', 'autoprefixer']
            },

            cssmin: {
                files: ['style.css'],
                tasks: ['cssmin']
            },

            concat: {
                files: 'assets/js/**/*.js',
                tasks: ['concat']
            },

            uglify: {
                files: 'assets/js/main.js',
                tasks: ['uglify']
            }
        },

        less: {
            development: {
                files: {
                    'style.css': 'assets/less/style.less',
                    'editor-style.css': 'assets/less/editor-style.less'
                }
            }
        },

        autoprefixer: {
            options: {
                browsers: ['> 1%', 'last 2 versions']
            },
            build: {
                files: {
                    'style.css': ['style.css'],
                    'editor-style.css': ['editor-style.css']
                }
            }
        },

        cssmin: {
            build: {
                files: {
                    'style.min.css': 'style.css'
                }
            }
        },

        concat: {
            concat: {
                options: {
                    separator: '\n'
                },
                dest: 'assets/js/main.js',
                src: [
                    'assets/js/vendor/jquery.js',
                    'assets/js/cycle-text.js',
                    'assets/js/utilities.js'
                ]
            }
        },

        uglify: {
            build: {
                files: {
                    'assets/js/main.min.js': 'assets/js/main.js'
                }
            }
        }
    });

    grunt.registerTask('default', [
        'less',
        'autoprefixer',
        'cssmin',
        'concat',
        'uglify'
    ]);
};
