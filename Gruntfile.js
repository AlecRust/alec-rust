module.exports = function (grunt) {
    require('load-grunt-tasks')(grunt);

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        watch: {

            less: {
                files: 'assets/less/**/*.less',
                tasks: ['less']
            }
        },

        less: {
            development: {
                options: {

                },
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
        }
    });


    grunt.registerTask('default', [
        'less',
        'cssmin'
    ]);
};
