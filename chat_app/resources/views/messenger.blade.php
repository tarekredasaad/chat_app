<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://unpkg.com/tailwindcss@1.4.6/dist/tailwind.min.css" rel="stylesheet">

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('c2477bf7423772f92728', {
      cluster: 'eu'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      alert(JSON.stringify(data));
    });
  </script>
</head>
<body class="h-screen overflow-hidden flex items-center justify-center" style="background: #edf2f7;">
    <style>
   @include('pagecss');
</style>

<!-- Messenger Clone -->
<div class="h-screen w-full flex antialiased text-gray-200 bg-gray-900 overflow-hidden">
    <div class="flex-1 flex flex-col">
        <div class="border-b-2 border-gray-800 p-2 flex flex-row z-20">
            <div class="bg-red-600 w-3 h-3 rounded-full mr-2"></div>
            <div class="bg-yellow-500 w-3 h-3 rounded-full mr-2"></div>
            <div class="bg-green-500 w-3 h-3 rounded-full mr-2"></div>
        </div>
        <main class="flex-grow flex flex-row min-h-0">
            <section class="flex flex-col flex-none overflow-auto w-24 hover:w-64 group lg:max-w-sm md:w-2/5 transition-all duration-300 ease-in-out">
                <div class="header p-4 flex flex-row justify-between items-center flex-none">
                    <div class="w-16 h-16 relative flex flex-shrink-0" style="filter: invert(100%);">
                        <img class="rounded-full w-full h-full object-cover" alt="ravisankarchinnam"
                             src="https://avatars3.githubusercontent.com/u/22351907?s=60"/>
                    </div>
                    <p class="text-md font-bold hidden md:block group-hover:block">Messenger</p>
                    <a href="#" class="block rounded-full hover:bg-gray-700 bg-gray-800 w-10 h-10 p-2 hidden md:block group-hover:block">
                        <svg viewBox="0 0 24 24" class="w-full h-full fill-current">
                            <path
                                    d="M6.3 12.3l10-10a1 1 0 0 1 1.4 0l4 4a1 1 0 0 1 0 1.4l-10 10a1 1 0 0 1-.7.3H7a1 1 0 0 1-1-1v-4a1 1 0 0 1 .3-.7zM8 16h2.59l9-9L17 4.41l-9 9V16zm10-2a1 1 0 0 1 2 0v6a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h6a1 1 0 0 1 0 2H4v14h14v-6z"/>
                        </svg>
                    </a>
                </div>
                <div class="search-box p-4 flex-none">
                    <form onsubmit="">
                        <div class="relative">
                            <label>
                                <input class="rounded-full py-2 pr-6 pl-10 w-full border border-gray-800 focus:border-gray-700 bg-gray-800 focus:bg-gray-900 focus:outline-none text-gray-200 focus:shadow-md transition duration-300 ease-in"
                                       type="text" value="" placeholder="Search Messenger"/>
                                <span class="absolute top-0 left-0 mt-2 ml-3 inline-block">
                                    <svg viewBox="0 0 24 24" class="w-6 h-6">
                                        <path fill="#bbb"
                                              d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"/>
                                    </svg>
                                </span>
                            </label>
                        </div>
                    </form>
                </div>
                <div class="active-users flex flex-row p-2 overflow-auto w-0 min-w-full">

                    <div class="text-sm text-center mr-4">
                        <button class="flex flex-shrink-0 focus:outline-none block bg-gray-800 text-gray-600 rounded-full w-20 h-20"
                                type="button">
                            <svg class="w-full h-full fill-current" viewBox="0 0 24 24">
                                <path d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"/>
                            </svg>
                        </button>
                        <p>Your Story</p>
                    </div> @foreach($users as $user )
                    <div class="text-sm text-center mr-4"><div class="p-1 border-4 border-blue-600 rounded-full"><div class="w-16 h-16 relative flex flex-shrink-0">
                        <a href="{{url('messageuser',$user->id)}}">  <img class="shadow-md rounded-full w-full h-full object-cover"
                             src="{{asset('')}}./imagepost/{{$user->img}}"
                             alt=""
                        />
                    </div></div><p>{{$user->name}} </p></a></div> @endforeach
                    <div class="text-sm text-center mr-4"><div class="p-1 border-4 border-blue-600 rounded-full"><div class="w-16 h-16 relative flex flex-shrink-0">
                        <img class="shadow-md rounded-full w-full h-full object-cover"
                             src="https://randomuser.me/api/portraits/women/12.jpg"
                             alt=""
                        />
                    </div></div><p>Anna</p></div>

                </div>
                {{$id = session('adminData')[0]->id;}}
                <div class="contacts p-2 flex-1 overflow-y-scroll">
                @foreach($users as $user )



                    <div class="flex justify-between items-center p-3 hover:bg-gray-800 rounded-lg relative" >
                        <a href="{{url('messageuser',$user->id)}}"> <div class="w-16 h-16 relative flex flex-shrink-0">
                            <img class="shadow-md rounded-full w-full h-full object-cover"
                                 src="{{asset('')}}./imagepost/{{$user->img}}"
                                 alt=""
                            />
                        </div>

                        <div class="flex-auto min-w-0 ml-4 mr-6 hidden md:block group-hover:block">
                            <p>{{$user->name}}</p>
                            <div class="flex items-center text-sm text-gray-600">
                                <div class="min-w-0">
                                    <p class="truncate">Ok, see you at the subway in a bit.</p>
                                </div>
                                <p class="ml-2 whitespace-no-wrap">Just now</p>
                            </div>
                        </div> </a>
                    </div> @endforeach

                </div>
            </section>
            <section class="flex flex-col flex-auto border-l border-gray-800">
            <div wire:poll.2000ms >
                @if( session()->has('message'))
                <div class="alert alert-success">
                    {{session('message')}}
                </div>@endif

          </div>

                    {{$img =session('adminData')[0]->img}}
                    <div class="chat-header px-6 py-4 flex flex-row flex-none justify-between items-center shadow">
                        <div class="flex">
                            <div class="w-12 h-12 mr-4 relative flex flex-shrink-0">
                                <img class="shadow-md rounded-full w-full h-full object-cover"
                                    src="{{asset('')}}./imagepost/{{$img}}"
                                    alt=""
                                />
                            </div>
                            <div class="text-sm">
                                <p class="font-bold">{{session('adminData')[0]->name}}</p>
                                <p>Active 1h ago</p>
                            </div>
                        </div>


                        </div>
                        <div class="chat-body p-4 flex-1 overflow-x-scroll">




                        </div>

                    </div>
                </div>
            </section>
        </main>
    </div>
</div>


</body>
</html>
