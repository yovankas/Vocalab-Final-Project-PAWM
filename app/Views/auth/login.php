<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | VocaLab</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Tilt+Warp&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <div class="group-297">
        <div class="rectangle-1"></div>
        <div class="frame-6">
            <img src="<?= base_url('images/logo.png') ?>" alt="VocaLab Logo" class="image-3">
            <h1 class="headline">VocaLab</h1>
        </div>
    </div>

    <!-- Login Page -->
    <div class="log-in-page">
        <div class="group-520">
            <div class="frame-519">
                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                
                <?php if(session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <div class="frame-520">
                    <h1 class="headline">Hello!</h1>
                    <h2 class="headline">Log in and continue your learning</h2>
                </div>
                
                <form action="<?= base_url('login') ?>" method="post" class="frame-521">
                    <?= csrf_field() ?>
                    <div class="email">
                        <div class="description">
                            <label class="email-label">Email</label>
                        </div>
                        <div class="input">
                            <div class="content">
                                <input type="email" name="email" class="input-text" placeholder="Enter your email" value="<?= old('email') ?>" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="email">
                        <div class="description">
                            <label class="email-label">Password</label>
                        </div>
                        <div class="input">
                            <div class="content">
                                <input type="password" name="password" class="input-text" placeholder="Enter your password" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="frame-523">
                        <div class="frame-522">
                            <button type="submit" class="primary">
                                <span class="label">Sign In</span>
                            </button>
                            <p class="policy-text">By continuing, you agree to our Terms of Service and Privacy Policy.</p>
                        </div>
                        <div class="text-text-button">
                            <p class="text">Don't have an account?</p>
                            <a href="<?= base_url('signup') ?>" class="text-button">Sign Up</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #FFFFFF;
            font-family: 'Inter', sans-serif;
        }

        .log-in-page {
            position: relative;
            width: 1440px;
            height: 684px; /* Reduced height */
        }

        .group-520 {
            position: absolute;
            width: 1200px;
            height: 684px;
            left: 120px;
            top: 80px;
        }

        .frame-519 {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0px;
            gap: 45px; /* Reduced gap */
            position: absolute;
            width: 1200px;
            height: 684px;
        }

        .frame-520 {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 0px;
            width: 1200px;
            height: 140px;
        }

        .headline {
            font-family: 'Tilt Warp', cursive;
            font-style: normal;
            font-weight: 400;
            font-size: 50px;
            line-height: 70px;
            color: #131313;
            margin: 0;
            width: 100%;
        }

        .frame-520 h2.headline {
            font-size: 40px;
            text-align: center;
            width: auto;
            white-space: nowrap;
        }

        .frame-521 {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0px;
            gap: 37px;
            width: 548px;
        }

        .email {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0px;
            gap: 10px;
            width: 548px;
            height: 70px;
        }

        .description {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: flex-start;
            padding: 0px;
            gap: 8px;
            width: 548px;
            height: 16px;
        }

        .email-label {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 18px;
            line-height: 16px;
            display: flex;
            align-items: center;
            letter-spacing: 0.4px;
            color: #131313;
        }

        .input {
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 0px 0px 0px 16px;
            width: 548px;
            height: 44px;
            background: #F8F8F8;
            border: 1px solid #F2F2F2;
            border-radius: 12px;
        }

        .input-text {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 20px;
            line-height: 24px;
            width: 100%;
            border: none;
            background: transparent;
            color: #131313;
        }

        .input-text::placeholder {
            color: #D7D7D7;
        }

        .frame-523 {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0px;
            gap: 30px;
            width: 548px;
            height: 170px;
        }

        .frame-522 {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0px;
            gap: 13px;
            width: 548px;
        }

        .primary {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 12px 20px;
            gap: 10px;
            width: 495px;
            height: 64px;
            background: #007AFF;
            border-radius: 12px;
            border: none;
            cursor: pointer;
        }

        .label {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-size: 25px;
            line-height: 24px;
            color: #FFFFFF;
            letter-spacing: -0.408px;
        }

        .policy-text {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 14px;
            line-height: 20px;
            text-align: center;
            letter-spacing: -0.003em;
            color: #D7D7D7;
            margin: 0;
        }

        .text-text-button {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 0px;
            gap: 8px;
        }

        .text {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 18px;
            line-height: 20px;
            color: #131313;
            margin: 0;
        }

        .text-button {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 18px;
            line-height: 20px;
            color: #007AFF;
            text-decoration: underline;
        }

        /* Header Styles */
        .group-297 {
            position: absolute;
            width: 1440px;
            height: 108px;
            left: 0;
            top: 0;
        }

        .rectangle-1 {
            position: absolute;
            width: 1440px;
            height: 100px;
            left: 0;
            top: 0;
            background: #FFFFFF;
        }

        .frame-6 {
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 0px;
            gap: 10px;
            position: absolute;
            width: 1200px;
            height: 80px;
            left: 120px;
            top: 28px;
        }

        .image-3 {
            width: 80px;
            height: 80px;
            border-radius: 20px;
        }

        .frame-6 .headline {
            width: 132px;
            height: 70px;
            font-size: 30px;
            color: #007AFF;
        }

        .alert {
            width: 548px;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 20px;
            text-align: center;
        }

        .alert-danger {
            background-color: #FEE2E2;
            border: 1px solid #FCA5A5;
            color: #DC2626;
        }

        .alert-success {
            background-color: #DCFCE7;
            border: 1px solid #86EFAC;
            color: #16A34A;
        }
    </style>
</body>
</html>