<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LinkMe - All your links</title>


    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
      <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>


</head>

<body class="antialiased">
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

    <div class="md:grid md:grid-cols-5 gap-4 w-full overflow-hidden bg-white dark:bg-gray-800 dark:text-white">
        <form action="{{ route('update') }}" method="POST" id="save-form"
            class="flex flex-col gap-4 p-4 py-4 justify-center col-span-3 overflow-y-auto">
            @csrf
            <div class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                id="step1">

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="first_name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First name</label>
                        <input type="text" id="first_name" name="first_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="John" required value="{{ $user->first_name }}">
                    </div>
                    <div>
                        <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last
                            name</label>
                        <input type="text" id="last_name" name="last_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Doe" required value="{{ $user->last_name }}">
                    </div>
                    <div>
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone
                        </label>
                        <input type="tel" id="phone" name="phone"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="phone number" required value="{{ $user->phone }}">
                    </div>
                    <div class="flex flex-row gap-2 justify-center items-center">

                        <input type="checkbox" class="w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" id="phone_using" onchange="phone_same_Whatsapp()" name="use_Whatsapp"
                            {{ $user->use_Whatsapp ? 'checked' : '' }}
                           >
                            <label for="phone_using" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Use
                            the same for Whatsapp
                        </label>
                    </div>
                    <div>
                        <label for="gmail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                        </label>
                        <input type="text" id="email" name="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="email " required value="{{ $user->email }}">
                    </div>

                    <div class="flex flex-row gap-2 justify-center items-center">

                        <input type="checkbox" class="w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" id="gmail_using" onchange="email_same_Gmail()" name="use_Gmail"
                            {{ $user->use_Gmail ? 'checked' : '' }}
                            ><label
                            for="gmail_useing" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Use
                            the same for Gmail
                        </label>
                    </div>
                </div>
                <div>

                    <label for="bio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Bio</label>
                    <textarea id="bio" rows="4" name="bio"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Write your thoughts here...">{{ $user->bio }}</textarea>

                </div>
            </div>
            <div
                class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <label for="socialMedia">Select Social Media:</label>
                <select name="socialMedia" id="socialMedia" onchange="addInputField()"
                    class="bg-gray-50 mb-6 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Select...</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->name }}">{{ $type->name }}</option>
                    @endforeach
                </select>

                <div id="inputFieldsContainer" class="grid grid-cols-2 gap-4"></div>


            </div>
            <div
                class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <label for="link">Link <button type="button" id="addLinkButton">+</button></label>

                <div id="inputFieldsLinksContainer">

                </div>


            </div>
            <input type="submit" value="Save">
        </form>
        <div class="px-2 col-span-2 overflow-hidden bg-white dark:bg-gray-800 dark:text-white">
            <div class="relative mx-auto border-gray-800 mt-4 dark:border-gray-400 bg-gray-800 border-[14px]  rounded-[2.5rem]  min-h-[600px] w-[300px]">
                <div class="h-[32px] w-[3px] bg-gray-800 dark:bg-gray-800  absolute -start-[17px] top-[72px] rounded-s-lg">
                </div>
                <div class="h-[46px] w-[3px] bg-gray-800 dark:bg-gray-800  absolute -start-[17px] top-[124px] rounded-s-lg">
                </div>
                <div class="h-[46px] w-[3px] bg-gray-800 dark:bg-gray-800  absolute -start-[17px] top-[178px] rounded-s-lg">
                </div>
                <div class="h-[64px] w-[3px] bg-gray-800 dark:bg-gray-800  absolute -end-[17px] top-[142px] rounded-e-lg">
                </div>
                <div class="flex flex-col p-4 justify-center items-center  rounded-[2rem] overflow-hidden w-full w-[272px]  bg-white dark:bg-gray-800">
                    <div id="avatar-preview"></div>

                    <h5 id="fullName" class="mb-2 text-2xl font-bold tracking-tight text-center text-gray-900 dark:text-white"></h5>
                    <div id="callContainer" class="flex flex-row justify-center gap-4">
                        @if ($user->phone)
                           
                            <a target="_blank" id="callme" href="tel:{{ $user->phone }}" class="flex gap-4 py-2 my-2 px-6 bg-white border border-gray-200 rounded-full shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m18.4 14.8-1.2-1.3a1.7 1.7 0 0 0-2.4 0l-.7.7a1.7 1.7 0 0 1-2.4 0l-1.9-1.9a1.7 1.7 0 0 1 0-2.4l.7-.6a1.7 1.7 0 0 0 0-2.5L9.2 5.6a1.6 1.6 0 0 0-2.4 0c-3.2 3.2-1.7 6.9 1.5 10 3.2 3.3 7 4.8 10.1 1.6a1.6 1.6 0 0 0 0-2.4Z"/>
                                 </svg>
                                <span >Call me</span>
                            </a>
                        @endif
                    </div>
                        
                    
                    <h5 class="mb-2 text-xl font-semibold tracking-tight text-left w-full text-gray-900 dark:text-white"> About me</h5>
                    <p id="bioText" class="mb-3 text-gray-700 text-center dark:text-gray-400 w-full "></p>
                    <h5 class="mb-2 text-xl font-semibold tracking-tight text-left w-full text-gray-900 dark:text-white"> Social media</h5>
                    <div id="SocialMediaContainer" class="grid grid-cols-4 gap-4">
                    </div>
                    <div id="LinksContainer" class="w-full flex flex-col gap-2">
                    </div>

                </div>
            </div>
            <div class="px-8 mt-4">
                <label for="website-admin" class="block  mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Link </label>
                <div class="flex">
                <input disabled class="rounded-s-md w-full bg-white dark:bg-gray-800 dark:text-white" id="website-admin" type="text" value="{{route('/')}}/0/{{$user->id}}" data-share="{{route('/')}}/0/{{$user->id}}">
                <button class="rounded-e-lg bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 " id="share-button">Share</button>
            
              </div>
            </div>
        </div>    
    </div>

