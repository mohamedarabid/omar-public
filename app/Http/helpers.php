<?php

use App\Models\Enterprise;
use App\Models\GeneralInfo;
use App\Models\Offer;
use App\Models\Transaction;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Container\Container;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;


function openJSONFile($code)
{
    $jsonString = [];
    if (File::exists(base_path('resources/lang/' . $code . '.json'))) {
        $jsonString = file_get_contents(base_path('resources/lang/' . $code . '.json'));
        $jsonString = json_decode($jsonString, true);
    }
    return $jsonString;
}
if (!function_exists('uploaded_asset')) {
    function uploaded_asset($id)
    {
        if (($asset = \App\Models\Upload::find($id)) != null) {
            return $asset->external_link == null ? my_asset($asset->file_name) : $asset->external_link;
        }
        return null;
    }
}
if (!function_exists('my_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param string $path
     * @param bool|null $secure
     * @return string
     */
    function my_asset($path, $secure = null)
    {
        if (env('FILESYSTEM_DRIVER') == 's3') {
            return Storage::disk('s3')->url($path);
        } else {
            return app('url')->asset($path, $secure);
        }
    }
}
if (!function_exists('static_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param string $path
     * @param bool|null $secure
     * @return string
     */
    function static_asset($path, $secure = null)
    {
        return app('url')->asset('public/' . $path, $secure);
    }
}
function datatable_paginate($builder)
{
    $draw = request()->get('draw');
    $start = request()->get("start", 0);
    $length = request()->get("length", 1); // Rows display per page

    $page = ($start / $length) + 1;

    $columns = request()->get('columns');
    $sortDir = request()->input('order.0.dir');
    $sortColumnIndex = request()->input('order.0.column');

    $sortColumnName = request()->input("columns.{$sortColumnIndex}.data");
    if (!empty($sortColumnName)) {
        $builder = $builder->OrderBy($sortColumnName, $sortDir);
    } else {
        $builder = $builder->latest();
    }
    $data = $builder->paginate($length, ['*'], 'page', $page);

    return array(
        "draw" => intval($draw),
        "recordsTotal" => $data->total(),
        "recordsFiltered" => $data->total(),
        "aaData" => $data->items()
    );
}
function saveJSONFile($code, $data)
{
    ksort($data);
    $jsonData = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents(base_path('resources/lang/' . $code . '.json'), stripslashes($jsonData));
}


if (!function_exists('getBaseURL')) {
    function getBaseURL()
    {
        $root = '//' . $_SERVER['HTTP_HOST'];
        $root .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

        return $root;
    }
}


if (!function_exists('getFileBaseURL')) {
    function getFileBaseURL()
    {
        if (env('FILESYSTEM_DRIVER') == 's3') {
            return env('AWS_URL') . '/';
        } else {
            return getBaseURL();
        }
    }
}
function get_general($key)
{
    $general = GeneralInfo::where('key', $key)->first();
    if ($general) {
        return $general->value;
    }

    return '';
}
