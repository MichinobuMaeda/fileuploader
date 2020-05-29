<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use DateTime;
use DateTimeZone;
use App\User;

class BinaryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($request->hasFile('file')) {
            $ts = new DateTime();
            $ts->setTimezone(new DateTimeZone('Asia/Tokyo'));
            $file = $request->file('file');
            $file->storeAs(
                'uploaded/' . $user->id,
                $ts->format('YmdHis') . '.' . $file->extension(),
                'local'
            );
            $user->save();
        }
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\User  $user
     * @param string $file
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, $file)
    {
        $path = $user->id . '/' . $file;
        // https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Common_types
        $mimeTypes = [
            'aac' => 'audio/aac',
            'abw' => 'application/x-abiword',
            'arc' => 'application/x-freearc',
            'avi' => 'video/x-msvideo',
            'azw' => 'application/vnd.amazon.ebook',
            'bin' => 'application/octet-stream',
            'bmp' => 'image/bmp',
            'bz' => 'application/x-bzip',
            'bz2' => 'application/x-bzip2',
            'csh' => 'application/x-csh',
            'css' => 'text/css',
            'csv' => 'text/csv',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'eot' => 'application/vnd.ms-fontobject',
            'epub' => 'application/epub+zip',
            'gz' => 'application/gzip',
            'gif' => 'image/gif',
            'htm' => 'text/html',
            'html' => 'text/html',
            'ico' => 'image/vnd.microsoft.icon',
            'ics' => 'text/calendar',
            'jar' => 'application/java-archive',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'js' => 'text/javascript',
            'json' => 'application/json',
            'jsonld' => 'application/ld+json',
            'mid' => 'audio/midi',
            'midi' => 'audio/midi',
            'mjs' => 'text/javascript',
            'mp3' => 'audio/mpeg',
            'mpeg' => 'video/mpeg',
            'mpkg' => 'application/vnd.apple.installer+xml',
            'odp' => 'application/vnd.oasis.opendocument.presentation',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
            'odt' => 'application/vnd.oasis.opendocument.text',
            'oga' => 'audio/ogg',
            'ogv' => 'video/ogg',
            'ogx' => 'application/ogg',
            'opus' => 'audio/opus',
            'otf' => 'font/otf',
            'png' => 'image/png',
            'pdf' => 'application/pdf',
            'php' => 'application/x-httpd-php',
            'ppt' => 'application/vnd.ms-powerpoint',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'rar' => 'application/vnd.rar',
            'rtf' => 'application/rtf',
            'sh' => 'application/x-sh',
            'svg' => 'image/svg+xml',
            'swf' => 'application/x-shockwave-flash',
            'tar' => 'application/x-tar',
            'tif' => 'image/tiff',
            'tiff' => 'image/tiff',
            'ts' => 'video/mp2t',
            'ttf' => 'font/ttf',
            'txt' => 'text/plain',
            'vsd' => 'application/vnd.visio',
            'wav' => 'audio/wav',
            'weba' => 'audio/webm',
            'webm' => 'video/webm',
            'webp' => 'image/webp',
            'woff' => 'font/woff',
            'woff2' => 'font/woff2',
            'xhtml' => 'application/xhtml+xml',
            'xls' => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'xml' => 'application/xml', // text/xml if readable from casual users
            'xul' => 'application/vnd.mozilla.xul+xml',
            'zip' => 'application/zip',
            '3gp' => 'video/3gpp',  // audio/3gpp if it doesn't contain video
            '3g2' => 'video/3gpp2', // audio/3gpp2 if it doesn't contain video
            '7z' => 'application/x-7z-compressed',

            'mp4' => 'video/mp4',
            'mov' => 'video/quicktime',
            'wmv' => 'video/x-ms-wmv',
        ];
        $mimeType = 'application/bin';
        foreach ($mimeTypes as $key => $val) {
            if (preg_match('/\.' . $key . '$/i', $path)) {
                $mimeType = $val;
            }
        }
        $contents = Storage::disk('local')->get('uploaded/' . $path);
        Log::debug(strlen($contents));
        return response($contents)
            ->header('Content-Description', 'File Transfer')
            ->header('Content-Type', $mimeType)
            ->header('Content-length', strlen($contents))
            ->header('Content-Disposition', 'attachment; filename=' . $file)
            ->header('Content-Transfer-Encoding', 'binary');
    }
}
