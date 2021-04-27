<?php

namespace App\Services;

class Functions
{
    // =========================================================================
    // Searchers
    // =========================================================================

    /**
     * Search an array of arrays for $searchValue on $searchKey and, if it finds a match, return the value on $returnKey or the whole subarray
     */
    public static function multidimensionalArraySearch($multiArray, $searchKey, $searchValue, $returnKey = null)
    {
        foreach ($multiArray as $array) {
            if ($array[$searchKey] == $searchValue) {
                if ($returnKey) {
                    return $array[$returnKey];
                } else {
                    return $array;
                }
            }
        }

        return null;
    }

    /**
     * Search an array of objects for $searchValue on $searchField and, if it finds a match, return the value on $returnField or the whole object
     */
    public static function objectArraySearch($objectArray, $searchField, $searchValue, $returnField = null)
    {
        foreach ($objectArray as $object) {
            if ($object->$searchField == $searchValue) {
                if ($returnField) {
                    return $object->$returnField;
                } else {
                    return $object;
                }
            }
        }

        return null;
    }

    // =========================================================================
    // Formatters
    // =========================================================================

    /**
     * Datetime format
     *
     * @return string
     */
    public static function formatDatetime($value)
    {
        return isset($value)? \Carbon::parse($value)->format("d/m/Y H:i") : null;
    }

    /**
     * Date format
     *
     * @return string
     */
    public static function formatDate($value)
    {
        return isset($value)? \Carbon::parse($value)->format("d/m/Y") : null;
    }

    /**
     * Time format
     *
     * @return string
     */
    public static function formatTime($value)
    {
        return isset($value)? \Carbon::parse($value)->format("H:i") : null;
    }

    /**
     * Boolean format
     *
     * @return string
     */
    public static function formatBoolean($value)
    {
        return boolval($value)? \Lang::get("text.yes") : \Lang::get("text.no");
    }

    /**
     * Percentage format
     *
     * @return string
     */
    public static function formatPercentage($value)
    {
        return isset($value)? number_format($value, 2, ",", ".")."%" : null;
    }

    /**
     * Integer format
     *
     * @return string
     */
    public static function formatInteger($value)
    {
        return isset($value)? number_format($value, 0, ",", ".") : null;
    }

    /**
     * Decimal format
     *
     * @return string
     */
    public static function formatDecimal($value)
    {
        return isset($value)? number_format($value, 2, ",", ".") : null;
    }

    /**
     * Decimal format only if number has decimal places
     *
     * @return string
     */
    public static function formatOptionalDecimal($value)
    {
        return isset($value)? ((fmod($value, 1)===0.00? number_format($value, 0, ",", ".") : number_format($value, 2, ",", "."))) : null;
    }

    /**
     * Latitude and longitude format
     *
     * @return string
     */
    public static function formatCoordinate($value)
    {
        return isset($value)? number_format($value, 8, ",", ".") : null;
    }

    /**
     * BRL currency format
     *
     * @return string
     */
    public static function formatCurrency($value)
    {
        return isset($value)? (new \NumberFormatter("pt_BR", \NumberFormatter::CURRENCY))->formatCurrency($value, "BRL") : null;
    }

    /**
     * Sentence format (only first letter capitalized)
     *
     * @return string
     */
    public static function formatSentence($value)
    {
        return isset($value)? ucfirst(strtolower($value)) : null;
    }

    /**
     * Title format (all letters capitalized, except $exceptions)
     * 
     * Exceptions all in lower case => words to keep all as lower case
     * Exceptions all in upper case => words to keep all as upper case
     * 
     * @return string
     */
    public static function formatTitle($string, $delimiters = array(" ", "-", ".", "'"), $exceptions = array("da", "das", "do", "dos", "de", "d", "para", "e", "em", "o", "os", "a", "as", "etc", "(da", "(das", "(do", "(dos", "(de", "(d", "(para", "(e", "(em", "(o", "(os", "(a", "(as", "etc)", "CFTV)", "EPI", "EPIS", "IOT", "IT", "MRO"))
    {
        $string = mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
        foreach ($delimiters as $delimiter) {
            $words = explode($delimiter, $string);
            $newwords = array();

            foreach ($words as $word) {
                // Check exceptions list for any words that should be in upper case
                if (in_array(mb_strtoupper($word, "UTF-8"), $exceptions)) {
                    $word = mb_strtoupper($word, "UTF-8");

                // Check exceptions list for any words that should be in lower case
                } elseif (in_array(mb_strtolower($word, "UTF-8"), $exceptions)) {
                    $word = mb_strtolower($word, "UTF-8");

                // Convert to uppercase (non-utf8 only)
                } elseif (!in_array($word, $exceptions)) {
                    if(strlen($word) > 0) $word = mb_strtoupper(mb_substr($word, 0, 1, "UTF-8"), "UTF-8") . mb_substr($word, 1, null, "UTF-8");
                }

                array_push($newwords, $word);
            }

            $string = join($delimiter, $newwords);
        }
        return $string;
    }


