<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ mix('/css/main.css') }}">
    </head>
    <body>
        <div class="h-screen">
            <div class="flex flex-col-reverse md:flex-row bg-indigo-lightest md:min-h-full -mx-2">
                <div class="flex-grow w-full md:w-1/5 border-r border-indigo-lighter">
                    <h1 class="text-2xl font-medium block px-8 mt-4 mb-4">
                        <a href="/" class="text-indigo-darker no-underline hover:no-underline">Founder</a>
                    </h1>
                    <hr class="block h-px w-full bg-indigo-lighter mt-2 mb-4">
                    @include('_layouts.navigation')
                    <hr class="block md:hidden h-px w-full bg-indigo-lighter mt-2 mb-4">
                    <div class="mb-4 md:fixed md:pin-b md:pin-l md:ml-4 md:mb-2">
                        <a href="https://github.com/michaeldyrynda/founder-style" target="_blank" class="text-base font-light px-8 md:px-2">
                            GitHub
                        </a>
                    </div>
                </div>
                <div class="bg-white w-full md:w-4/5 p-4">
                    <div class="container w-full px-4 md:w-4/5 md:px-none mx-auto">
                        <h1 class="text-2xl font-medium block mb-4 text-indigo">
                            {{ $page->title }}
                        </h1>
                        <hr class="block h-px w-full bg-indigo-lighter text-left mt-2 mb-4">
                        <div class="markdown">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="{{ mix('/js/app.js') }}"></script>
</html>