</body>
<script>
// Get the button element
var shareButton = document.getElementById("share-button");

// Add a click event listener to the button
shareButton.addEventListener("click", function() {
  // Check if the Web Share API is supported
  if (navigator.share) {
    // Get the input value from the data-share attribute
    var shareValue = shareButton.getAttribute("data-share");

    // Create an object with the content to share
    var shareData = {
      title: "LinkMe-{!! $user->first_name !!} {!! $user->last_name !!}",
      text: "landing page with multiple links to share your content",
      url: shareValue
    };

    // Call the share method with the share data
    navigator.share(shareData)
      .then(() => {
        
      })
      .catch((error) => {
        // Show an error message to the user
        alert("Error: " + error);
      });
  } else {
    // Show a message to the user that the Web Share API is not supported
    alert("Sorry, your browser does not support the Web Share API.");
  }
});

</script>

</script>
<script>
    
    const inputFieldsContainer = document.getElementById('inputFieldsContainer');
    const phoneInputValue = document.getElementById('phone');
    const emailInputValue = document.getElementById('email');
    const inputFieldsLinksContainer = document.getElementById('inputFieldsLinksContainer');
    const LinksContainer = document.getElementById('LinksContainer');
    const socialMediaContainer = document.getElementById('SocialMediaContainer');
    // Check if phone input is not null and create/update WhatsApp input
    const phoneCheckbox = document.getElementById('phone_using');
    const emailCheckbox = document.getElementById('gmail_using');
    var socialMediaArray = {!! $types !!};
    var ActionsArrayUser = {!! $actions !!};
    var socialMediaArrayUser = {!! $social !!};
    var socialMediaSelect = document.getElementById('socialMedia');
    var callContainer = document.getElementById('callContainer');

    for (var t = 0; t < socialMediaArrayUser.length; t++) {
        const dist = socialMediaArrayUser[t].name;
        for (var i = 0; i < socialMediaSelect.options.length; i++) {
            if (socialMediaSelect.options[i].value === dist) {
                socialMediaSelect.options[i].selected = true;
                addInputField(socialMediaArrayUser[t].url);
                inputsocialcheck(document.getElementById(dist + '-input'));
            }
        }
    }
    



    function addCallme() {
        if (phoneInputValue && phoneInputValue.value.length >= 10) {
            if (!document.getElementById('callme')) {
                
                const link = document.createElement('a');
                link.setAttribute('target', "_blank");
                link.innerHTML = `
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m18.4 14.8-1.2-1.3a1.7 1.7 0 0 0-2.4 0l-.7.7a1.7 1.7 0 0 1-2.4 0l-1.9-1.9a1.7 1.7 0 0 1 0-2.4l.7-.6a1.7 1.7 0 0 0 0-2.5L9.2 5.6a1.6 1.6 0 0 0-2.4 0c-3.2 3.2-1.7 6.9 1.5 10 3.2 3.3 7 4.8 10.1 1.6a1.6 1.6 0 0 0 0-2.4Z"/>
                     </svg>
                    <span class="hidden ">Call me</span>
                `;
                link.id = "callme";
                if (!phoneInputValue.value.includes('+212') || phoneInputValue.value.length <= 10) {
                    phoneInputValue.value = '+212' + phoneInputValue.value;
                }
                link.setAttribute('href', 'tel:' + phoneInputValue.value);
                link.className = 'flex   p-2 bg-white border border-gray-200 rounded-full shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700';
                const link2 = document.createElement('a');
                link2.setAttribute('target', "_blank");
                link2.innerHTML = `
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12h4m-2 2v-4M4 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1c0 .6-.4 1-1 1H5a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                              </svg>
                    <span class="hidden ">Add Contact</span>
                `;
                link2.id = "add";
                if (!phoneInputValue.value.includes('+212') || phoneInputValue.value.length <= 10) {
                    phoneInputValue.value = '+212' + phoneInputValue.value;
                }
                link2.setAttribute('href', 'tel:' + phoneInputValue.value);
                link2.className = 'flex   p-2 bg-white border border-gray-200 rounded-full shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700';
                callContainer.appendChild(link);
                callContainer.appendChild(link2);
            } else {
                document.getElementById('callme').value = phoneInputValue.value;
            }
        }
    }
    phoneInputValue.addEventListener('change', addCallme);

    function phone_same_Whatsapp() {
        if (phoneInputValue && phoneCheckbox.checked) {
            // Create/update WhatsApp input
            if (!document.getElementById('Whatsapp-input')) {
                // Assume the value you want to select is stored in a variable, for example, 'desiredValue'
                var desiredValue = 'Whatsapp';

                for (var i = 0; i < socialMediaSelect.options.length; i++) {
                    if (socialMediaSelect.options[i].value === desiredValue) {
                        socialMediaSelect.options[i].selected = true;
                        addInputField();

                        break;
                    }
                }

            }
            document.getElementById('Whatsapp-input').value = phoneInputValue.value;
            inputsocialcheck(document.getElementById('Whatsapp-input'));

        }
    }

    function email_same_Gmail() {
        if (emailInputValue && emailCheckbox.checked) {
            // Create/update WhatsApp input
            if (!document.getElementById('Gmail-input')) {
                // Assume the value you want to select is stored in a variable, for example, 'desiredValue'
                var desiredValue = 'Gmail';

                for (var i = 0; i < socialMediaSelect.options.length; i++) {
                    if (socialMediaSelect.options[i].value === desiredValue) {
                        socialMediaSelect.options[i].selected = true;
                        addInputField();

                        break;
                    }
                }

            }
            document.getElementById('Gmail-input').value = emailInputValue.value;
            inputsocialcheck(document.getElementById('Gmail-input'));


        }
    }

    function addInputField(value) {
        var socialMediaSelect = document.getElementById('socialMedia');
        var selectedOptionIndex = socialMediaSelect.selectedIndex;
        if (selectedOptionIndex > 0) {
            var selectedSocialMedia = socialMediaArray[selectedOptionIndex - 1];
            // Check if the selected social media is not already added
            if (!document.getElementById(selectedSocialMedia.name + '-input')) {
                var div = document.createElement('div');
                div.classList.add('relative');

                var label = document.createElement('label');
                label.htmlFor = selectedSocialMedia.name;
                label.classList.add('mb-2', 'text-sm', 'font-medium', 'text-gray-900', 'dark:text-white');
                label.textContent = selectedSocialMedia.name;

                let removeButton = document.createElement('button');
                removeButton.className = 'remove-button';
                removeButton.textContent = 'X';
                removeButton.classList.add('absolute', 'top-0', 'right-0');

                removeButton.addEventListener('click', function() {
                    inputFieldsContainer.removeChild(div);
                });

                var innerDiv = document.createElement('div');
                innerDiv.classList.add('flex');

                var span = document.createElement('span');
                span.classList.add('inline-flex', 'items-center', 'px-3', 'text-sm', 'text-gray-900',
                    'bg-gray-200',
                    'border', 'border-e-0', 'border-gray-300', 'rounded-s-md', 'dark:bg-gray-600',
                    'dark:text-gray-400', 'dark:border-gray-600');

                var svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
                svg.classList.add('h-4', 'w-4');
                svg.setAttribute('fill', 'currentColor');
                svg.setAttribute('viewBox', '0 0 24 24');

                var path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                path.setAttribute('d', selectedSocialMedia.d);

                var input = document.createElement('input');
                input.setAttribute('data-icon', selectedSocialMedia.d);
                input.addEventListener('change', function() {
                    inputsocialcheck(this); // Pass the input element to the function
                });

                input.type = 'text';
                input.name = selectedSocialMedia.name;
                input.value = value || "";
                input.id = selectedSocialMedia.name + '-input';
                input.classList.add('rounded-none', 'rounded-e-lg', 'bg-gray-50', 'border',
                    'border-gray-300',
                    'text-gray-900', 'focus:ring-blue-500', 'focus:border-blue-500', 'block', 'flex-1',
                    'min-w-0',
                    'w-full', 'text-sm', 'p-2.5', 'dark:bg-gray-700', 'dark:border-gray-600',
                    'dark:placeholder-gray-400', 'dark:text-white', 'dark:focus:ring-blue-500',
                    'dark:focus:border-blue-500');
                input.placeholder = 'Bonnie Green';

                span.appendChild(svg);
                svg.appendChild(path);

                innerDiv.appendChild(span);
                innerDiv.appendChild(input);

                div.appendChild(label);
                div.appendChild(innerDiv);
                div.appendChild(removeButton);

                inputFieldsContainer.appendChild(div);
                socialMediaSelect.options[0].selected = true;

            }
        }
    }


    inputFieldsContainer.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-button')) {
            let inputContainer = event.target.parentElement;
            socialMediaContainer.removeChild(document.getElementById(inputContainer.getElementsByTagName(
                'input')[0].name + '-link'));
        }
    });

    function updateContent() {
        const firstName = document.getElementById('first_name').value;
        const lastName = document.getElementById('last_name').value;
        const bio = document.getElementById('bio').value;

        // Update text content
        document.getElementById('fullName').textContent = `${firstName} ${lastName}`;
        document.getElementById('bioText').textContent = bio;
    }

    function createSocialMediaDiv(input) {
        if (!document.getElementById(input.name + '-link')) {
            const icon = input.getAttribute('data-icon');
            var value = input.value;

            var socialMediaDiv = document.createElement('a');
            socialMediaDiv.setAttribute('target', "_blank");
            socialMediaDiv.className = 'h-12 w-12 p-2 rounded-lg shadow';
            socialMediaDiv.id = input.name + '-link'
            if (input.name === 'Gmail') {
                socialMediaDiv.setAttribute('href', 'mailto:' + value);
            } else if (input.name === 'Whatsapp') {
                if (!value.includes('+212') || value.length <= 10) {
                    value = '+212' + value;
                }
                socialMediaDiv.setAttribute('href', 'https://wa.me/' + value);

            } else {
                if (!value.includes('https://')) {
                    value = 'https://' + value;
                }
                socialMediaDiv.setAttribute('href', value);

            }

            var svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
            svg.classList.add('h-full', 'w-full');
            svg.setAttribute('fill', 'currentColor');
            svg.setAttribute('viewBox', '0 0 24 24');

            var path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            path.setAttribute('d', icon);
            svg.appendChild(path);

            socialMediaDiv.appendChild(svg);
            document.getElementById('SocialMediaContainer').appendChild(socialMediaDiv);
        } else {
            var socialMediaDiv=document.getElementById(input.name + '-link');
            var value = input.value;
            if (input.name === 'Gmail') {
                socialMediaDiv.setAttribute('href', 'mailto:' + value);
            } else if (input.name === 'Whatsapp') {
                if (!value.includes('+212') || value.length <= 10) {
                    value = '+212' + value;
                }
                socialMediaDiv.setAttribute('href', 'https://wa.me/' + value);

            } else {
                if (!value.includes('https://')) {
                    value = 'https://' + value;
                }
                socialMediaDiv.setAttribute('href', value);

            }
        }
    }

    function deleteSocialMediaDiv(input) {
        socialMediaContainer.removeChild(document.getElementById(input.name + '-link'));
    }

    function inputsocialcheck(input) {
        const value = input.value.trim();
        const iconClass = input.getAttribute('data-icon');

        // Check if the input value is not null or empty
        if (value !== '') {
            createSocialMediaDiv(input);
        } else {
            deleteSocialMediaDiv(input);
        }
    };


    // Event listeners for input changes
    document.getElementById('first_name').addEventListener('input', updateContent);
    document.getElementById('last_name').addEventListener('input', updateContent);
    document.getElementById('bio').addEventListener('input', updateContent);
