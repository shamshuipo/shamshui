<?php

namespace App\Services;

use DiDom\Document;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Spatie\Browsershot\Browsershot;
use Symfony\Component\Process\Exception\ProcessFailedException;

class HkjcService
{
    /**
     * $html = getHtml('2020-10-28', 'results.all');
     *
     * @return string
     */
    public static function getHtml($ymd, $type)
    {
        $date = Carbon::createFromFormat('Y-m-d', $ymd);
        $template = config('shamshui.urls.'.$type.'.template');
        $language = config('shamshui.urls.'.$type.'.language');
        $dmy = $date->format(config('shamshui.urls.'.$type.'.format'));
        $url = Str::replaceArray('{?}', [$language, $dmy], $template);

        $html = Browsershot::url($url)
            ->setNodeBinary(config('shamshui.urls.node'))
            ->setNpmBinary(config('shamshui.urls.npm'))
            ->delay(config('shamshui.urls.delay'))
            ->waitUntilNetworkIdle(config('shamshui.urls.strict'))
            ->bodyHtml();

        return $html;
    }

    public static function getHtmlResults($html)
    {
        $result = optional($html->find('.race_result'))[0]->html();
    }
}
