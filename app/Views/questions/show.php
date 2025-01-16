<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question | VocaLab</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tilt+Warp&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #007AFF;
            --background: #FFFFFF;
            --surface-default: #F8F8F8;
            --surface-primary: #E6F2FF;
            --body-primary: #131313;
            --body-on-primary: #FFFFFF;
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

        /* Content Area */
        .content {
            padding: 0px;
        }

        /* Back Button */
        .back-button {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            margin-bottom: 32px;
        }

        .back-icon {
            width: 40px;
            height: 40px;
            background: var(--surface-default);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .back-text {
            font-size: 16px;
            color: var(--body-primary);
            font-weight: 500;
        }

        /* Question Section */
        .question-container {
            max-width: 992px;
            margin: 0 auto;
        }

        .question-image {
            width: 100%;
            height: 500px;
            border-radius: 20px;
            object-fit: cover;
            margin-bottom: 32px;
        }

        .question-content {
            font-size: 18px;
            line-height: 1.5;
            color: var(--body-primary);
            margin-bottom: 24px;
        }

        .task {
            font-size: 20px;
            font-weight: 600;
            color: var(--body-primary);
            margin-bottom: 24px;
        }

        .options {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 32px;
        }

        .option-btn {
            padding: 8px 24px;
            background: var(--surface-primary);
            border-radius: 12px;
            border: none;
            cursor: pointer;
            font-family: 'Inter';
            font-weight: 500;
            font-size: 16px;
            color: var(--body-primary);
            transition: all 0.2s ease;
        }

        .option-btn:hover {
            background: #D1E7FF;
        }

        .option-btn.selected {
            background: var(--primary);
            color: var(--body-on-primary);
        }

        .check-button {
            width: 100%;
            height: 48px;
            background: var(--primary);
            border-radius: 12px;
            border: none;
            color: var(--body-on-primary);
            font-family: 'Inter';
            font-weight: 600;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .check-button:hover {
            background: #0066DD;
        }

        /* Custom Alert Styles */
        .alert {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 16px 24px;
            border-radius: 12px;
            background: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .alert.show {
            opacity: 1;
        }

        .alert.success {
            border-left: 4px solid #34C759;
        }

        .alert.error {
            border-left: 4px solid #FF3B30;
        }

        /* Bottom Sheet Styles */
        .bottom-sheet {
            display: none;
            flex-direction: column;
            align-items: center;
            padding: 24px;
            gap: 24px;
            position: fixed;
            width: 996px;
            height: 236px;
            left: 50%;
            bottom: 2px;
            transform: translateX(-50%);
            background: #F8F8F8;
            border-radius: 28px 28px 0px 0px;
        }

        .bottom-sheet.show {
            display: flex;
        }

        .result-header {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            gap: 4px;
            width: 848px;
        }

        .success-icon {
            width: 24px;
            height: 24px;
            position: relative;
        }

        .success-icon::before {
            content: "";
            position: absolute;
            left: 8.33%;
            right: 8.33%;
            top: 8.33%;
            bottom: 8.33%;
            background: #38AD49;
        }

        .result-title {
            font-family: 'Inter';
            font-weight: 600;
            font-size: 20px;
            line-height: 24px;
            letter-spacing: -0.003em;
            color: #38AD49;
            flex-grow: 1;
        }

        .explanation-container {
            display: flex;
            flex-direction: column;
            gap: 16px;
            width: 848px;
        }

        .explanation-label {
            font-size: 16px;
            line-height: 20px;
            letter-spacing: -0.003em;
            color: #131313;
        }

        .explanation-text {
            font-weight: 500;
            font-size: 18px;
            line-height: 24px;
            letter-spacing: -0.004em;
            color: #131313;
        }

        .continue-button {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 12px 20px;
            width: 848px;
            height: 48px;
            background: #38AD49;
            border-radius: 12px;
            border: none;
            cursor: pointer;
        }

        .continue-button span {
            font-weight: 600;
            font-size: 20px;
            line-height: 24px;
            color: #FFFFFF;
            letter-spacing: -0.004em;
        }

        /* Add this CSS to style the error message */
        #errorMessage {
            color: red;
            display: none;
            margin-bottom: 16px;
            text-align: center;
            font-weight: bold;
            font-size: 18px;
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

        <main class="content">
            <a href="<?= base_url('courses') ?>" class="back-button">
                <div class="back-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M15 18L9 12L15 6" stroke="#131313" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <span class="back-text">Back</span>
            </a>

            <div class="question-container">

                <p class="task"><?= $question['context_sentence'] ?></p>
                <?php if (!empty($question['image_url'])): ?>
                    <img src="<?= base_url('images/' . $question['image_url']) ?>" alt="Question Image" class="question-image">
                <?php endif; ?>
                
                <p class="question-content"><?= $question['content'] ?></p>

                <?= csrf_field() ?>
                
                <div class="answer-section">
                    <?php if ($question['question_type'] === 'fill_in'): ?>
                        <div class="options">
                            <?php foreach (explode(',', $question['options']) as $option): ?>
                                <button class="option-btn"><?= trim($option) ?></button>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    
                    <div id="errorMessage">Wrong answer! Try again.</div>
                    <button id="checkAnswer" class="check-button">Check</button>
                </div>
            </div>
        </main>
    </div>

    <!-- Custom Alert Template -->
    <div id="alert" class="alert">
        <span id="alertMessage"></span>
    </div>

    <div id="successSheet" class="bottom-sheet">
        <div class="result-header">
            <div class="success-icon"></div>
            <div class="result-title">Correct!</div>
        </div>
        <div class="explanation-container">
            <div class="explanation-label">Exercise</div>
            <div class="explanation-text" id="explanationText"></div>
            <button class="continue-button" onclick="window.location.href='<?= base_url('courses') ?>'">
                <span>Continue</span>
            </button>
        </div>
    </div>

    <script>
        function showAlert(message, type) {
            const alert = document.getElementById('alert');
            alert.className = `alert ${type} show`;
            alert.querySelector('#alertMessage').textContent = message;
            setTimeout(() => {
                alert.className = `alert ${type}`;
            }, 3000);
        }

        // Option button handlers
        document.querySelectorAll('.option-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.option-btn').forEach(btn => {
                    btn.classList.remove('selected');
                });
                this.classList.add('selected');
            });
        });

        // Check answer handler
        document.getElementById('checkAnswer').addEventListener('click', function() {
            const selectedOption = document.querySelector('.option-btn.selected');
            if (!selectedOption) {
                showAlert('Please select an answer', 'error');
                return;
            }

            // Get CSRF token from hidden input field
            const csrfName = document.querySelector('input[type=hidden]').name;
            const csrfToken = document.querySelector('input[type=hidden]').value;
            
            const formData = new FormData();
            formData.append('question_id', '<?= $question['id'] ?>');
            formData.append('answer', selectedOption.textContent.trim());
            formData.append(csrfName, csrfToken);

            fetch('<?= base_url('question/check') ?>', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData,
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(responseText => {
                // Try to parse the JSON response while handling potential HTML errors
                let jsonData;
                try {
                    // First try to parse the entire response as JSON
                    jsonData = JSON.parse(responseText);
                } catch (e) {
                    // If that fails, try to extract just the JSON part before any HTML
                    const jsonMatch = responseText.match(/^[\s\S]*?({[\s\S]*?})/);
                    if (jsonMatch) {
                        jsonData = JSON.parse(jsonMatch[1]);
                    } else {
                        throw new Error('Invalid response format');
                    }
                }

                // Update CSRF token
                if (jsonData.csrf_hash) {
                    document.querySelector('input[type=hidden]').value = jsonData.csrf_hash;
                }
                
                if (jsonData.correct) {
                    document.getElementById('explanationText').textContent = jsonData.correct_trivia;
                    document.getElementById('successSheet').classList.add('show');
                    document.getElementById('errorMessage').style.display = 'none';
                } else {
                    document.getElementById('errorMessage').style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('An error occurred. Please try again.', 'error');
            });
        });
    </script>
</body>
</html>