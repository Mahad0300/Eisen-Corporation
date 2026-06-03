<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Eisen Corporation</title>
    <!-- Google Fonts: Montserrat & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Montserrat:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --bg-dark: #050d1a;
            --surface: #0f2240;
            --surface-hover: #16325c;
            --primary: #d4af37;
            --primary-hover: #c9a227;
            --text-light: #ffffff;
            --text-muted: #94a3b8;
            --border: rgba(255, 255, 255, 0.08);
            --error: #ef4444;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-light);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: radial-gradient(circle at center, #0f2240 0%, #050d1a 100%);
            padding: 20px;
        }

        .login-container {
            background: var(--surface);
            padding: 40px;
            border-radius: 16px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 48px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(212, 175, 55, 0.2);
            transition: border-color 0.3s;
        }

        .login-container:hover {
            border-color: var(--primary);
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-logo {
            max-width: 180px;
            height: auto;
            margin-bottom: 20px;
        }

        .login-header h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .login-header h1 span {
            color: var(--primary);
        }

        .login-header p {
            color: var(--text-muted);
            font-size: 13px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--text-muted);
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper i {
            position: absolute;
            left: 14px;
            color: var(--text-muted);
            width: 18px;
            height: 18px;
            pointer-events: none;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px 12px 42px;
            background: rgba(5, 13, 26, 0.6);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text-light);
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(5, 13, 26, 0.8);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.15);
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: var(--primary);
            color: var(--bg-dark);
            border: none;
            border-radius: 8px;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.2);
        }

        .flash-message {
            background: rgba(239, 68, 68, 0.1);
            color: var(--error);
            padding: 12px;
            border-radius: 8px;
            border: 1px solid rgba(239, 68, 68, 0.2);
            margin-bottom: 20px;
            font-size: 13px;
            text-align: center;
        }
        
        .demo-credentials {
            margin-top: 24px;
            padding: 12px;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 8px;
            border: 1px dashed var(--border);
            text-align: center;
            font-size: 12px;
            color: var(--text-muted);
        }

        .demo-credentials strong {
            color: var(--primary);
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="login-header">
            <img src="<?= BASE_URL ?>/public/image/eisen-logo.png" alt="Eisen Corporation Logo" class="login-logo">
            <h1>Eisen <span>Admin</span></h1>
            <p>Secure system authentication gateway</p>
        </div>

        <?php if(isset($flash) && $flash): ?>
            <div class="flash-message">
                <?= htmlspecialchars($flash['message']) ?>
            </div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/admin/login" method="POST">
            <div class="form-group">
                <label class="form-label" for="email">Admin Email</label>
                <div class="input-wrapper">
                    <i data-lucide="mail"></i>
                    <input class="form-control" type="email" id="email" name="email" placeholder="admin@eisen.com" required autocomplete="email" value="admin@eisen.com">
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <div class="input-wrapper">
                    <i data-lucide="lock"></i>
                    <input class="form-control" type="password" id="password" name="password" placeholder="••••••••" required autocomplete="current-password" value="admin123">
                </div>
            </div>
            
            <button type="submit" class="btn-login">
                <span>Sign In Securely</span>
                <i data-lucide="shield-check"></i>
            </button>
        </form>

        <div class="demo-credentials">
            <p>Demo accounts credentials pre-filled.<br>Click <strong>Sign In Securely</strong> to enter.</p>
        </div>
    </div>

    <script>
        // Init Lucide Icons
        lucide.createIcons();
    </script>
</body>
</html>
