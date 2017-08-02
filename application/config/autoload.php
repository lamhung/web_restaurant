<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('form_validation', 'session', 'pagination');

$autoload['drivers'] = array();

$autoload['helper'] = array('url', 'form', 'string', 'date', 'number', 'html', 'cookie', 'file', 'directory', 'language');

$autoload['config'] = array('my_config');

$autoload['language'] = array();

$autoload['model'] = array('user_model', 'menu_model');
