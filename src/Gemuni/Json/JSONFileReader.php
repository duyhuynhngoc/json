<?php

/**
 * Modified by: Duy Huynh
 * Modified date: 08/22/2015
 * Package: Gemini\Json
 */
namespace Gemuni\Json;

class JSONFileReader {
    /*
     * load json file and parse to assoc array
     */
    public static function loadFile($filename) {
            $stringJSON = @file_get_contents($filename);
            if ($stringJSON === FALSE) {
                 throw new \Exception("Cannot access '$filename' to read contents.");
            } else {
                $arrayJSON = json_decode($stringJSON, true);

                switch(json_last_error()) {
                    case JSON_ERROR_NONE :
                        break;
                    case JSON_ERROR_DEPTH :
                        throw new \Exception("Maximum stack depth exceeded. At file '$filename'");
                        break;
                    case JSON_ERROR_CTRL_CHAR :
                        throw new \Exception("Unexpected control character found . At file '$filename'");
                        break;
                    case JSON_ERROR_SYNTAX :
                        throw new \Exception("Syntax error, malformed JSON. At file '$filename'");
                        break;
                    case JSON_ERROR_UTF8:
                        throw new \Exception("Malformed UTF-8 characters, possibly incorrectly encoded. At file '$filename'");
                        break;
                    default:
                        throw new \Exception("Unknown error. At file '$filename'");
                       break;     
                }
                return $arrayJSON;
            }
    }

}
