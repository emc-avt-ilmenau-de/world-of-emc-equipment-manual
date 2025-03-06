<!-- resources/views/FrontEnd/layouts/main.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMC-WEB</title>
    <link rel="stylesheet" href="{{ asset('Frontend/css/styles.css') }}" />
    <!-- Add your CSS links here -->
</head>

<body>
    @include('FrontEnd.layouts.header') <!-- Include header -->

    <div class="container">
        @yield('main-container') <!-- Main content will be injected here -->
    </div>

    @include('FrontEnd.layouts.footer') <!-- Include footer -->
</body>

</html>