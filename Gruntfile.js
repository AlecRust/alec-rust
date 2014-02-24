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
                files: 'style.css',
                tasks: 'cssmin'
            },
            concat: {
                files: 'assets/js/**/*.js',
                tasks: 'concat'
            },
            uglify: {
                files: 'assets/js/main.js',
                tasks: 'uglify'
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
                    'style.css': 'style.css',
                    'editor-style.css': 'editor-style.css'
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
            options: {
                separator: '\n'
            },
            dest: 'assets/js/main.js',
            src: [
                'assets/js/vendor/jquery.js',
                'assets/js/cycle-text.js',
                'assets/js/utilities.js'
            ]
        },

        uglify: {
            build: {
                files: {
                    'assets/js/main.min.js': 'assets/js/main.js'
                }
            }
        },

        'ftp-deploy': {
            build: {
                auth: {
                    host: 'ftp.alecrust.com',
                    port: 21,
                    authKey: 'key1'
                },
                src: './',
                dest: '/public_html/wp-content/themes/alec-rust',
                exclusions: [
                    './Thumbs.db',
                    './.DS_Store',
                    './.ftppass',
                    './.git',
                    './.gitattributes',
                    './.gitignore',
                    './assets/less',
                    './bower_components',
                    './bower.json',
                    './Gruntfile.js',
                    './node_modules',
                    './package.json',
                    './README.md'
                ]
            }
        },

        bowercopy: {
            options: {
                srcPrefix: 'bower_components'
            },
            less: {
                options: {
                    destPrefix: 'assets/less'
                },
                files: {
                    'normalize.less': 'normalize.css/normalize.css'
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
