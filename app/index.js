'use strict';
var util = require('util');
var path = require('path');
var yeoman = require('yeoman-generator');
var chalk = require('chalk');

var WpGruntedThemeGenerator = module.exports = function WpGruntedThemeGenerator(args, options, config) {
  yeoman.generators.Base.apply(this, arguments);

  this.on('end', function () {
  	if (this.themeNameSpace) {
	  	process.chdir(this.themeNameSpace+"/grunt/");
	    this.installDependencies({ skipInstall: options['skip-install'], bower: false });
  	}
  });

  this.pkg = JSON.parse(this.readFileAsString(path.join(__dirname, '../package.json')));
};

util.inherits(WpGruntedThemeGenerator, yeoman.generators.Base);

WpGruntedThemeGenerator.prototype.askFor = function askFor() {
  var cb = this.async();

  console.log("\n\n                           "+chalk.blue.bold("**")+"         \n"+"           "+chalk.blue.bold("****")+"    "+chalk.blue.bold("****")+"    "+chalk.blue.bold("****")+"       \n"+"  "+chalk.yellow("GGGGG")+"  "+chalk.yellow("RRRR")+""+chalk.blue.bold("*")+"  "+chalk.yellow("U")+"   "+chalk.blue.bold("*")+""+chalk.yellow("U")+"  "+chalk.yellow("N")+"   "+chalk.blue.bold("*")+""+chalk.yellow("N")+"  "+chalk.yellow("TTTTTT")+"\n"+""+chalk.yellow("GG")+"       "+chalk.yellow("R")+"   "+chalk.yellow("R")+""+chalk.blue.bold("*")+" "+chalk.yellow("U")+"   "+chalk.blue.bold("*")+""+chalk.yellow("U")+""+chalk.blue.bold("*")+" "+chalk.yellow("N")+" "+chalk.yellow("N")+" "+chalk.blue.bold("*")+""+chalk.yellow("N")+"    "+chalk.yellow("TT")+"  \n"+""+chalk.yellow("GG")+"  "+chalk.yellow("GGG")+"  "+chalk.yellow("RRR")+"  "+chalk.blue.bold("**")+""+chalk.yellow("U")+"  "+chalk.blue.bold("*")+" "+chalk.yellow("U")+""+chalk.blue.bold("**")+""+chalk.yellow("N")+"  "+chalk.yellow("N")+" "+chalk.yellow("N")+"    "+chalk.yellow("TT")+"  \n"+"  "+chalk.yellow("GGGGG")+"  "+chalk.yellow("R")+"   "+chalk.yellow("R")+" "+chalk.blue.bold("**")+" "+chalk.yellow("UU")+"   "+chalk.blue.bold("*")+""+chalk.yellow("N")+" "+chalk.blue.bold("*")+"  "+chalk.yellow("N")+"    "+chalk.yellow("TT")+"  \n"+"                "+chalk.blue.bold("**")+"      "+chalk.blue.bold("**")+"            \n\n "+chalk.yellow.bold("*")+""+chalk.blue.bold("START YOUR GRUNTED WORDPRESS THEME")+""+chalk.yellow.bold("*")+" \n\n");

  var prompts = [{
    name: 'themeName',
    message: 'Name of the theme you want to create?'
  },{
    name: 'themeNameSpace',
    message: 'Uniq name-space for the theme (alphanumeric)?',
    default: function( answers ) {
		return answers.themeName.replace(/\W/g, '').toLowerCase();
	}
  },{
    name: 'themeAuthor',
    message: 'Name of the themes author?',
    default: function( answers ) {
		return 'John Doe';
	}
  },{
    name: 'themeAuthorURI',
    message: 'Website of the themes authors?',
    default: function( answers ) {
		return 'http://www.'+answers.themeAuthor.replace(/\W/g, '').toLowerCase()+'.com';
	}
  },{
    name: 'themeURI',
    message: 'Website of the theme?',
	default: function( answers ) {
		return answers.themeAuthorURI+'/'+answers.themeNameSpace;
	}
  },{
  	type: 'checkbox',
    name: 'themeTags',
    message: 'Theme tags ( more available on wordpress.org )?',
    choices: ['dark','light','left-sidebar','right-sidebar','fixed-layout','fluid-layout','responsive-layout']
  },{
    name: 'themeDescription',
    message: 'Description of the theme?',
    default: function( answers ) {
		return 'This is a description for the '+answers.themeName+' theme.';
	}
  }];

  this.prompt(prompts, function (props) {
    this.themeName = props.themeName;
    this.themeNameSpace = props.themeNameSpace;
    this.themeAuthor = props.themeAuthor;
    this.themeAuthorURI = props.themeAuthorURI;
    this.themeURI = props.themeURI;
    this.themeTags = props.themeTags;
    this.themeDescription = props.themeDescription;
    this.jshintTag = '<%= jshint.all %>';

    cb();
  }.bind(this));
};

WpGruntedThemeGenerator.prototype.app = function app() {
  var currentDate = new Date()
  this.themeCreated = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate();

  this.directory('theme', this.themeNameSpace);
  this.mkdir(this.themeNameSpace+'/dist');
  this.mkdir(this.themeNameSpace+'/fonts');
  this.mkdir(this.themeNameSpace+'/grunt');

  this.template('_gruntfile.js', this.themeNameSpace+'/grunt/gruntfile.js')
  this.template('_package.json', this.themeNameSpace+'/grunt/package.json')
};
