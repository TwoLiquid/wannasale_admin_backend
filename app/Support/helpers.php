<?php

const GUARD_DASHBOARD = 'dashboard';

if (!function_exists('nl2br2')) {
    /**
     * @param string|null $string
     * @return string
     */
    function nl2br2(?string $string) : string
    {
        return $string !== null
            ? str_replace(["\r\n", "\r", "\n"], '<br />', $string)
            : '';
    }
}

if (!function_exists('pretty_file_size')) {
    /**
     * Generates pretty file size from bytes amount.
     *
     * @param int $bytes
     * @param int $precision
     * @return string
     */
    function pretty_file_size(int $bytes, int $precision = 1) : string
    {
        if ($bytes >= 1000000000000) {
            $bytes = round($bytes / 1099511627776, $precision);
            $unit = 'ТБ';
        } elseif ($bytes >= 1000000000) {
            $bytes = round($bytes / 1073741824, $precision);
            $unit = 'ГБ';
        } elseif ($bytes >= 1000000) {
            $bytes = round($bytes / 1048576, $precision);
            $unit = 'МБ';
        } elseif ($bytes >= 1000) {
            $bytes = round($bytes / 1024, $precision);
            $unit = 'КБ';
        } else {
            $unit = 'байт';
            return number_format($bytes) . ' ' . $unit;
        }

        return number_format($bytes, $precision) . ' ' . $unit;
    }
}

if (!function_exists('random_digit_code')) {
    /**
     * @param int $digits
     * @return string
     */
    function random_digit_code(int $digits = 4) : string
    {
        $code = '';
        for ($i = 1; $i <= $digits; $i++) {
            $code .= mt_rand(0, 9);
        }
        return $code;
    }
}

if (!function_exists('parse_domain')) {
    /**
     * @param string $url
     * @return null|string
     */
    function parse_domain(string $url) : ?string
    {
        $domain = parse_url($url, PHP_URL_HOST);
        return $domain === null
            ? $url
            : $domain;
    }
}
