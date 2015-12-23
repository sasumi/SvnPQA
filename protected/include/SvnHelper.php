<?php
namespace SvnPQA;
use Lite\Component\Client;
use Lite\Component\Server;
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

    public function update($dir){
        return $this->exec('checkout', array($this->address, $dir));
    }

    public function checkOut($dir){
        return $this->exec('checkout', array($this->address, $dir));
    }

    public function exec($cmd, $param=array()){
        $param_str = '';
        $param_str .= $this->user ? " --username {$this->user}" : '';
        $param_str .= $this->password ? " --password {$this->password}" : '';
        $param_str .= $this->no_auth_cache ? ' --no-auth-cache' : '';

        foreach($param as $k=>$v){
            if(is_numeric($k)){
                $param_str .= " $v";
            } else {
                $param_str .= " --$k $v";
            }
        }
        $command_lines = "{$this->svn_cmd} $cmd $param_str";
        $ret = shell_exec($command_lines);
        if(Server::inWindows()){
            $ret = mb_convert_encoding($ret, 'utf-8', 'gb2312');
        }
        return $ret;
    }
}