    /**
     * Format phone using mask
     * 
     * @return string
     */
    public static function formatPhone($value)
    {
        if (isset($value)) {
            $cleanValue = str_replace(["+", "\\", " ", "-", "(", ")"], "", $value);
            switch (strlen($cleanValue)) {
                case 8:
                    return Functions::mask($cleanValue, "####-####");
                    break;

                case 9:
                    return Functions::mask($cleanValue, "#####-####");
                    break;
            
                case 10:
                    return Functions::mask($cleanValue, "(##) ####-####");
                    break;

                case 11:
                    return Functions::mask($cleanValue, "(##) #####-####");
                    break;

                case 12:
                    return Functions::mask($cleanValue, "+## (##) ####-####");
                    break;

                case 13:
                    return Functions::mask($cleanValue, "+## (##) #####-####");
                    break;

                default:
                    return $value;
                    break;
            }
        } else {
            return null;
        }
    }

    /**
     * Format CNPJ using mask
     * 
     * @return string
     */
    public static function formatCnpj($value)
    {
        if (isset($value)) {
            $cleanValue = str_replace([" ", "-", ".", "/"], "", $value);
            return Functions::mask($cleanValue, "##.###.###/####-##");

        } else {
            return null;
        }
    }

    /**
     * Format CPF using mask
     * 
     * @return string
     */
    public static function formatCpf($value)
    {
        if (isset($value)) {
            $cleanValue = str_replace([" ", "-", ".", "/"], "", $value);
            return Functions::mask($cleanValue, "###.###.###-##");
            
        } else {
            return null;
        }
    }

    /**
     * Format vehicle plate using mask
     * 
     * @return string
     */
    public static function formatVehiclePlate($value)
    {
        if (isset($value)) {
            $cleanValue = str_replace([" ", "-", "."], "", $value);
            return Functions::mask($cleanValue, "###-####");

        } else {
            return null;
        }
    }

    /**
     * Apply $mask to $val
     * 
     * @return string
     */
    public static function mask($val, $mask)
    {
        $maskared = "";
        $k = 0;

        for ($i = 0; $i<=strlen($mask)-1; $i++) {
            if ($mask[$i] == "#") {
                if (isset($val[$k])) $maskared .= $val[$k++];
            } else {
                if(isset($mask[$i])) $maskared .= $mask[$i];
            }
        }

        return $maskared;
    }

    // =========================================================================
    // Unformatters
    // =========================================================================

    /**
     * BRL currency format to double
     *
     * @return double
     */
    public static function unformatCurrency($value)
    {
        if (isset($value)) {
            $cleanValue = str_replace(["R", "$", " "], "", $value);
            if (strpos($cleanValue, ",") !== false) {
                $cleanValue = str_replace(".", "", $cleanValue);
                $cleanValue = str_replace(",", ".", $cleanValue);
            }
            return (double) $cleanValue;
            
        } else {
            return null;
        }
    }

    // =========================================================================
    // Others
    // =========================================================================

    /**
     * Lightens/darkens a given colour (hex format), returning the altered colour in hex format.7
     * @param str $hexcolor Colour as hexadecimal (with or without hash);
     *
     * @percent float $percent Decimal ( 0.2 = lighten by 20%(), -0.4 = darken by 40%() )
     * @return str Lightened/Darkend colour as hexadecimal (with hash);
     */
    public static function luminance($hexcolor, $percent)
    {
        if (strlen($hexcolor) < 6) {
            $hexcolor = $hexcolor[0] . $hexcolor[0] . $hexcolor[1] . $hexcolor[1] . $hexcolor[2] . $hexcolor[2];
        }
        $hexcolor = array_map("hexdec", str_split(str_pad(str_replace("#", "", $hexcolor), 6, "0"), 2));

        foreach ($hexcolor as $i => $color) {
            $from = $percent < 0 ? 0 : $color;
            $to = $percent < 0 ? $color : 255;
            $pvalue = ceil(($to - $from) * $percent);
            $hexcolor[$i] = str_pad(dechex($color + $pvalue), 2, "0", STR_PAD_LEFT);
        }

        return "#" . implode($hexcolor);
    }

    /**
     * Add timestamp to data before insering into database
     */
    public static function addTimestamp($data)
    {
        return array_merge($data, ["created_at" => \DB::raw("CURRENT_TIMESTAMP"), "updated_at" => \DB::raw("CURRENT_TIMESTAMP")]);
    }
}
