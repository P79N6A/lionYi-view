<?php
##version
namespace bear\sys\session\build;

interface AbSession
{
    public function connect();

    public function read();

    public function gc();

    public function flush();
}