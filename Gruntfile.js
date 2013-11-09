module.exports = function (grunt) {
    require('load-grunt-tasks')(grunt);

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        watch: {

            less: {
                files: 'assets/less/**/*.less',
                tasks: ['less']
            },

            cssmin: {
                files: ['style.css', 'editor-style.css'],
                tasks: ['cssmin']
            },

            uglify: {
                files: 'assets/js/**/*.js',
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

        cssmin: {
            build: {
                files: {
                    'style.css': 'style.css',
                    'editor-style.css': 'editor-style.css'
                }
            }
        },

        uglify: {
            build: {
                files: {
                    'assets/js/main.min.js': 'assets/js/main.js',
                    'assets/js/cycle-text.min.js': 'assets/js/cycle-text.js'
                }
            }
        }
    });

    grunt.registerTask('default', [
        'less',
        'cssmin',
        'uglify'
    ]);
};
