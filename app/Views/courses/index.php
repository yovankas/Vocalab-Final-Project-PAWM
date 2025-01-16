<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses | VocaLab</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tilt+Warp&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #007AFF;
            --background: #FFFFFF;
            --surface-default: #F8F8F8;
            --body-primary: #131313;
            --border-divider: #F2F2F2;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: var(--background);
        }

        .container {
            max-width: 1440px;
            margin: 0 auto;
            padding: 28px 120px;
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

        .courses-container {
            margin-top: 40px;
            padding: 25px 23px;
            background: var(--surface-default);
            border-radius: 12px;
        }

        .course-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .course-card {
            background: var(--background);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .course-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 16px;
        }

        .course-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .course-icon img {
            width: 100%;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: var(--surface-default);
            border-radius: 4px;
            margin: 16px 0;
        }

        .progress-fill {
            width: 0%;
            height: 100%;
            background: var(--primary);
            border-radius: 4px;
        }

        .question-list {
            margin-top: 16px;
        }

        .question-item {
            display: flex;
            align-items: center;
            padding: 12px;
            background: var(--surface-default);
            border-radius: 12px;
            margin-bottom: 8px;
        }

        .question-avatar {
            width: 40px;
            height: 40px;
            border-radius: 20px;
            background: var(--background);
            margin-right: 12px;
        }

        .question-info {
            flex: 1;
        }

        .start-button {
            padding: 8px 16px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            font-family: 'Inter';
        }

        .per-today {
            color: #666;
            font-size: 14px;
            text-align: right;
            margin-bottom: 20px;
        }

        .progress-count {
            color: #666;
            font-size: 14px;
            text-align: right;
        }
    </style>
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
                    <a href="<?= base_url('dashboard') ?>" class="nav-link">Dashboard</a>
                    <a href="<?= base_url('courses') ?>" class="nav-link">My Courses</a>
                </nav>
            </div>
            <div class="user-profile">
                <img src="<?= base_url('images/avatar.png') ?>" alt="User Avatar" class="avatar">
                <span class="username"><?= session()->get('username') ?></span>
            </div>
        </header>

        <div class="courses-container">
            <div class="per-today">per Today</div>
            <div class="course-title">Course Progress</div>

            <?php foreach ($courses as $course): ?>
                <div class="course-card" data-lab-slug="<?= $course['id'] ?>">
                    <div class="course-header">
                        <div class="course-icon">
                            <img src="<?= base_url('images/' . $course['icon']) ?>" alt="<?= $course['name'] ?>">
                        </div>
                        <h3><?= $course['name'] ?></h3>
                        <div class="progress-count"><?= $course['completed_count'] ?>/<?= $course['total_questions'] ?></div>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: <?= ($course['completed_count'] / $course['total_questions']) * 100 ?>%"></div>
                    </div>
                    <div class="question-list">
                        <?php foreach ($course['sections'] as $section): ?>
                            <div class="question-item" data-section-slug="<?= $section['slug'] ?>">
                                <div class="question-avatar"></div>
                                <div class="question-info"><?= $section['name'] ?></div>
                                <button class="start-button">Start now</button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        document.querySelectorAll('.start-button').forEach(button => {
            button.addEventListener('click', function() {
                const labSlug = this.closest('.course-card').dataset.labSlug;
                const sectionSlug = this.closest('.question-item').dataset.sectionSlug;
                window.location.href = `<?= base_url('question/') ?>${labSlug}/${sectionSlug}`;
            });
        });
    </script>
</body>
</html>