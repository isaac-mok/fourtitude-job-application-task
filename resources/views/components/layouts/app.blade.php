<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <title>{{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body>
    <div class="container mx-auto px-2 py-2">
      {{ $slot }}
    </div>
  </body>
</html>
