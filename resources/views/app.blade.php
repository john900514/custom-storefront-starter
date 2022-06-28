<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="lave">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php $asset_name = ((date('H') >= 23) || (date('H') < 16 )) ? '/img/gr-dark-logo.png' : '/img/gr-light-logo.png' @endphp
    <link rel="icon" type="image/png" href="{{ asset($asset_name) }}">

    <title inertia>{{ env('APP_NAME', 'Portal Dev By Cape & Bay') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('sass/app.css') }}">

    <!-- Scripts -->
    @routes
    <script>
        !function(){var analytics=window.analytics=window.analytics||[];if(!analytics.initialize)if(analytics.invoked)window.console&&console.error&&console.error("Segment snippet included twice.");else{analytics.invoked=!0;analytics.methods=["trackSubmit","trackClick","trackLink","trackForm","pageview","identify","reset","group","track","ready","alias","debug","page","once","off","on","addSourceMiddleware","addIntegrationMiddleware","setAnonymousId","addDestinationMiddleware"];analytics.factory=function(e){return function(){var t=Array.prototype.slice.call(arguments);t.unshift(e);analytics.push(t);return analytics}};for(var e=0;e<analytics.methods.length;e++){var key=analytics.methods[e];analytics[key]=analytics.factory(key)}analytics.load=function(key,e){var t=document.createElement("script");t.type="text/javascript";t.async=!0;t.src="https://cdn.segment.com/analytics.js/v1/" + key + "/analytics.min.js";var n=document.getElementsByTagName("script")[0];n.parentNode.insertBefore(t,n);analytics._loadOptions=e};analytics._writeKey="9yxvB6MsxPSXH1gwAm3WOECBP5WHDrAz";;analytics.SNIPPET_VERSION="4.15.3";
            analytics.load('{!! env('SEGMENT') !!}');
            analytics.page();
        }}();
    </script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
</head>

<body>
<div>
    @inertia
</div>


<div id="modalsGoHere"></div>
</body>
</html>
