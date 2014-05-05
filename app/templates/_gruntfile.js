module.exports = function(grunt) {

  grunt.initConfig({

    pkg: grunt.file.readJSON('package.json'),

    // chech our JS
    jshint: {
      options: {
        "bitwise": true,
        "browser": true,
        "curly": true,
        "eqeqeq": true,
        "eqnull": true,
        "esnext": true,
        "immed": true,
        "jquery": true,
        "latedef": true,
        "newcap": true,
        "noarg": true,
        "node": true,
        "strict": false,
        "trailing": true,
        "undef": true,
        "globals": {
          "jQuery": true,
          "alert": true
        }
      },
      all: [
        'gruntfile.js'
      ]
    },

    // minify our JS
    uglify: {

      options: {
        banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - <%= grunt.template.today("yyyy-mm-dd") %> */',
        report: 'gzip'
      },

      dev: {
        options: {
          mangle:           false,
          compress:         false,
          sourceMap:        function ( path ) { return path + '.map'; }
        },
        files: {
          '../js/head.js': ['./bower_components/modernizr/modernizr.js','../js/head/*.js'],
          '../js/body.js': ['../js/body/*.js']
        }
      },

      prod: {
        files: {
          '../js/head.js': ['./bower_components/modernizr/modernizr.js','../js/head/*.js'],
          '../js/body.js': ['../js/body/*.js']
        }
      }
    },

    // compile your sass
    sass: {
      options: {
        loadPath: './bower_components/bootstrap-sass/lib'
      },
      dev: {
        options: {
          style: 'expanded'
        },
        src: ['../scss/style.scss'],
        dest: '../css/style.css'
      },
      dist: {
        options: {
          style: 'compressed'
        },
        src: ['../scss/style.scss'],
        dest: '../css/style.css'
      }
    },

    // watch for changes
    watch: {
      scss: {
        files: ['../scss/**/*.scss'],
        tasks: [
          'sass:dev',
          'notify:scss'
        ]
      },
      js: {
        files: [
          '<%= jshint.all %>'
        ],
        tasks: [
          'uglify:dev',
          'notify:js'
        ]
      },
      livereload: {
        options: { livereload: true },
        files: ['../css/**/*.css','../js/**/*.js']
      }
    },

    // notify cross-OS
    notify: {
      scss: {
        options: {
          title: 'Grunt, grunt!',
          message: 'SCSS is all gravy'
        }
      },
      js: {
        options: {
          title: 'Grunt, grunt!',
          message: 'JS is all good'
        }
      },
      dist: {
        options: {
          title: 'Grunt, grunt!',
          message: 'Theme ready for production'
        }
      }
    }
    }
  });

  // Default task
  grunt.registerTask('default', ['watch']);

};