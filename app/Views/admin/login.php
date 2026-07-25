<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetim Paneli Girişi | Bornova Su Kaçak Tespiti</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body class="admin-body">
    <div class="login-container">
        <div class="login-box">
            <h1>Yönetim Paneli</h1>
            <p class="subtitle">Bornova Su Kaçak Tespiti</p>

            <?php if (isset($error)): ?>
                <div class="alert alert-error">
                    <?php echo e($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="login-form">
                <div class="form-group">
                    <label for="email">E-posta Adresi</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        autofocus
                        class="form-control"
                        placeholder="admin@example.com"
                    >
                </div>

                <div class="form-group">
                    <label for="password">Şifre</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="form-control"
                        placeholder="••••••••"
                    >
                </div>

                <div class="form-group checkbox">
                    <label>
                        <input type="checkbox" name="remember" value="1">
                        Beni Hatırla
                    </label>
                </div>

                <button type="submit" class="btn-primary btn-login">
                    Giriş Yap
                </button>
            </form>

            <div class="login-footer">
                <p>Test Hesabı: admin@bornova.com / password</p>
            </div>
        </div>
    </div>

    <style>
        :root {
            --color-navy-900: #0b1830;
            --color-navy-800: #0f1f3d;
            --color-blue-500: #2f6fed;
            --color-blue-600: #1f4da8;
            --color-white: #ffffff;
            --color-gray-100: #f8fafc;
            --color-gray-200: #e2e8f0;
            --color-gray-500: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body.admin-body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, var(--color-navy-900) 0%, var(--color-navy-800) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--color-gray-500);
        }

        .login-container {
            width: 100%;
            padding: 20px;
        }

        .login-box {
            background: var(--color-white);
            border-radius: 12px;
            box-shadow: 0 20px 25px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 400px;
            margin: 0 auto;
        }

        .login-box h1 {
            font-size: 28px;
            color: var(--color-navy-900);
            margin-bottom: 8px;
            font-weight: 700;
        }

        .subtitle {
            color: var(--color-gray-500);
            font-size: 14px;
            margin-bottom: 32px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 8px;
            font-size: 14px;
            color: var(--color-navy-900);
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--color-gray-200);
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--color-blue-500);
            box-shadow: 0 0 0 3px rgba(47, 111, 237, 0.1);
        }

        .form-group.checkbox label {
            display: flex;
            align-items: center;
            margin-bottom: 0;
            cursor: pointer;
        }

        .form-group.checkbox input[type="checkbox"] {
            margin-right: 8px;
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: var(--color-blue-500);
            color: var(--color-white);
            border: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-login:hover {
            background: var(--color-blue-600);
        }

        .login-footer {
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid var(--color-gray-200);
            text-align: center;
            font-size: 12px;
            color: var(--color-gray-500);
        }
    </style>
</body>
</html>