</script>
<script>
    function handleAvatarChange(inputElement) {
        const file = inputElement.files ? inputElement.files[0] : null;
        const url = inputElement.value.trim();

        if (file || url !== '') {
            // Perform actions with the selected file or URL
            if (file) {
                displayAvatarPreview(URL.createObjectURL(file));
            } else {
                displayAvatarPreview(url);
            }
        }
    }

    function displayAvatarPreview(source) {
        // Example: Display a preview image
        const previewContainer = document.getElementById('avatar-preview');
        previewContainer.innerHTML = ''; // Clear previous content

        const img = document.createElement('img');
        img.src = source;
        img.alt = 'Avatar Preview';
        img.classList.add('avatar-preview');
        img.classList.add('rounded-full', 'w-20', 'h-20');
        previewContainer.appendChild(img);
    }

    var containerFile = document.createElement('div');
    containerFile.classList.add('grid', 'grid-cols-2', 'gap-4')
    var avatarInput = document.createElement('input');
    avatarInput.name = 'photo';
    avatarInput.type = 'file';
    avatarInput.classList.add("bg-gray-50", "border", "border-gray-300", "text-gray-900", "text-sm", "rounded-lg",
        "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "dark:bg-gray-700",
        "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white", "dark:focus:ring-blue-500",
        "dark:focus:border-blue-500");
    avatarInput.accept = 'image/*'; // Allow only image files
    avatarInput.addEventListener('change', function() {
        handleAvatarChange(this);
    });

    var sourceTypeSelect = document.createElement('select');
    sourceTypeSelect.name = 'type_photo';
    sourceTypeSelect.classList.add("bg-gray-50", "border", "border-gray-300", "text-gray-900", "text-sm", "rounded-lg",
        "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "p-2.5", "dark:bg-gray-700",
        "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white", "dark:focus:ring-blue-500",
        "dark:focus:border-blue-500");
    var urlOption = document.createElement('option');
    urlOption.value = 'url';
    urlOption.text = 'URL';
    var uploadOption = document.createElement('option');
    uploadOption.value = 'upload';
    uploadOption.text = 'Upload';
    sourceTypeSelect.add(uploadOption);
    sourceTypeSelect.add(urlOption);
    sourceTypeSelect.addEventListener('change', function() {
        avatarInput.type = (this.value === 'url') ? 'text' : 'file';
    });

    // ... (other attributes)
    var label = document.createElement('label');
    label.htmlFor = 'Photo';
    label.classList.add('mb-2', 'text-sm', 'font-medium', 'text-gray-900', 'dark:text-white', 'block');
    label.textContent = 'Photo';
    document.getElementById('step1').appendChild(label);
    containerFile.appendChild(avatarInput);
    containerFile.appendChild(sourceTypeSelect);
    document.getElementById('step1').appendChild(containerFile);
    user = {!! $user !!};
    for (var i = 0; i < sourceTypeSelect.options.length; i++) {
        if (sourceTypeSelect.options[i].value === user.type_photo) {
            sourceTypeSelect.options[i].selected = true;
            avatarInput.type = (sourceTypeSelect.value === 'url') ? 'text' : 'file';
            if(user.type_photo=== 'url'){
                avatarInput.value = user.photo;
                handleAvatarChange(avatarInput);
            }else{
                const previewContainer = document.getElementById('avatar-preview');
                previewContainer.innerHTML = ''; // Clear previous content
        
                const img = document.createElement('img');
                img.src = "{{ asset('storage/profile/' . $user->photo) }}";
                img.alt = 'Avatar Preview';
                img.classList.add('avatar-preview');
                img.classList.add('rounded-full', 'w-20', 'h-20');
                previewContainer.appendChild(img);
            }
            break;
        }
    }
