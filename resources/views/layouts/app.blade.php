<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
</head>

<body>

    <header class="bg-success-subtle py-2">
        <a href="#" class="text-decoration-none">Home</a>
        <a href="{{ route('post.index') }}" class="text-decoration-none">Posts</a>
        <a href="{{ route('student.index') }}" class="text-decoration-none">Students</a>
        <a href="{{ route('product.index') }}" class="text-decoration-none">Products</a>
        <a href="{{ route('client.index') }}" class="text-decoration-none">Clients</a>
        <a href="{{ route('brand.index') }}" class="text-decoration-none">Brand</a>
        <a href="{{ route('car.index') }}" class="text-decoration-none">Car</a>
    </header>
    <main>
        @yield('app')
    </main>

    <footer class="py-2 bg-primary">
        <p class="text-center">BuiNgocPhi</p>
    </footer>
    @include('sweetalert::alert')
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
</body>

</html>
