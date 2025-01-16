<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VocaLab - Learn English Virtual Lab</title>
    <link rel="stylesheet" href="<?= base_url('css/welcome.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Tilt+Warp&display=swap" rel="stylesheet">
    <style>
        
        /* Add responsive styles */
        @media screen and (max-width: 768px) {
            .navbar-container {
                padding: 0 20px;
            }

            .content-container {
                flex-direction: column;
                padding: 20px;
                gap: 32px;
            }

            .image-section {
                width: 100%;
            }

            .welcome-image {
                max-width: 100%;
                height: auto;
            }

            .text-section {
                width: 100%;
                text-align: center;
            }

            .headline {
                font-size: 28px;
                line-height: 1.3;
            }

            .cta-section {
                align-items: center;
            }
        }

        @media screen and (max-width: 480px) {
            .headline {
                font-size: 24px;
            }

            .primary-button {
                width: 100%;
                max-width: 280px;
            }

            .login-section {
                flex-direction: column;
                gap: 8px;
            }
        }
    </style>
</head>
<body>
    <header class="navbar">
        <div class="navbar-container">
            <div class="logo-section">
                <img src="<?= base_url('images/logo.png') ?>" alt="VocaLab Logo" class="logo-image">
                <h1 class="logo-text">VocaLab</h1>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="content-container">
            <div class="image-section">
                <img src="<?= base_url('images/welcome.png') ?>" alt="Learning English" class="welcome-image">
            </div>
            <div class="text-section">
                <h2 class="headline">Learn a language in 3 minute a day!</h2>
                <div class="cta-section">
                    <a href="<?= base_url('signup') ?>" class="primary-button">Start learning</a>
                    <div class="login-section">
                        <span class="login-text">Already have an account?</span>
                        <a href="<?= base_url('login') ?>" class="login-link">Sign in</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>