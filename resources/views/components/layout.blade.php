<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>NaijaPals | Micro-blogging website</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
        <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js" integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet" />
        

        @vite(['resources/css/main.css'])
        @vite(['resources/js/app.js'])
    </head>
    <body>
        @auth
            <header class="header-bar mb-3">
                <div class="container d-flex flex-column flex-md-row align-items-center p-3">
                    <h4 class="my-0 mr-md-auto font-weight-normal">
                        <a href="/" class="text-white">NaijaPals</a>
                    </h4>
                    <div class="flex-row my-3 my-md-0">
                        <a href="#" class="text-white mr-2 header-search-icon" title="Search" data-toggle="tooltip" data-placement="bottom">
                            <i class="fas fa-search"></i>
                        </a>
                        <span class="text-white mr-2 header-chat-icon" title="Chat" data-toggle="tooltip" data-placement="bottom">
                            <i class="fas fa-comment"></i>
                        </span>
                        <a href="/profile/{{auth()->user()->username}}" class="mr-2"><img title="My Profile" data-toggle="tooltip" data-placement="bottom" style="width: 32px; height: 32px; border-radius: 16px" src="/storage/img/{{auth()->user()->avatar}}" /></a>
                        <a class="btn btn-sm btn-success mr-2" href="/create-post">Create Post</a>
                        <form action="/logout" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-secondary">Sign Out</button>
                        </form>
                    </div>
                </div>
            </header>
        @else
            <header class="header-bar mb-3">
                <div class="container d-flex flex-column flex-md-row align-items-center p-3">
                    <h4 class="my-0 mr-md-auto font-weight-normal"><a href="/" class="text-white">NaijaPals</a></h4>
                    <form action="/login" method="POST" class="mb-0 pt-2 pt-md-0">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-md mr-0 pr-md-0 mb-3 mb-md-0">
                                <input name="userlogin" class="form-control form-control-sm input-dark" type="text" placeholder="Username" autocomplete="off" value = "{{old('userlogin')}}" />
                                @error('userlogin')
                                    <div class="text-danger" role="alert">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md mr-0 pr-md-0 mb-3 mb-md-0">
                                <input name="userpassword" class="form-control form-control-sm input-dark" type="password" placeholder="Password" />
                                @error('userpassword')
                                    <div class="text-danger" role="alert">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-auto">
                            <button class="btn btn-primary btn-sm">Sign In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </header>
            <!-- header ends here -->
        @endauth
        

        @if(session()->has('success'))
            
            <div class="container py-md-5">
                <div class="row align-items-center">
                    <div class="col-lg-5 pl-lg-5 mx-auto">
                        <div class="mb-2 alert alert-success shadow-sm text-center">
                            {{session('success')}}
                        </div>
                    </div>
                </div>
            </div>
        
            
        @elseif(session()->has('error'))
            <div class="container py-md-5">
                <div class="row align-items-center">
                    <div class="col-lg-5 pl-lg-5 mx-auto">
                        <div class="mb-2 alert alert-danger shadow-sm text-center">
                            {{session('error')}}
                        </div>
                    </div>
                </div>
            </div>
        @endif


        {{$slot}}


        <!-- footer begins -->
        <footer class="border-top text-center small text-muted py-3">
            <p class="m-0">Copyright &copy; {{date('Y')}} <a href="/" class="text-muted">NaijaPals</a>. All rights reserved.</p>
        </footer>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script>
        $('[data-toggle="tooltip"]').tooltip()
        </script>
    </body>
</html>