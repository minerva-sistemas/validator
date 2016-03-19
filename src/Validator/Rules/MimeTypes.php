<?php

namespace Validator\Rules;
use Validator\Exception\ValidationException;

/**
 * Class MimeType
 * @author  Nathan C.N <nathan@minervasistemas.com.br>
 * @package Validator\Rules
 */
class MimeTypes implements RuleInterface
{

    /**
     * array com os MimeTypes permitidos
     * @var arrayMimeTypes
     */
    private $arrayMimeTypes;

    /**
     * Valor a ser verificado
     * @var data
     */
    private $data;

    /**
     * Valor mimeType do arquivo recebido
     * @var typeMymeType
     */
    private $typeMimeType;

    /**
     * @return typeMymeType
     */
    public function getTypeMimeType()
    {
        return $this->typeMimeType;
    }

    /**
     * @param typeMymeType $typeMimeType
     */
    public function setTypeMimeType($typeMimeType)
    {
        $this->typeMimeType = $typeMimeType;
    }

    public function getArrayMimeTypes()
    {
        return $this->arrayMimeTypes;
    }

    /**
     * @param arrayMimeTypes $arrayMimeTypes
     */
    public function setArrayMimeTypes($arrayMimeTypes)
    {
        $this->arrayMimeTypes = $arrayMimeTypes;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }
    private function mime_content_type($filename) {

        $mime_types = array(

            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',

            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );

        $var = explode('.',$filename);
        $ext = strtolower(array_pop($var));

        if (array_key_exists($ext, $mime_types)) {
            return $mime_types[$ext];
        }
        elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        }
        else {
            return 'application/octet-stream';
        }
    }

    /**
     * Preparar array de MimeTypes
     * MimeType constructor.
     * @param $arrayMimeTypes
     */
    public function __construct($arrayMimeTypes)
    {
        $this->setArrayMimeTypes($arrayMimeTypes);
    }


    /**
     * Executa a validação
     * @throws ValidationException
     */
    public function execute()
    {
        $this->setTypeMimeType($this->mime_content_type($this->getData()['name']));

        if(!in_array($this->getTypeMimeType(), $this->getArrayMimeTypes()))
        {
            throw new ValidationException("O tipo de arquivo".$this->getTypeMimeType()." não é permitido.");
        }
    }
}

