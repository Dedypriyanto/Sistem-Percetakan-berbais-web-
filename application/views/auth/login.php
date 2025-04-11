<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-card {
            max-width: 400px;
            margin: 60px auto;
        }
        .btn-link, .badge {
            transition: all 0.2s ease-in-out;
        }
        .btn-link:hover, .badge:hover {
            opacity: 0.85;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card login-card shadow">
            <div class="card-body">
                <h4 class="card-title text-center mb-4">Login</h4>

                <!-- Tampilkan Pesan Error jika ada -->
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('index.php/auth/do_login') ?>" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= set_value('username') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>

                <div class="mt-3 text-center">
                    <span>Belum punya akun?</span>
                    <a href="<?= base_url('index.php/auth/register') ?>" class="btn btn-link">Register</a>
                    <a href="<?= base_url() ?>" class="badge bg-primary text-decoration-none ms-2">
                        <i class="fas fa-house"></i> Landing Page
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
