<?php

namespace App\Modules\Demo;

use ReflectionClass;
use ReflectionMethod;

class Documenter
{
    public static function showString($code, $addOpenTag = true)
    {
        if ($addOpenTag) {
            $code = '<?php '.$code;
        }
        $code = highlight_string($code, true);
        if ($addOpenTag) {
            $code = str_replace('&lt;?php&nbsp;', '', $code);
        }

        return "<pre>". $code . "</pre>";
    }

    public static function showCode($filepath, $addOpenTag = false, $wrapRegex = null)
    {
        $file = __DIR__.'/'.$filepath;

        $code = file_get_contents($file);
        $code = preg_replace("#@section\('doc'\)(.*)@endsection#Us", '', $code);
        $code = preg_replace("#{!! App\\\\Documenter::show(.*) !!}#Us", '', $code);

        if($wrapRegex) {
            $addOpenTag = true;
            //dd('/'.$wrapRegex.'/ms');
            preg_match('/'.$wrapRegex.'/msU', $code, $matches);
            $code = $matches[0];

        }

        if ($addOpenTag) {
            $code = '<?php '.$code;
        }

        $code = highlight_string($code, true);
        if ($addOpenTag) {
            $code = str_replace('&lt;?php&nbsp;', '', $code);
        }


        return "<pre>\n"."<small>$filepath</small>\n\n". $code . "\n</pre>";
    }

    public static function showMethod($class, $methods)
    {
        $rclass = new ReflectionClass($class);
        $definition = implode("", array_slice(file($rclass->getFileName()), $rclass->getStartLine() - 1, 1));

        $code = "\n".$definition."\n....\n\n";

        if (! is_array($methods)) {
            $methods = [$methods];
        }

        foreach ($methods as $method) {
            $method = new ReflectionMethod($class, $method);
            $filename = $method->getFileName();
            $start_line = $method->getStartLine() - 1;
            $end_line = $method->getEndLine();
            $length = $end_line - $start_line;
            $source = file($filename);
            $content = implode("", array_slice($source, $start_line, $length));

            $code .= $content."\n\n";
        }

        $filename = str_replace(__DIR__, 'app', $filename);
        $code = highlight_string("<?php ".$code, true);
        $code = str_replace('&lt;?php&nbsp;', '', $code);


        return "<pre>\n" . "<small>$filename</small>\n\n".$code . "\n</pre>";
    }

    protected static function getPackagePath($class)
    {
        $path = with(new ReflectionClass($class))->getFileName();

        return realpath(dirname($path).'/');
    }
}
