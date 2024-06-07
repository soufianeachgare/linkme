<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LinkMe - {{$user->first_name}} {{$user->last_name}}</title>


    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>

</head>

<body class="antialiased h-screen overflow-hidden">
     <nav class=" shadow-sm bg-white dark:bg-gray-800 dark:text-white">
    <div class="container mx-auto flex items-center p-4 ">
        <a class="text-lg font-bold text-gray-800 dark:text-white" href="{{ url('/') }}">
            {{ config('app.name', 'LinkMe') }}
        </a>
        <button class="navbar-toggler md:hidden focus:outline-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

           

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto flex gap-4 items-center">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown flex gap-4">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{route('home')}}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        
    </div>
</nav>

        <div class="flex justify-center h-full overflow-hidden bg-white dark:bg-gray-800 dark:text-white">
           


                <div class="flex flex-col gap-4 p-4 w-full md:w-1/2  items-center md:rounded-md overflow-y-auto  bg-white dark:bg-gray-800">
                    <div id="avatar-preview">
                        @if ($user->type_photo === 'upload')
                            <img src="{{ asset('storage/profile/' . $user->photo) }}" alt="User Photo"
                                class="rounded-full w-20 h-20 md:w-32 md:h-32">
                        @else
                            <img src="{{ $user->photo }}" alt="User Photo" class="rounded-full w-20 h-20">
                        @endif
                    </div>

                    <h5 id="fullName"
                        class="text-2xl font-bold tracking-tight text-center text-gray-900 dark:text-white">
                        {{ $user->first_name }} {{ $user->last_name }}
                    </h5>
                    <div class="flex flex-row justify-center gap-4">
                        @if ($user->phone)
                      
                        <a target="_blank" id="callme" href="tel:{{ $user->phone }}"
                                class="flex gap-4 py-2 md:px-12 px-6 bg-white border border-gray-200 rounded-full shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m18.4 14.8-1.2-1.3a1.7 1.7 0 0 0-2.4 0l-.7.7a1.7 1.7 0 0 1-2.4 0l-1.9-1.9a1.7 1.7 0 0 1 0-2.4l.7-.6a1.7 1.7 0 0 0 0-2.5L9.2 5.6a1.6 1.6 0 0 0-2.4 0c-3.2 3.2-1.7 6.9 1.5 10 3.2 3.3 7 4.8 10.1 1.6a1.6 1.6 0 0 0 0-2.4Z"/>
                             </svg>
                            <span >Call me</span>
                            </a>
                        @endif
                    </div>
                    <h5
                        class="text-xl font-semibold tracking-tight text-center w-full text-gray-900 dark:text-white">
                        About me</h5>
                    <p id="bioText" class="mb-3 text-gray-700 dark:text-gray-400 w-full ">{{ $user->bio }}</p>
                    @if(count($social)>0)
                    <h5
                        class="text-xl font-semibold tracking-tight text-center  w-full text-gray-900 dark:text-white">
                        Social media</h5>
                    @endif
                    <div id="SocialMediaContainer" class="w-full flex flex-wrap justify-center items-center gap-4">
                        @foreach ($social as $item)
                            <a target="_blank" class="h-16 w-16 p-4 rounded-lg shadow bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700" id="{{ $item->name }}-link"
                                href=@switch( $item->name)
                                   @case('Gmail')
                                        "mailto:{{ $item->url }}"
                                       @break
                                   @case('Whatsapp')
                                        "https://wa.me/{{ $item->url }}"
                                       @break
                                   @default
                                       @if (Str::startsWith($item->url, 'https://'))
                                       "{{ $item->url }}"
                                       @else
                                       "https://{{ $item->url }}"
                                       @endif
                               @endswitch>
                                @foreach ($types as $type)
                                    @if ($type->name === $item->name)
                                        <svg class="h-full w-full" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="{{ $type->d }}">
                                            </path>
                                        </svg>
                                    @endif
                                @endforeach
                            </a>
                        @endforeach

                    </div>
                    
                    <div id="LinksContainer" class="w-full flex flex-col gap-2 md:grid md:grid-cols-3">
                        
                        @foreach ($actions as $item)
                            @if($item->type ==='url')
                                <a target="_blank" id="Link1" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700" href=
                                @if (Str::startsWith($item->url, 'https://'))
                                   "{{ $item->url }}"
                                @else
                                   "https://{{ $item->url }}"
                                @endif 
                                >
                                 {{$item->name}}
                                </a>
                            @else
                                <a href="{{ asset('storage/document/' . $item->url) }}" download="{{$item->name}}">{{$item->name}}</a>
                            @endif
                        @endforeach                   
                    </div>

                </div>
            
            

        </div>
<script>
  function addContact() {
    const contactData = {
      name: 'John Doe',
      email: 'john.doe@example.com',
      phone: '1234567890',
      // Add more fields as needed
    };

    const contactBlob = new Blob([JSON.stringify(contactData)], { type: 'application/json' });
    const contactUrl = URL.createObjectURL(contactBlob);

    const a = document.createElement('a');
    a.href = `data:application/octet-stream,${encodeURIComponent(JSON.stringify(contactData))}`;
    a.download = 'contact.vcf'; // .vcf is the standard file extension for vCard files
    a.click();
  }
</script>
</body>
</html>
