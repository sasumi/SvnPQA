<?php
namespace SvnPQA;
use function Lite\func\dump;

/**
 * Created by PhpStorm.
 * User: Sasumi
 * Date: 2015/12/8
 * Time: 18:05
 */
class SvnHelper {
    private $svn_cmd = 'svn';

    private $address;
    private $user;
    private $password;
    private $no_auth_cache = true;

    public function __construct($address=null, $user=null, $password=null){
        $this->address = $address;
        $this->user = $user;
        $this->password = $password;
    }

    public function setCommandPath($cmd){
        $this->svn_cmd = $cmd;
    }

    public function checkOut($dir){
        $param = array($this->address, $dir);
        $ret = $this->exec('checkout', $param);

        return $this->parserResult($ret);
    }

    private function parserResult($str){
        return '';
    }

    public function exec($cmd, $param=array()){
        $param_str = '';
        $param_str .= $this->user ? " --username {$this->user}" : '';
        $param_str .= $this->password ? "--password {$this->password}" : '';
        $param_str .= $this->no_auth_cache ? ' --no-auth-cache' : '';

        foreach($param as $k=>$v){
            if(is_numeric($k)){
                $param_str .= " $v";
            } else {
                $param_str .= " --$k $v";
            }
        }

        dump($param_str, 1);

        $command_lines = "{$this->svn_cmd} $cmd $param_str";
        $ret = shell_exec($command_lines);
        dump($ret, 1);

        return '';
    }
}