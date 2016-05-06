<?php
namespace Gsdw\Social\Helpers;

class Output
{
    public static function googleButton($text = 'Rikkeisoft Login')
    {
        $url = url('social/redirect/google');
        $html = "<a href=\"{$url}\" class=\"btn btn-google-login\">";
        $html .= $text;
        $html .= '</a>';
        return $html;
    }
}
