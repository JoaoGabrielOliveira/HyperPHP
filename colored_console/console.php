<?php
    function printc($text, $color, $return=true)
    {
        $text = $color . "$text" . "\e[39m ";

        if($return === true)
        {
            return $text;
        }

        echo $text;
    }

    function print_red($text,$rr=true)
    {
        return printc($text, "\e[91m", $rr);
    }

    function print_green($text,$rr=true)
    {
        return printc($text, "\e[92m", $rr);
    }

    function print_blue($text,$rr=true)
    {
        return printc($text, "\e[34m", $rr);
    }

    function print_yellow($text,$rr=true)
    {
        return printc($text, "\e[93m", $rr);
    }

    function print_white($text,$rr=true)
    {
        return printc($text, "\e[97m", $rr);
    }

?>