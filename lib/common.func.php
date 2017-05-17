<?php
/**
 * Created by PhpStorm.
 * User: liwei
 * Date: 2017/4/27
 * Time: 18:18
 */

/**
 * @param $mes
 * @param $url
 */
function alertMes($mes,$url){
    echo "<script>alert('{$mes}');</script>";
    echo "<script>window.location='{$url}';</script>";
}
