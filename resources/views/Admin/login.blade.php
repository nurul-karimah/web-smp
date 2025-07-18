<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">

<div class="card shadow p-4" style="width: 400px;">
    <h3 class="text-center mb-4">Login Admin</h3>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email Admin</label>
            <input type="email" class="form-control" name="email" required autofocus>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Kata Sandi</label>
            <input type="password" class="form-control" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>

</body>
</html>
