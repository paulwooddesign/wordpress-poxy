// Generated on 2014-10-30 using generator-angular-jade-stylus 0.8.7
'use strict';

// # Globbing
// for performance reasons we're only matching one level down:
// 'test/spec/{,*/}*.js'
// use this if you want to recursively match all subfolders:
// 'test/spec/**/*.js'

module.exports = function (grunt) {

  // Load grunt tasks automatically
  require('load-grunt-tasks')(grunt);

  // Time how long tasks take. Can help when optimizing build times
  require('time-grunt')(grunt);

  // Define the configuration for all the tasks
  grunt.initConfig({

    // Project settings
    yeoman: {
      // configurable paths
      app: require('./bower.json').appPath || 'theme',
      dist: 'content/themes/poxy'
    },

    // Watches files for changes and runs tasks based on the changed files
    watch: {
      bower: {
        files: ['bower.json'],
        tasks: ['bowerInstall']
      },
      coffee: {
        files: ['<%= yeoman.app %>/scripts/{,*/}*.{coffee,litcoffee,coffee.md}'],
        tasks: ['newer:coffee:dist']
      },
      coffeeTest: {
        files: ['test/spec/{,*/}*.{coffee,litcoffee,coffee.md}'],
        tasks: ['newer:coffee:test', 'karma']
      },
      stylus: {
        files: ['<%= yeoman.app %>/styles/{,*/}*.styl'],
        //files: ['<%= yeoman.app %>/styles/*.styl'],
        tasks: ['stylus:server', 'autoprefixer']
      },
      jade: {
        files: ['<%= yeoman.app %>/views/{,*/}*.jade', '<%= yeoman.app %>/*.jade'],
        tasks: ['bowerInstall', 'jade:server']
      },

      gruntfile: {
        files: ['Gruntfile.js']
      },
      livereload: {
        options: {
          livereload: '<%= connect.options.livereload %>'
        },
        files: [
        '.tmp/{,*/}*.html',
        '.tmp/styles/{,*/}*.css',
        '.tmp/scripts/{,*/}*.js',
        '<%= yeoman.app %>/images/{,*/}*.{png,jpg,jpeg,gif,webp,svg}'
        ]
      },

      // Wordpress Watch
      jadephp: {
      files: [
      '<%= yeoman.app %>/wordpress/{,*/}*.jade',
      '<%= yeoman.app %>/wordpress/{,*/}*.php',
      '<%= yeoman.app %>/*.jade',
      '<%= yeoman.app %>/wordpress/admin{,*/}*.js',
      '<%= yeoman.app %>/wordpress/admin/ajax/*.php'
      ],
        tasks: ['jadephp:dist', 'copy:dist']
      }

    },


    // Compile the PHP
    jadephp: {
      dev: {
        expand: true,
        flatten: true,
        cwd: '<%= yeoman.app %>/php/',
        dest: 'wp',
        src: ['*.jade', '{,*/}*.jade'],
        ext: '.php',
        options: {
          pretty: true,
          filename: 'default',
          basedir: __dirname
        }
      },
      dist: {
        expand: true,
        cwd: '<%= yeoman.app %>/wordpress',
        // src: ['../tmp/**/*.jade'],
        src: ['*.jade', '{,*/}*.jade'],
        dest: '<%= yeoman.dist %>',
        ext: '.php',
        flatten: true,
        options: {
          pretty: false
        }
      }
      // dist: {
      //   expand: true,
      //   src: ['../tmp/**/*.jade'],
      //   dest: '../',
      //   ext: '.php',
      //   flatten: true,
      //   options: {
      //     pretty: false
      //   }
      // }
    },

    // Code Sniff the PHP
    phpcs: {
      application: {
        dir: ['../**/*.php']
      },
      options: {
        bin: '~/.composer/vendor/bin/phpcs',
        warningSeverity: 6,
        severity: 1
      }
    },


    // Compile Stylus to CSS
    stylus: {
      test: {
        options: {
          compress: false
        },
        files: {
          '.tmp/styles/main.css': ['<%= yeoman.app %>/styles/{,*/}*.styl']
          //'.tmp/styles/main.css': ['<%= yeoman.app %>/styles/*.styl']
        }
      },
      server: {
        options: {
          compress: false
        },
        files: {
          // '.tmp/styles/main.css': ['<%= yeoman.app %>/styles/{,*/}*.styl']
          // '.tmp/styles/grid/poxy-a-x36-y36.css': ['<%= yeoman.app %>/styles/grid/poxy-a-x36-y36.styl'],
          // '.tmp/styles/grid/poxy-a-x24-y24.css': ['<%= yeoman.app %>/styles/grid/poxy-a-x24-y24.styl'],
          // '.tmp/styles/grid/poxy-a-x27-y27.css': ['<%= yeoman.app %>/styles/grid/poxy-a-x27-y27.styl'],

          // '.tmp/styles/main.css': ['<%= yeoman.app %>/styles/*.styl'],
          // '.tmp/styles/skins/skin-dark.css': ['<%= yeoman.app %>/styles/skins/dark.styl'],
          // '.tmp/styles/skins/skin-light.css': ['<%= yeoman.app %>/styles/skins/light.styl']

          '.tmp/styles/skins/skin-light.css': ['<%= yeoman.app %>/styles/skins/light.styl'],
          '.tmp/styles/skins/skin-dark.css': ['<%= yeoman.app %>/styles/skins/dark.styl'],
          '.tmp/styles/skins/skin-flat.css': ['<%= yeoman.app %>/styles/skins/flat.styl'],
          '.tmp/styles/skins/skin-3d.css': ['<%= yeoman.app %>/styles/skins/3d.styl'],
          '.tmp/styles/grids/poxy-a-29.css': ['<%= yeoman.app %>/styles/grids/poxy-a-29.styl'],
          '.tmp/styles/grids/poxy-a.css': ['<%= yeoman.app %>/styles/grids/poxy-a.styl'],
          '.tmp/styles/grids/poxy-b.css': ['<%= yeoman.app %>/styles/grids/poxy-b.styl'],
          '.tmp/styles/grids/poxy-c.css': ['<%= yeoman.app %>/styles/grids/poxy-c.styl'],
          '.tmp/styles/grids/poxy-d.css': ['<%= yeoman.app %>/styles/grids/poxy-d.styl'],
          '.tmp/styles/grids/poxy-e.css': ['<%= yeoman.app %>/styles/grids/poxy-e.styl'],
          '.tmp/styles/main.css': ['<%= yeoman.app %>/styles/*.styl']

        }
      },
      dist: {
        options: {
          compress: true
        },
        files: {
          // '.tmp/styles/grids/poxy-a.css': ['<%= yeoman.app %>/styles/grids/poxy-a.styl'],
          // '.tmp/styles/grids/poxy-b.css': ['<%= yeoman.app %>/styles/grids/poxy-b.styl'],
          // '.tmp/styles/grids/poxy-c.css': ['<%= yeoman.app %>/styles/grids/poxy-c.styl'],
          // '.tmp/styles/grids/poxy-d.css': ['<%= yeoman.app %>/styles/grids/poxy-d.styl'],
          // '.tmp/styles/grids/poxy-e.css': ['<%= yeoman.app %>/styles/grids/poxy-e.styl'],


          '.tmp/styles/skins/skin-light.css': ['<%= yeoman.app %>/styles/skins/light.styl'],
          '.tmp/styles/skins/skin-dark.css': ['<%= yeoman.app %>/styles/skins/dark.styl'],
          '.tmp/styles/skins/skin-flat.css': ['<%= yeoman.app %>/styles/skins/flat.styl'],
          '.tmp/styles/skins/skin-3d.css': ['<%= yeoman.app %>/styles/skins/3d.styl'],

          // Zone A
          '.tmp/styles/grids/poxy-a-30.css': ['<%= yeoman.app %>/styles/grids/poxy-a-30.styl'],
          '.tmp/styles/grids/poxy-a-29.css': ['<%= yeoman.app %>/styles/grids/poxy-a-29.styl'],
          '.tmp/styles/grids/poxy-a-28.css': ['<%= yeoman.app %>/styles/grids/poxy-a-28.styl'],
          '.tmp/styles/grids/poxy-a-27.css': ['<%= yeoman.app %>/styles/grids/poxy-a-27.styl'],
          '.tmp/styles/grids/poxy-a-26.css': ['<%= yeoman.app %>/styles/grids/poxy-a-26.styl'],
          '.tmp/styles/grids/poxy-a-25.css': ['<%= yeoman.app %>/styles/grids/poxy-a-25.styl'],
          '.tmp/styles/grids/poxy-a-24.css': ['<%= yeoman.app %>/styles/grids/poxy-a-24.styl'],
          '.tmp/styles/grids/poxy-a-23.css': ['<%= yeoman.app %>/styles/grids/poxy-a-23.styl'],
          '.tmp/styles/grids/poxy-a-22.css': ['<%= yeoman.app %>/styles/grids/poxy-a-22.styl'],
          '.tmp/styles/grids/poxy-a-21.css': ['<%= yeoman.app %>/styles/grids/poxy-a-21.styl'],
          '.tmp/styles/grids/poxy-a-20.css': ['<%= yeoman.app %>/styles/grids/poxy-a-20.styl'],
          '.tmp/styles/grids/poxy-a-19.css': ['<%= yeoman.app %>/styles/grids/poxy-a-19.styl'],
          '.tmp/styles/grids/poxy-a-18.css': ['<%= yeoman.app %>/styles/grids/poxy-a-18.styl'],
          '.tmp/styles/grids/poxy-a-17.css': ['<%= yeoman.app %>/styles/grids/poxy-a-17.styl'],
          '.tmp/styles/grids/poxy-a-16.css': ['<%= yeoman.app %>/styles/grids/poxy-a-16.styl'],
          '.tmp/styles/grids/poxy-a-15.css': ['<%= yeoman.app %>/styles/grids/poxy-a-15.styl'],
          '.tmp/styles/grids/poxy-a-14.css': ['<%= yeoman.app %>/styles/grids/poxy-a-14.styl'],
          '.tmp/styles/grids/poxy-a-13.css': ['<%= yeoman.app %>/styles/grids/poxy-a-13.styl'],
          '.tmp/styles/grids/poxy-a-12.css': ['<%= yeoman.app %>/styles/grids/poxy-a-12.styl'],
          '.tmp/styles/grids/poxy-a-11.css': ['<%= yeoman.app %>/styles/grids/poxy-a-11.styl'],
          '.tmp/styles/grids/poxy-a-10.css': ['<%= yeoman.app %>/styles/grids/poxy-a-10.styl'],
          '.tmp/styles/grids/poxy-a-9.css': ['<%= yeoman.app %>/styles/grids/poxy-a-9.styl'],
          '.tmp/styles/grids/poxy-a-8.css': ['<%= yeoman.app %>/styles/grids/poxy-a-8.styl'],
          '.tmp/styles/grids/poxy-a-7.css': ['<%= yeoman.app %>/styles/grids/poxy-a-7.styl'],
          '.tmp/styles/grids/poxy-a-6.css': ['<%= yeoman.app %>/styles/grids/poxy-a-6.styl'],
          '.tmp/styles/grids/poxy-a-5.css': ['<%= yeoman.app %>/styles/grids/poxy-a-5.styl'],

          // Zone B
          '.tmp/styles/grids/poxy-b-15.css': ['<%= yeoman.app %>/styles/grids/poxy-b-15.styl'],
          '.tmp/styles/grids/poxy-b-14.css': ['<%= yeoman.app %>/styles/grids/poxy-b-14.styl'],
          '.tmp/styles/grids/poxy-b-13.css': ['<%= yeoman.app %>/styles/grids/poxy-b-13.styl'],
          '.tmp/styles/grids/poxy-b-12.css': ['<%= yeoman.app %>/styles/grids/poxy-b-12.styl'],
          '.tmp/styles/grids/poxy-b-11.css': ['<%= yeoman.app %>/styles/grids/poxy-b-11.styl'],
          '.tmp/styles/grids/poxy-b-10.css': ['<%= yeoman.app %>/styles/grids/poxy-b-10.styl'],
          '.tmp/styles/grids/poxy-b-9.css': ['<%= yeoman.app %>/styles/grids/poxy-b-9.styl'],
          '.tmp/styles/grids/poxy-b-8.css': ['<%= yeoman.app %>/styles/grids/poxy-b-8.styl'],
          '.tmp/styles/grids/poxy-b-7.css': ['<%= yeoman.app %>/styles/grids/poxy-b-7.styl'],
          '.tmp/styles/grids/poxy-b-6.css': ['<%= yeoman.app %>/styles/grids/poxy-b-6.styl'],


          // Zone C
          '.tmp/styles/grids/poxy-c-14.css': ['<%= yeoman.app %>/styles/grids/poxy-c-14.styl'],
          '.tmp/styles/grids/poxy-c-13.css': ['<%= yeoman.app %>/styles/grids/poxy-c-13.styl'],
          '.tmp/styles/grids/poxy-c-12.css': ['<%= yeoman.app %>/styles/grids/poxy-c-12.styl'],
          '.tmp/styles/grids/poxy-c-11.css': ['<%= yeoman.app %>/styles/grids/poxy-c-11.styl'],
          '.tmp/styles/grids/poxy-c-10.css': ['<%= yeoman.app %>/styles/grids/poxy-c-10.styl'],
          '.tmp/styles/grids/poxy-c-9.css': ['<%= yeoman.app %>/styles/grids/poxy-c-9.styl'],
          '.tmp/styles/grids/poxy-c-8.css': ['<%= yeoman.app %>/styles/grids/poxy-c-8.styl'],
          '.tmp/styles/grids/poxy-c-7.css': ['<%= yeoman.app %>/styles/grids/poxy-c-7.styl'],


          // Zone D
          '.tmp/styles/grids/poxy-d-10.css': ['<%= yeoman.app %>/styles/grids/poxy-d-10.styl'],
          '.tmp/styles/grids/poxy-d-9.css': ['<%= yeoman.app %>/styles/grids/poxy-d-9.styl'],
          '.tmp/styles/grids/poxy-d-8.css': ['<%= yeoman.app %>/styles/grids/poxy-d-8.styl'],
          '.tmp/styles/grids/poxy-d-7.css': ['<%= yeoman.app %>/styles/grids/poxy-d-7.styl'],
          '.tmp/styles/grids/poxy-d-6.css': ['<%= yeoman.app %>/styles/grids/poxy-d-6.styl'],
          '.tmp/styles/grids/poxy-d-5.css': ['<%= yeoman.app %>/styles/grids/poxy-d-5.styl'],


          // Zone E
          '.tmp/styles/grids/poxy-e-8.css': ['<%= yeoman.app %>/styles/grids/poxy-e-8.styl'],
          '.tmp/styles/grids/poxy-e-7.css': ['<%= yeoman.app %>/styles/grids/poxy-e-7.styl'],
          '.tmp/styles/grids/poxy-e-6.css': ['<%= yeoman.app %>/styles/grids/poxy-e-6.styl'],
          '.tmp/styles/grids/poxy-e-5.css': ['<%= yeoman.app %>/styles/grids/poxy-e-5.styl'],
          '.tmp/styles/grids/poxy-e-4.css': ['<%= yeoman.app %>/styles/grids/poxy-e-4.styl'],
          '.tmp/styles/grids/poxy-e-3.css': ['<%= yeoman.app %>/styles/grids/poxy-e-3.styl'],
          '.tmp/styles/grids/poxy-e-2.css': ['<%= yeoman.app %>/styles/grids/poxy-e-2.styl'],






          '.tmp/styles/main.css': ['<%= yeoman.app %>/styles/*.styl']
        }
      }
    },


    // Compile Jade to HTML
    jade: {
      options: {
        pretty: true
      },
      server: {
        files: [{
          expand: true,
          cwd: '<%= yeoman.app %>',
          dest: '.tmp',
          src: ['*.jade', 'views/{,*/}*.jade'],
          ext: '.html'
        }]
      },
      dist: {
        files: [{
          expand: true,
          cwd: '<%= yeoman.app %>',
          dest: '<%= yeoman.dist %>',
          src: ['*.jade', 'views/{,*/}*.jade'],
          ext: '.html'
        }]
      }
    },


    // The actual grunt server settings
    connect: {
      options: {
        port: 9000,
        // Change this to '0.0.0.0' to access the server from outside.
        hostname: 'localhost',
        livereload: 12345
      },
      livereload: {
        options: {
          open: true,
          base: [
          '.tmp',
          '<%= yeoman.app %>'
          ]
        }
      },
      test: {
        options: {
          port: 9001,
          base: [
          '.tmp',
          'test',
          '<%= yeoman.app %>'
          ]
        }
      },
      dist: {
        options: {
          base: '<%= yeoman.dist %>'
        }
      }
    },

    // Make sure code styles are up to par and there are no obvious mistakes
    jshint: {
      options: {
        jshintrc: '.jshintrc',
        reporter: require('jshint-stylish')
      },
      all: {
        src: [
        'Gruntfile.js'
        ]
      }
    },

    // Empties folders to start fresh
    clean: {
      dist: {
        files: [{
          dot: true,
          src: [
          '.tmp',
          '<%= yeoman.dist %>/*',
          '!<%= yeoman.dist %>/.git*'
          ]
        }]
      },
      server: '.tmp'
    },

    // Add vendor prefixed styles
    autoprefixer: {
      options: {
        browsers: ['last 1 version']
      },
      dist: {
        files: [{
          expand: true,
          cwd: '.tmp/styles/',
          src: '{,*/}*.css',
          dest: '.tmp/styles/'
        }]
      }
    },

    // Automatically inject Bower components into the app
    bowerInstall: {
      app: {
        src: ['<%= yeoman.app %>/index.jade'],

        ignorePath: '<%= yeoman.app %>/'
      }
    },

    // Compiles CoffeeScript to JavaScript
    coffee: {
      options: {
        sourceMap: true,
        sourceRoot: ''
      },
      server: {
        files: [{
          expand: true,
          cwd: '<%= yeoman.app %>/scripts',
          src: '{,*/}*.coffee',
          dest: '.tmp/scripts',
          ext: '.js'
        }]
      },
      dist: {
        sourceMap: false,
        files: [{
          expand: true,
          cwd: '<%= yeoman.app %>/scripts',
          src: '{,*/}*.coffee',
          dest: '.tmp/scripts',
          ext: '.js'
        }]
      },
      test: {
        files: [{
          expand: true,
          cwd: 'test/spec',
          src: '{,*/}*.coffee',
          dest: '.tmp/spec',
          ext: '.js'
        }]
      }
    },

    // Renames files for browser caching purposes
    rev: {
      dist: {
        files: {
          src: [
          '<%= yeoman.dist %>/scripts/{,*/}*.js',
          '<%= yeoman.dist %>/styles/{,*/}*.css',
          '<%= yeoman.dist %>/images/{,*/}*.{png,jpg,jpeg,gif,webp,svg}',
          '<%= yeoman.dist %>/styles/fonts/*'
          ]
        }
      }
    },

    // Reads HTML for usemin blocks to enable smart builds that automatically
    // concat, minify and revision files. Creates configurations in memory so
    // additional tasks can operate on them
    useminPrepare: {
      html: '<%= yeoman.dist %>/index.html',
      options: {
        root: '<%= yeoman.app %>',
        dest: '<%= yeoman.dist %>',
        flow: {
          html: {
            steps: {
              js: ['concat', 'uglifyjs'],
              css: ['cssmin']
            },
            post: {}
          }
        }
      }
    },

    // Performs rewrites based on rev and the useminPrepare configuration
    usemin: {
      html: ['<%= yeoman.dist %>/{,*/}*.html'],
      css: ['<%= yeoman.dist %>/styles/{,*/}*.css'],
      options: {
        assetsDirs: ['<%= yeoman.dist %>']
      }
    },

    // The following *-min tasks produce minified files in the dist folder
    // cssmin: {
    //   options: {
    //     root: '<%= yeoman.app %>'
    //   }
    // },

    imagemin: {
      dist: {
        files: [{
          expand: true,
          cwd: '<%= yeoman.app %>/images',
          // src: '{,*/}*.{png,jpg,jpeg,gif}',
          src: '*.{png,jpg,jpeg,gif}',
          dest: '<%= yeoman.dist %>/images'
        }]
      }
    },

    svgmin: {
      dist: {
        files: [{
          expand: true,
          cwd: '<%= yeoman.app %>/images',
          src: '{,*/}*.svg',
          dest: '<%= yeoman.dist %>/images'
        }]
      }
    },

    htmlmin: {
      dist: {
        options: {
          collapseWhitespace: false,
          collapseBooleanAttributes: true,
          removeCommentsFromCDATA: true,
          removeOptionalTags: true
        },
        files: [{
          expand: true,
          cwd: '<%= yeoman.dist %>',
          src: ['*.html', 'views/{,*/}*.html'],
          dest: '<%= yeoman.dist %>'
        }]
      }
    },

    // ngmin tries to make the code safe for minification automatically by
    // using the Angular long form for dependency injection. It doesn't work on
    // things like resolve or inject so those have to be done manually.
    ngmin: {
      dist: {
        files: [{
          expand: true,
          cwd: '.tmp/concat/scripts',
          src: '*.js',
          dest: '.tmp/concat/scripts'
        }]
      }
    },

    // Replace Google CDN references
    cdnify: {
      dist: {
        html: ['<%= yeoman.dist %>/*.html']
      }
    },

    // Copies remaining files to places other tasks can use
    copy: {
      server: {
        files: [{
          expand: true,
          cwd: '<%= yeoman.app %>/bower_components/poxy/css/grids',
          dest: '.tmp/styles/',
          src: '{,*/}*.css'
        }]
      },
      dist: {
        files: [
          {expand: true, cwd: '<%= yeoman.app %>/wordpress/', src: ['admin/**'], dest: '<%= yeoman.dist %>'},
          {expand: true, cwd: '<%= yeoman.app %>/wordpress/', src: ['*.php'], dest: '<%= yeoman.dist %>'},
          {expand: true, cwd: '<%= yeoman.app %>/wordpress/', src: ['*.css'], dest: '<%= yeoman.dist %>'},
          {
          expand: true,
          dot: true,
          cwd: '<%= yeoman.app %>',
          dest: '<%= yeoman.dist %>',
        src: [ '*.{ico,png,txt}', '.htaccess', '*.html', 'views/{,*/}*.html', 'images/{,*/}*.{webp}', 'fonts/{,*/}*' ]
          },
          {
          expand: true,
          cwd: '.tmp/images',
          dest: '<%= yeoman.dist %>/images',
          src: ['generated/*']
          }
        ]
      },
      styles: {
        expand: true,
        cwd: '<%= yeoman.app %>/styles',
        dest: '.tmp/styles/',
        src: '{,*/}*.css'
      }
    },

    // Run some tasks in parallel to speed up the build process
    concurrent: {
      server: [
      'coffee:server',
      'stylus:server'
      ],
      test: [
      'coffee:server',
      'coffee:test',
      'stylus:test'
      ],
      dist: [
      'imagemin',
      'svgmin'
      ]
    },

    // By default, your `index.html`'s <!-- Usemin block --> will take care of
    // minification. These next options are pre-configured if you do not wish
    // to use the Usemin blocks.
    cssmin: {
      dist: {
        files: {
          '<%= yeoman.dist %>/styles/main.css': [
          '.tmp/styles/{,*/}*.css',
          '<%= yeoman.app %>/styles/{,*/}*.css'
          ]
        }
      },
      poxy: {
        files: [
          {
            expand: true,
            cwd: '.tmp/styles/',
            src: ['main.css'],
            dest: '<%= yeoman.dist %>/styles',
            ext: '.css'
          },
          {
            expand: true,
            cwd: '.tmp/styles/skins/',
            src: ['*.css'],
            dest: '<%= yeoman.dist %>/styles',
            ext: '.css'
          },
          {
            expand: true,
            cwd: '.tmp/styles/grids/',
            src: ['*.css'],
            dest: '<%= yeoman.dist %>/styles',
            ext: '.css'
          }
          // {
          //   expand: true,
          //   cwd: '.tmp/styles/grids/',
          //   src: ['poxy-a.css'],
          //   dest: '<%= yeoman.dist %>/styles',
          //   ext: '.css'
          // },
          // {
          //   expand: true,
          //   cwd: '.tmp/styles/grids/',
          //   src: ['poxy-b.css'],
          //   dest: '<%= yeoman.dist %>/styles',
          //   ext: '.css'
          // },
          // {
          //   expand: true,
          //   cwd: '.tmp/styles/grids/',
          //   src: ['poxy-c.css'],
          //   dest: '<%= yeoman.dist %>/styles',
          //   ext: '.css'
          // },
          // {
          //   expand: true,
          //   cwd: '.tmp/styles/grids/',
          //   src: ['poxy-d.css'],
          //   dest: '<%= yeoman.dist %>/styles',
          //   ext: '.css'
          // },
          // {
          //   expand: true,
          //   cwd: '.tmp/styles/grids/',
          //   src: ['poxy-e.css'],
          //   dest: '<%= yeoman.dist %>/styles',
          //   ext: '.css'
          // },
          // {
          //   expand: true,
          //   cwd: '.tmp/styles/grids/',
          //   src: ['poxy-e.css'],
          //   dest: '<%= yeoman.dist %>/styles',
          //   ext: '.css'
          // }
        ]
      }
    },
    uglify: {
      dist: {
        files: {
          '<%= yeoman.dist %>/scripts/scripts.js': [
          '<%= yeoman.dist %>/scripts/scripts.js'
          ]
        }
      }
    },
    concat: {
      dist: {}
    },

    // Test settings
    karma: {
      unit: {
        configFile: 'test/karma.conf.coffee',
        singleRun: true
      }
    },

    bump: {
      options: {
        files: ['package.json', 'bower.json'],
        updateConfigs: [],
        commit: true,
        commitMessage: 'Release v%VERSION%',
        commitFiles: ['package.json'],
        createTag: true,
        tagName: 'v%VERSION%',
        tagMessage: 'Version %VERSION%',
        push: true,
        pushTo: 'origin',
        gitDescribeOptions: '--tags --always --abbrev=1 --dirty=-d',
        globalReplace: false
      }
    },

    secret: grunt.file.readJSON('secret.json'),
    // www.poxy.io/web/content/test
    sftp: {
      options: {
        path: 'www.paulwood.io/web/content/content/themes/test',
        host: '<%= secret.host %>',
        username: '<%= secret.username %>',
        password: '<%= secret.password %>',
        srcBasePath: '<%= yeoman.dist %>',
        showProgress: true
      },
      target1: {
        // src: '<%= yeoman.dist %>/**'
        src: '<%= yeoman.dist %>'
      }
    }

  });


  grunt.registerTask('serve', 'Compile then start a connect web server', function (target) {
    if (target === 'dist') {
      return grunt.task.run(['build', 'connect:dist:keepalive']);
    }

    grunt.task.run([
      'clean:server',
      'bowerInstall',
      'jade:server',
      // 'copy:server',
      'concurrent:server',
      'autoprefixer',
      'connect:livereload',
      'watch'
      ]);
    });

    grunt.registerTask('server', 'DEPRECATED TASK. Use the "serve" task instead', function (target) {
      grunt.log.warn('The `server` task has been deprecated. Use `grunt serve` to start a server.');
      grunt.task.run(['serve:' + target]);
    });

    grunt.registerTask('test', [
    'clean:server',
    'concurrent:test',
    'autoprefixer',
    'connect:test',
    'karma'
    ]);

    grunt.registerTask('build', [
    'clean:dist',
    'bowerInstall',
    'jade:dist',
    'jadephp:dist',
    'coffee:dist',
    'stylus:dist',
    'useminPrepare',
    'concurrent:dist',
    'autoprefixer',
    'concat',
    'ngmin',
    'copy:dist',
    'cdnify',
    'cssmin',
    'cssmin:poxy',
    'uglify',
    //'rev'
    'usemin'
    //'htmlmin'
    ]);

    grunt.registerTask('deploy', [
    // 'build',
    'sftp'
    ]);

    grunt.registerTask('default', [
    'newer:jshint',
    'test',
    'build'
    ]);

    // Development task
    grunt.registerTask('php', function() {
      grunt.task.run([
          'jadephp:dev'
          // 'phpcs:application',
      ]);
    });

    // Development task
    grunt.registerTask('wp', function() {
      grunt.task.run([
          'jadephp:dist',
          'copy:dist',
          'watch:jadephp'
      ]);
    });

  };
