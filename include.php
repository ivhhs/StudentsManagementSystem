<?php
/**
 * Created by PhpStorm.
 * User: liwei
 * Date: 2017/5/11
 * Time: 20:36
 */

header("content-type: text/html; charset = utf-8");
session_start();

define("ROOT", dirname(__FILE__));

set_include_path(".".PATH_SEPARATOR.ROOT."/lib".PATH_SEPARATOR.ROOT."/core".PATH_SEPARATOR.ROOT."/configs".PATH_SEPARATOR.get_include_path());
require_once 'mysql.func.php';
require_once 'images.func.php';
require_once 'common.func.php';
require_once 'string.func.php';
require_once 'page.func.php';
require_once 'configs.php';
require_once 'admin.inc.php';

//$mysqli = new DbOperat();