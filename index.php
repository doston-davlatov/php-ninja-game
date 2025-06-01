<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>Black Ninja</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(145deg, #1c2526, #2e3b3e, #0a0e11);
            color: #e0e0e0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            overflow-x: hidden;
            position: relative;
        }

        /* Background stars animation */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 2%, transparent 2.1%);
            background-size: 15px 15px;
            opacity: 0.3;
            animation: starTwinkle 20s linear infinite;
            z-index: -1;
        }

        @keyframes starTwinkle {
            0% {
                background-position: 0 0;
                opacity: 0.3;
            }

            50% {
                opacity: 0.5;
            }

            100% {
                background-position: 100px 100px;
                opacity: 0.3;
            }
        }

        /* Ninja shuriken background */
        body::after {
            content: '\f0c4';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(0deg);
            color: rgba(255, 193, 7, 0.1);
            font-size: 120px;
            opacity: 0;
            animation: shurikenSpin 15s linear infinite;
            z-index: -2;
        }

        @keyframes shurikenSpin {
            0% {
                opacity: 0;
                transform: translate(-50%, -50%) rotate(0deg);
            }

            50% {
                opacity: 0.15;
            }

            100% {
                opacity: 0;
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        .container {
            max-width: 800px;
            background: rgba(10, 14, 17, 0.95);
            padding: 30px;
            border-radius: 12px;
            box-shadow:
                0 0 30px rgba(0, 0, 0, 0.6),
                0 0 50px rgba(255, 193, 7, 0.3);
            backdrop-filter: blur(12px);
            text-align: center;
            animation: slideIn 1s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            color: #ffc107;
            font-size: 3em;
            margin-bottom: 25px;
            text-shadow:
                0 0 10px rgba(255, 193, 7, 0.8),
                0 0 20px rgba(255, 193, 7, 0.4);
            animation: flickerGlow 3s ease-in-out infinite alternate;
        }

        @keyframes flickerGlow {
            from {
                text-shadow: 0 0 10px rgba(255, 193, 7, 0.8), 0 0 20px rgba(255, 193, 7, 0.4);
            }

            to {
                text-shadow: 0 0 15px rgba(255, 193, 7, 1), 0 0 30px rgba(255, 193, 7, 0.6);
            }
        }

        .btn {
            background: linear-gradient(45deg, #ff9800, #ffca28);
            color: #fff;
            border: none;
            padding: 12px 25px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            border-radius: 6px;
            box-shadow:
                0 4px 12px rgba(0, 0, 0, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.4s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow:
                0 6px 18px rgba(255, 193, 7, 0.7),
                inset 0 1px 0 rgba(255, 255, 255, 0.4);
            background: linear-gradient(45deg, #fb8c00, #ffb300);
        }

        .btn:active {
            transform: translateY(0);
            box-shadow:
                0 2px 6px rgba(0, 0, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .btn-secondary {
            background: linear-gradient(45deg, #455a64, #607d8b);
        }

        .btn-secondary:hover {
            background: linear-gradient(45deg, #37474f, #546e7a);
            box-shadow:
                0 6px 18px rgba(96, 125, 139, 0.7),
                inset 0 1px 0 rgba(255, 255, 255, 0.4);
        }

        .btn-danger {
            background: linear-gradient(45deg, #d81b60, #f06292);
        }

        .btn-danger:hover {
            background: linear-gradient(45deg, #c2185b, #d81b60);
            box-shadow:
                0 6px 18px rgba(216, 27, 96, 0.7),
                inset 0 1px 0 rgba(255, 255, 255, 0.4);
        }

        .new-game {
            margin-top: 25px;
            padding: 15px;
            background: rgba(23, 28, 32, 0.9);
            border-radius: 8px;
            display: none;
            opacity: 0;
            transform: translateY(15px);
            transition: all 0.5s ease;
            box-shadow: 0 0 20px rgba(76, 175, 80, 0.5);
        }

        .new-game.show {
            display: block;
            opacity: 1;
            transform: translateY(0);
            animation: pulseResult 2.5s ease-in-out infinite alternate;
        }

        @keyframes pulseResult {
            from {
                box-shadow: 0 0 20px rgba(76, 175, 80, 0.5);
            }

            to {
                box-shadow: 0 0 30px rgba(76, 175, 80, 0.7);
            }
        }

        .link {
            color: #4caf50;
            font-weight: 600;
            font-size: 1em;
            word-break: break-all;
            margin: 10px 0;
            padding: 10px;
            background: rgba(17, 20, 23, 0.9);
            border-radius: 6px;
            box-shadow: 0 0 12px rgba(76, 175, 80, 0.4);
            transition: all 0.3s ease;
            position: relative;
        }

        .link:hover {
            background: rgba(17, 20, 23, 1);
            color: #81c784;
            box-shadow: 0 0 18px rgba(76, 175, 80, 0.6);
        }

        .icon {
            margin-right: 8px;
            font-size: 1.1em;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 15px;
        }

        #open-game {
            display: none;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.5s ease;
        }

        #open-game.show {
            display: inline-flex;
            opacity: 1;
            transform: translateY(0);
        }

        #my-games {
            margin-top: 25px;
            padding: 20px;
            background: linear-gradient(45deg, rgba(23, 28, 32, 0.95), rgba(44, 54, 62, 0.95));
            border-radius: 10px;
            box-shadow:
                0 0 25px rgba(255, 193, 7, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            width: 100%;
            max-height: 350px;
            overflow-y: auto;
            animation: fadeInGames 1s ease-out;
        }

        @keyframes fadeInGames {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .game-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px;
            margin-bottom: 8px;
            background: rgba(17, 20, 23, 0.9);
            border-radius: 6px;
            box-shadow: 0 0 12px rgba(255, 193, 7, 0.3);
            opacity: 0;
            transform: translateX(-15px);
            transition: all 0.4s ease;
        }

        .game-item.show {
            opacity: 1;
            transform: translateX(0);
        }

        .game-info {
            flex-grow: 1;
            text-align: left;
        }

        .game-link {
            color: #4caf50;
            font-weight: 600;
            font-size: 0.95em;
            word-break: break-all;
            margin-bottom: 4px;
            display: block;
            text-decoration: none;
        }

        .game-link:hover {
            color: #81c784;
        }

        .game-time {
            color: #90a4ae;
            font-size: 0.85em;
        }

        .game-actions {
            display: flex;
            gap: 8px;
        }

        .btn-small {
            padding: 6px 12px;
            font-size: 0.85em;
        }

        .particle {
            position: absolute;
            width: 10px;
            height: 10px;
            background: #ff9800;
            border-radius: 50%;
            pointer-events: none;
            animation: particleBurst 0.5s ease-out forwards;
        }

        @keyframes particleBurst {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            100% {
                transform: scale(0);
                opacity: 0;
            }
        }

        .btn:hover .icon {
            transform: rotate(360deg);
            transition: transform 0.4s ease;
        }

        #my-games::-webkit-scrollbar {
            width: 6px;
        }

        #my-games::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.4);
            border-radius: 3px;
        }

        #my-games::-webkit-scrollbar-thumb {
            background: #ff9800;
            border-radius: 3px;
        }

        #my-games::-webkit-scrollbar-thumb:hover {
            background: #fb8c00;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
                max-width: 90%;
            }

            h1 {
                font-size: 2.4em;
            }

            .btn {
                padding: 10px 20px;
                font-size: 1em;
            }

            .link,
            .game-link {
                font-size: 0.95em;
                padding: 8px;
            }

            .game-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .game-actions {
                width: 100%;
                justify-content: space-between;
            }

            body::after {
                font-size: 100px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 2em;
            }

            .btn {
                padding: 8px 15px;
                font-size: 0.9em;
            }

            .btn-small {
                padding: 5px 10px;
                font-size: 0.8em;
            }

            .button-group {
                flex-direction: column;
                gap: 8px;
            }

            body::after {
                font-size: 80px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1><i class="fas fa-user-ninja icon"></i> Black Ninja</h1>
        <button id="createBtn" class="btn"><i class="fas fa-play icon"></i>Create Game Link</button>

        <div class="new-game">
            <h3>New Game Link</h3>
            <div id="gameLink" class="link"></div>
            <div class="button-group">
                <button id="copyBtn" class="btn btn-secondary">
                    <i class="fas fa-copy icon"></i>Copy Link
                </button>
                <a id="open-game" href="#" class="btn" target="_blank">
                    <i class="fas fa-gamepad icon"></i>Open Game
                </a>
            </div>
        </div>

        <div id="my-games">
            <h3>Previous Games</h3>
            <!-- Dynamically populated -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Store games in memory (simulating a database)
        let games = JSON.parse(localStorage.getItem('blackNinjaGames')) || [];

        document.getElementById('createBtn').addEventListener('click', generateGameLink);
        document.getElementById('copyBtn').addEventListener('click', copyGameLink);

        function generateGameLink(event) {
            const gameId = Math.random().toString(36).substring(2, 18);
            const timestamp = Date.now();
            const gameLink = `${window.location.origin}/game/link=${gameId}-${timestamp.toString().slice(-10)}`;

            // Send to server
            fetch('create_game.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ link: gameLink, timestamp })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Game Created!',
                            text: 'Your game link has been successfully created.',
                            background: '#171c20',
                            color: '#e0e0e0',
                            confirmButtonColor: '#ff9800',
                            confirmButtonText: 'Awesome!',
                            timer: 2000,
                            timerProgressBar: true
                        });

                        // Update UI
                        document.getElementById('gameLink').textContent = gameLink;
                        const openGameBtn = document.getElementById('open-game');
                        openGameBtn.href = gameLink;
                        openGameBtn.classList.add('show');

                        const newGameDiv = document.querySelector('.new-game');
                        newGameDiv.classList.add('show');

                        // Add to games list
                        games.push({ link: gameLink, timestamp });
                        localStorage.setItem('blackNinjaGames', JSON.stringify(games));
                        renderGames();

                        createParticles(event);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to create game link. Please try again.',
                            background: '#171c20',
                            color: '#e0e0e0',
                            confirmButtonColor: '#ff9800'
                        });
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Network error occurred. Please try again.',
                        background: '#171c20',
                        color: '#e0e0e0',
                        confirmButtonColor: '#ff9800'
                    });
                });
        }

        function copyGameLink(event) {
            const gameLink = document.getElementById('gameLink').textContent;
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(gameLink).then(() => {
                    showCopyFeedback(event);
                }).catch(() => {
                    fallbackCopy(gameLink, event);
                });
            } else {
                fallbackCopy(gameLink, event);
            }
        }

        function fallbackCopy(text, event) {
            const textarea = document.createElement('textarea');
            textarea.value = text;
            textarea.style.position = 'fixed';
            textarea.style.opacity = '0';
            document.body.appendChild(textarea);
            textarea.focus();
            textarea.select();
            try {
                document.execCommand('copy');
                showCopyFeedback(event);
            } catch (err) {
                console.error('Fallback copy failed:', err);
            }
            document.body.removeChild(textarea);
        }

        function showCopyFeedback(event) {
            const copyBtn = document.getElementById('copyBtn');
            const originalHtml = copyBtn.innerHTML;
            copyBtn.innerHTML = '<i class="fas fa-check icon"></i>Copied!';
            copyBtn.style.background = 'linear-gradient(45deg, #4caf50, #81c784)';

            setTimeout(() => {
                copyBtn.innerHTML = originalHtml;
                copyBtn.style.background = '';
            }, 2000);

            createParticles(event);
        }

        function createParticles(event) {
            const button = event.currentTarget;
            const rect = button.getBoundingClientRect();
            const x = rect.left + rect.width / 2;
            const y = rect.top + rect.height / 2;

            for (let i = 0; i < 10; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                document.body.appendChild(particle);

                const angle = Math.random() * 360;
                const distance = Math.random() * 50 + 15;
                const xPos = x + Math.cos(angle * Math.PI / 180) * distance;
                const yPos = y + Math.sin(angle * Math.PI / 180) * distance;

                particle.style.left = `${xPos}px`;
                particle.style.top = `${yPos}px`;

                setTimeout(() => particle.remove(), 500);
            }
        }

        function renderGames() {
            const myGames = document.getElementById('my-games');
            myGames.innerHTML = '<h3>Previous Games</h3>';

            games.forEach((game, index) => {
                const gameItem = document.createElement('div');
                gameItem.classList.add('game-item');
                const date = new Date(game.timestamp);
                const formattedTime = date.toLocaleString('en-US', {
                    month: 'short',
                    day: 'numeric',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                });

                gameItem.innerHTML = `
                    <div class="game-info">
                        <a href="${game.link}" class="game-link" target="_blank">${game.link}</a>
                        <div class="game-time">Created: ${formattedTime}</div>
                    </div>
                    <div class="game-actions">
                        <button class="btn btn-small" onclick="viewGame('${game.link}')">
                            <i class="fas fa-eye icon"></i>View
                        </button>
                        <button class="btn btn-danger btn-small" onclick="deleteGame(${index})">
                            <i class="fas fa-trash icon"></i>Delete
                        </button>
                    </div>
                `;
                myGames.appendChild(gameItem);

                setTimeout(() => gameItem.classList.add('show'), index * 150);
            });
        }

        function viewGame(link) {
            window.open(link, '_blank');
            createParticles({ currentTarget: document.querySelector('.game-actions .btn') });
        }

        function deleteGame(index) {
            games.splice(index, 1);
            localStorage.setItem('blackNinjaGames', JSON.stringify(games));
            renderGames();
            createParticles({ currentTarget: document.querySelector('.game-actions .btn-danger') });
        }

        // Initial render
        renderGames();
    </script>
</body>

</html>