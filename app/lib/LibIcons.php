<?php

class LibIcons
{
    public static function i($alias, $class = ''): string
    {
        return "
        <span class=' d-md-none d-lg-inline-block $class'>
            <svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24'
            stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'>
                ".self::$icons[$alias]."
            </svg>
        </span>
        ";
    }

    private static array $icons = [
        'home' =>  "<path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M5 12l-2 0l9 -9l9 9l-2 0' /><path d='M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7' /><path d='M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6' />",
        'gear' =>  '<path stroke="none" d="M0 0h24v24H0z" fill="none" /> <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /> <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />',
        'power' => '  <path stroke="none" d="M0 0h24v24H0z" fill="none" /> <path d="M7 6a7.75 7.75 0 1 0 10 0" /> <path d="M12 4l0 8" />',
        'ex' => '',
    ];
}