<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{ asset('img/sumenep-logo.png') }}" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playfair+Display:wght@700;900&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    
    <!-- Bootstrap Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/sb-admin-2.min.css') }}"> 
    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>
<main id="wrapper-form-admin">
    <div class="wrapper-admin animated fadeInDown">
        <div class="container">
            <h2 class="mb-5">Login</h2>
            <form method="POST" action="{{ route('auth.admin') }}" class="mb-3">
                <input type="hidden" name="role" value="2">
                @csrf
                @if ($errors->has('error'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ $errors->first('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="mb-3 input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
                    </div>
                    <input type="text" name="username" value="{{ old('username') }}" class="form-control shadow-none py-4" aria-describedby="emailHelp"
                        placeholder="Username" autocomplete="username" required>
                </div>
                <div class="mb-3 input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-lock-fill"></i></span>
                    </div>
                    <input type="password" name="password" class="form-control shadow-none py-4" placeholder="Password"
                        autocomplete="current-password" min="8" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 p-2 mt-3">Submit</button>
            </form>
        </div>
    </div>
</main>

    <script src="{{ asset('/vendor/jquery/jquery.min.js') }}"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

<body>

</body>

</html>