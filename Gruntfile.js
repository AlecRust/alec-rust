module.exports = function (grunt) {
    require('load-grunt-tasks')(grunt);

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        watch: {

            less: {
                files: 'assets/less/**/*.less',
                tasks: ['less']
            },

            concat: {
                files: 'assets/js/**/*.js',
                tasks: ['concat']
            },

            cssmin: {
                files: ['style.css', 'editor-style.css'],
                tasks: ['cssmin']
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

        cssmin: {
            build: {
                files: {
                    'style.min.css': 'style.css',
                    'editor-style.css': 'editor-style.css'
                }
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
        'concat',
        'cssmin',
        'uglify'
    ]);
};