</script>
<script>
    const addLinkButton = document.getElementById('addLinkButton');
    let linkSectionCount = 0;

    addLinkButton.addEventListener('click', addLinkSection);

    function addLinkSection(action) {
        linkSectionCount++;

        var linkSection = document.createElement('div');
        linkSection.classList.add('link-section', 'shadow', 'rounded-lg', 'w-full', 'p-4');
        linkSection.setAttribute('name', `Link${linkSectionCount}`);
        var nameLabel = document.createElement('label');
        nameLabel.textContent = 'Name:';
        nameLabel.classList.add('mb-2', 'text-sm', 'font-medium', 'text-gray-900', 'dark:text-white');

        var nameInput = document.createElement('input');
        nameInput.type = 'text';
        nameInput.name = `name-Link${linkSectionCount}`;
        nameInput.value = action.name || ''
        nameInput.classList.add("bg-gray-50", "border", "border-gray-300", "text-gray-900", "text-sm", "rounded-lg",
            "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "dark:bg-gray-700",
            "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white", "dark:focus:ring-blue-500",
            "dark:focus:border-blue-500");

        var containerFile = document.createElement('div');
        containerFile.classList.add('grid', 'grid-cols-2', 'gap-4');

        var avatarInput = document.createElement('input');
        avatarInput.name = `file-Link${linkSectionCount}`;
        avatarInput.type = 'url';
        avatarInput.classList.add("bg-gray-50", "border", "border-gray-300", "text-gray-900", "text-sm", "rounded-lg",
            "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "dark:bg-gray-700",
            "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white", "dark:focus:ring-blue-500",
            "dark:focus:border-blue-500");

        avatarInput.addEventListener('change', function() {

            updatePreview(); // Update preview when data changes
        });
        nameInput.addEventListener('change', function() {

            updatePreview(); // Update preview when data changes
        });
        var sourceTypeSelect = document.createElement('select');
        sourceTypeSelect.name = `type-Link${linkSectionCount}`;
        sourceTypeSelect.classList.add("bg-gray-50", "border", "border-gray-300", "text-gray-900", "text-sm",
            "rounded-lg",
            "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "p-2.5", "dark:bg-gray-700",
            "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white", "dark:focus:ring-blue-500",
            "dark:focus:border-blue-500");
        var urlOption = document.createElement('option');
        urlOption.value = 'url';
        urlOption.text = 'Website / Link';
        var uploadOption = document.createElement('option');
        uploadOption.value = 'upload';
        uploadOption.text = 'Upload';
        sourceTypeSelect.add(urlOption);
        sourceTypeSelect.add(uploadOption);

        sourceTypeSelect.addEventListener('input', function() {
            avatarInput.type = (this.value === 'url') ? 'text' : 'file';
            updatePreview(); // Update preview when data changes
        });
        if (action.type) {
            for (var i = 0; i < sourceTypeSelect.options.length; i++) {
                if (sourceTypeSelect.options[i].value === action.type) {
                    sourceTypeSelect.options[i].selected = true;
                    avatarInput.type = (sourceTypeSelect.value === 'url') ? 'text' : 'file';
                    avatarInput.value = action.url;
                    break;
                }
            }
        }
        var label = document.createElement('label');
        label.htmlFor = 'Content';
        label.classList.add('mb-2', 'text-sm', 'font-medium', 'text-gray-900', 'dark:text-white', 'block');
        label.textContent = 'Content';

        var deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete';
        deleteButton.addEventListener('click', () => {
            inputFieldsLinksContainer.removeChild(linkSection);

            updatePreview(); // Update preview when a section is deleted
        });

        linkSection.appendChild(nameLabel);
        linkSection.appendChild(nameInput);
        linkSection.appendChild(label);
        containerFile.appendChild(avatarInput);
        containerFile.appendChild(sourceTypeSelect);
        linkSection.appendChild(containerFile);
        linkSection.appendChild(deleteButton);

        inputFieldsLinksContainer.appendChild(linkSection);
        updatePreview(); // Update preview when a new section is added
    }

    function updatePreview() {

        // Keep track of existing preview sections
        const existingPreviews = document.querySelectorAll('.link-preview');

        // Iterate over each link section
        document.querySelectorAll('.link-section').forEach((section, index) => {
            const name = section.querySelector('input[type="text"]').value;

            // Check if a preview section already exists for the current link section
            const existingPreview = document.getElementById(`Link${index + 1}`);
            var url='';
            if (!existingPreview) {
                // Create a new preview section if it doesn't exist
                const previewSection = document.createElement('a');
                previewSection.setAttribute('target', "_blank");
                previewSection.id = `Link${index + 1}`;

                previewSection.classList.add('link-preview', 'shadow', 'rounded-lg', 'w-full', 'p-4', 'block');

                // Display name, file, and URL (you can customize this)
                if (section.querySelector('input[type="file"]')) {
                    const file = section.querySelector('input[type="file"]');
                    url=URL.createObjectURL(file.value)
                    
                }

                if (section.querySelector('[name="file-' + section.getAttribute('name') + '"]')) {
                    const inputurl = section.querySelector('[name="file-' + section.getAttribute('name') + '"]');
                    url=inputurl.value;

                }
                previewSection.setAttribute('href', url);
                previewSection.textContent = `${name}`;
                LinksContainer.appendChild(previewSection);
            } else {
                // Update the existing preview section
                existingPreview.textContent = `${name}`;
                // Display name, file, and URL (you can customize this)
                if (section.querySelector('input[type="file"]')) {
                    const file = section.querySelector('input[type="file"]');
                    console.log("file 1");
                    console.log(file);
                    existingPreview.setAttribute('href', URL.createObjectURL(file.value));
                }

                if (section.querySelector('input[type="url"]')) {
                    const url = section.querySelector('input[type="url"]');
                    existingPreview.setAttribute('href', url.value);

                }
            }
        });

        // Remove preview sections that correspond to deleted link sections
        existingPreviews.forEach((preview) => {
            const correspondingLinkSection = document.getElementsByName(preview.id)[0]
            if (!correspondingLinkSection) {
                LinksContainer.removeChild(preview);
            }
        });
    }
    updateContent();
    addCallme();
    phone_same_Whatsapp();
    email_same_Gmail();
    ActionsArrayUser.forEach(element => {
        addLinkSection(element);
    });
</script>



</html>
