<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Uji Bootstrap | {{ config('app.name') }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container py-5">
        <div class="alert alert-success" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            Laravel, Vite, Bootstrap 5, dan Bootstrap Icons berfungsi.
        </div>

        <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#uji-js">
            <i class="bi bi-chevron-down me-1"></i> Uji JavaScript Bootstrap
        </button>

        <div class="collapse mt-3" id="uji-js">
            <div class="card card-body">
                Jika kotak ini terbuka dan tertutup saat tombol diklik, JavaScript Bootstrap berjalan.
            </div>
        </div>
    </div>
</body>
</html>