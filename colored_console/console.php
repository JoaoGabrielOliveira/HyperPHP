<?php
    function printc($text, $color):void
    {
        echo $color . "$text" . "\e[39m ";
    }

    function print_red($text)
    {
        printc($text, "\e[91m");
    }

    function print_green($text)
    {
        printc($text, "\e[92m");
    }

    function print_blue($text)
    {
        printc($text, "\e[34m");
    }

    function print_yellow($text)
    {
        printc($text, "\e[93m");
    }

    function print_white($text)
    {
        printc($text, "\e[97m");
    }

?>