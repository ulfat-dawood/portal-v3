<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // dd($request->segments());
        if ($request->method() === 'GET') {

            // get whatever the first segment of the url is set to
            $segment = $request->segment(1);

            // if no ar/en appended manually to url segment (by default there's no ar/en)
            if (!in_array($segment, config('app.locales'))) {

                // if session has no locale
                if (!$request->session()->has('locale') || session('locale') != app()->getLocale()) {
                    session()->put('locale', app()->getLocale());
                }

                // if session has locale-> 1- set the app_locale() accordingly  2-append lang to url  3-redirect to new url
                app()->setLocale(session('locale'));
                $urlWithLang = $this->appendLangToUrl($request, session('locale'));
                return redirect()->to($urlWithLang);

            } else { // if the first segment of url is ar/en (assume entered manually)

                if(app()->getLocale() != $segment){
                    session()->put('locale', $segment);
                    app()->setLocale(session('locale'));
                }else{//app locale == url segment
                    if (!$request->session()->has('locale') || session('locale')!=$segment) { //session has no locale or session(locale) != segment
                        session()->put('locale', $segment);
                        app()->setLocale(session('locale'));
                    }
                }

            }
        }


        return $next($request);
    }

    public function appendLangToUrl($request, $lang)
    {

        // get the query string :
        $queryString = empty($request->query()) ? '' : '?';
        $i = 0;
        foreach ($request->query() as $key => $value) {
            $i++;
            // $queryString .= $key.'='.$value.'&';
            $queryString .= $i == sizeof($request->query()) ? $key . '=' . $value : $key . '=' . $value . '&';
        }

        // append lang to url segments
        $segments = $request->segments(); //get the url segments array
        $segments = Arr::prepend($segments, $lang); //add ar/en to segments array

        return implode('/', $segments) . $queryString;
    }
}
