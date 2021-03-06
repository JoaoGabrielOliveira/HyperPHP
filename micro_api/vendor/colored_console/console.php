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

    function info_success($text_current,$text_succes="SUCESSO",$symbol="✔")
    {
        $full_text = print_green("\n$symbol") . 
        print_white($text_current) .
        print_green($text_succes . "!\n");

        echo $full_text;
        return $full_text;
    }


    function info_fail($text_current,$text_succes="FALHOU",$symbol="✕")
    {
        $full_text = print_red("\n$symbol") . 
        print_white($text_current) .
        print_red($text_succes . "!\n");

        echo $full_text;
        return $full_text;
    }

?>