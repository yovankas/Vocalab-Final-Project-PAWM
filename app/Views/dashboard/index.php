<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | VocaLab</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tilt+Warp&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <div class="nav-left">
                <div class="logo-container">
                    <img src="<?= base_url('images/logo.png') ?>" alt="VocaLab Logo" class="logo">
                    <h1 class="brand">VocaLab</h1>
                </div>
                <nav class="nav-links">
                    <a href="#" class="nav-link">Dashboard</a>
                    <a href="<?= base_url('courses') ?>" class="nav-link">My Courses</a>
                </nav>
            </div>
            <div class="user-profile">
                <img src="<?= base_url('images/avatar.png') ?>" alt="User Avatar" class="avatar">
                <span class="username"><?= session()->get('username') ?></span>
            </div>
        </header>

        <!-- Welcome Section -->
        <section class="welcome-section">
            <div class="welcome-content">
                <img src="<?= base_url('images/welcome-illustration.png') ?>" alt="Welcome" class="welcome-image">
                <div class="welcome-text">
                    <h2>Welcome back, <?= session()->get('username') ?>!</h2>
                    <?php
                    $totalCompleted = 0;
                    $totalQuestions = 0;
                    foreach ($labs as $lab) {
                        $totalCompleted += $lab['completed_count'];
                        $totalQuestions += $lab['total_questions'];
                    }
                    $overallProgress = $totalQuestions > 0 ? round(($totalCompleted / $totalQuestions) * 100) : 0;
                    ?>
                    <p>You have completed <span class="highlight"><?= $overallProgress ?>% of overall courses!</span></p>
                    <button class="btn-primary" onclick="window.location.href='<?= base_url('courses') ?>'">Start learning</button>
                </div>
            </div>
        </section>

        <!-- Course Progress -->
        <section class="progress-section">
            <div class="progress-header">
                <h3>Course Progress</h3>
                <span class="date">per Today</span>
            </div>
            
            <div class="progress-items">
                <?php foreach ($labs as $lab): ?>
                    <div class="progress-item">
                        <div class="progress-icon">
                            <img src="<?= base_url('images/' .  $lab['icon']) ?>" 
                                 alt="<?= $lab['name'] ?>">
                        </div>
                        <div class="progress-details">
                            <div class="progress-title">
                                <span><?= $lab['name'] ?></span>
                                <span class="progress-count"><?= $lab['completed_count'] ?>/<?= $lab['total_questions'] ?></span>
                            </div>
                            <div class="progress-bar">
                                <?php
                                $progressWidth = $lab['total_questions'] > 0 
                                    ? ($lab['completed_count'] / $lab['total_questions']) * 100 
                                    : 0;
                                ?>
                                <div class="progress" style="width: <?= $progressWidth ?>%"></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #FFFFFF;
            color: #131313;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 40px;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo {
            width: 48px;
            height: 48px;
            border-radius: 12px;
        }

        .brand {
            font-family: 'Tilt Warp', cursive;
            font-style: normal;
            color: #007AFF;
            font-size: 24px;
            font-weight: 600;
            margin: 0;
            width: 100%;
        }

        .nav-links {
            display: flex;
            gap: 24px;
        }

        .nav-link {
            color: #131313;
            text-decoration: none;
            font-size: 16px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .username {
            font-size: 16px;
            font-weight: 500;
        }

        /* Welcome Section */
        .welcome-section {
            margin: 40px 0;
        }

        .welcome-content {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .welcome-image {
            width: 180px;
            height: 180px;
        }

        .welcome-text h2 {
            font-size: 28px;
            margin-bottom: 12px;
        }

        .highlight {
            color: #007AFF;
            font-weight: 600;
        }

        .btn-primary {
            background-color: #007AFF;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            margin-top: 16px;
            font-family: 'Inter';
        }

        /* Progress Section */
        .progress-section {
            background-color: #F8F8F8;
            border-radius: 16px;
            padding: 24px;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .progress-header h3 {
            font-size: 20px;
            font-weight: 600;
        }

        .date {
            color: #666;
            font-size: 14px;
        }

        .progress-items {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .progress-item {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .progress-icon {
            width: 48px;
            height: 48px;
            background-color: #E8F0FE;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .progress-icon img {
            width: 24px;
            height: 24px;
        }

        .progress-details {
            flex: 1;
        }

        .progress-title {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .progress-count {
            color: #666;
            font-size: 14px;
        }

        .progress-bar {
            height: 8px;
            background-color: #E8E8E8;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background-color: #007AFF;
            border-radius: 4px;
            transition: width 0.3s ease;
        }
    </style>
</body>
</html>