<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .register-card {
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
        <div class="card register-card shadow">
            <div class="card-body">
                <h4 class="card-title text-center mb-4">Register</h4>

                <!-- Pesan Error -->
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>

                <!-- Pesan Sukses -->
                <?php if (!empty($success)): ?>
                    <div class="alert alert-success"><?= $success ?></div>
                <?php endif; ?>

                <form action="<?= base_url('index.php/auth/do_register') ?>" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="<?= set_value('username') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" class="form-select" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="operator" <?= set_select('role', 'operator') ?>>Operator</option>
                            <option value="karyawan" <?= set_select('role', 'karyawan') ?>>Karyawan</option>
                        </select>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Daftar</button>
                    </div>

                    <div class="mt-3 text-center">
                        <a href="<?= base_url('index.php/auth/login') ?>" class="btn btn-link">Sudah punya akun? Login</a>
                        <a href="<?= base_url() ?>" class="badge bg-primary text-decoration-none ms-2">
                            <i class="fas fa-house"></i> Landing Page
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
