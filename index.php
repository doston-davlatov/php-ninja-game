<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Black Ninja</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #0d0d0d, #1a1a2e, #2c2c2c);
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            overflow-x: hidden;
            position: relative;
        }

        /* Animated background particles */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255, 87, 34, 0.15) 10%, transparent 10.1%);
            background-size: 25px 25px;
            opacity: 0.25;
            animation: particleMove 12s linear infinite;
            z-index: -1;
        }

        @keyframes particleMove {
            0% { background-position: 0 0; }
            100% { background-position: 120px 120px; }
        }

        /* Ninja silhouette transition */
        body::after {
            content: '\f6e4';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(10);
            color: rgba(255, 87, 34, 0.1);
            font-size: 100px;
            opacity: 0;
            animation: ninjaFade 10s ease-in-out infinite;
            z-index: -2;
        }

        @keyframes ninjaFade {
            0% { opacity: 0; transform: translate(-50%, -50%) scale(10); }
            50% { opacity: 0.1; transform: translate(-50%, -50%) scale(12); }
            100% { opacity: 0; transform: translate(-50%, -50%) scale(10); }
        }

        .container {
            text-align: center;
            max-width: 700px;
            background: rgba(30, 30, 30, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 
                0 0 20px rgba(0, 0, 0, 0.5),
                0 0 40px rgba(255, 87, 34, 0.4);
            backdrop-filter: blur(10px);
            position: relative;
            z-index: 1;
            animation: fadeIn 1.2s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.85); }
            to { opacity: 1; transform: scale(1); }
        }

        h1 {
            color: #ff5722;
            font-size: 2.8em;
            margin-bottom: 30px;
            text-shadow: 
                2px 2px 0 #000,
                -1px -1px 0 #000,
                1px -1px 0 #000,
                -1px 1px 0 #000;
            animation: glowTitle 2.5s ease-in-out infinite alternate;
        }

        @keyframes glowTitle {
            from { text-shadow: 2px 2px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000; }
            to { text-shadow: 0 0 12px #ff5722, 0 0 24px #ff5722, 0 0 36px #ff5722; }
        }

        .btn {
            background: linear-gradient(45deg, #ff5722, #ff8a50);
            color: #fff;
            border: none;
            padding: 15px 30px;
            font-size: 1.2em;
            font-weight: bold;
            cursor: pointer;
            border-radius: 8px;
            box-shadow: 
                0 4px 10px rgba(0, 0, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
            animation: pulseBtn 3s ease-in-out infinite;
        }

        @keyframes pulseBtn {
            0% { transform: scale(1); }
            50% { transform: scale(1.03); }
            100% { transform: scale(1); }
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 
                0 6px 15px rgba(255, 87, 34, 0.6),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            background: linear-gradient(45deg, #e64a19, #ff7043);
        }

        .btn:active {
            transform: translateY(0);
            box-shadow: 
                0 2px 5px rgba(0, 0, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }

        .btn-secondary {
            background: linear-gradient(45deg, #333, #555);
        }

        .btn-secondary:hover {
            background: linear-gradient(45deg, #444, #666);
            box-shadow: 
                0 6px 15px rgba(0, 0, 0, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .btn-danger {
            background: linear-gradient(45deg, #d32f2f, #f44336);
        }

        .btn-danger:hover {
            background: linear-gradient(45deg, #b71c1c, #d32f2f);
            box-shadow: 
                0 6px 15px rgba(211, 47, 47, 0.6),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .result {
            margin-top: 30px;
            padding: 20px;
            background: rgba(44, 44, 44, 0.9);
            border-radius: 8px;
            display: none;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
            box-shadow: 0 0 15px rgba(76, 175, 80, 0.4);
        }

        .result.show {
            display: block;
            opacity: 1;
            transform: translateY(0);
            animation: glowResult 2s ease-in-out infinite alternate;
        }

        @keyframes glowResult {
            from { box-shadow: 0 0 15px rgba(76, 175, 80, 0.4); }
            to { box-shadow: 0 0 25px rgba(76, 175, 80, 0.6); }
        }

        .link {
            color: #4caf50;
            font-weight: bold;
            font-size: 1.1em;
            word-break: break-all;
            margin: 15px 0;
            padding: 12px;
            background: rgba(26, 26, 26, 0.9);
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(76, 175, 80, 0.3);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: #4caf50;
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease;
        }

        .link:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }

        .link:hover {
            background: rgba(26, 26, 26, 1);
            color: #66bb6a;
        }

        .icon {
            margin-right: 10px;
            font-size: 1.2em;
        }

        .button-group {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
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
            margin-top: 30px;
            padding: 20px;
            background: rgba(44, 44, 44, 0.9);
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(255, 87, 34, 0.4);
            width: 100%;
            max-height: 300px;
            overflow-y: auto;
        }

        .game-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            margin-bottom: 10px;
            background: rgba(26, 26, 26, 0.9);
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(255, 87, 34, 0.3);
            opacity: 0;
            transform: translateX(-20px);
            transition: all 0.5s ease;
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
            font-weight: bold;
            font-size: 1em;
            word-break: break-all;
            margin-bottom: 5px;
            display: block;
        }

        .game-time {
            color: #bbb;
            font-size: 0.9em;
        }

        .game-actions {
            display: flex;
            gap: 10px;
        }

        .btn-small {
            padding: 8px 15px;
            font-size: 0.9em;
        }

        .particle {
            position: absolute;
            width: 12px;
            height: 12px;
            background: #ff5722;
            border-radius: 50%;
            pointer-events: none;
            animation: particleBurst 0.6s ease-out forwards;
        }

        @keyframes particleBurst {
            0% { transform: scale(1); opacity: 1; }
            100% { transform: scale(0); opacity: 0; }
        }

        .btn:hover .icon {
            transform: rotate(360deg);
            transition: transform 0.5s ease;
        }

        /* Scrollbar styling for my-games */
        #my-games::-webkit-scrollbar {
            width: 8px;
        }

        #my-games::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 4px;
        }

        #my-games::-webkit-scrollbar-thumb {
            background: #ff5722;
            border-radius: 4px;
        }

        #my-games::-webkit-scrollbar-thumb:hover {
            background: #e64a19;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
                max-width: 90%;
            }

            h1 {
                font-size: 2.2em;
            }

            .btn {
                padding: 12px 20px;
                font-size: 1em;
            }

            .link, .game-link {
                font-size: 1em;
                padding: 10px;
            }

            .game-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .game-actions {
                width: 100%;
                justify-content: space-between;
            }

            body::after {
                font-size: 80px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 1.8em;
            }

            .btn {
                padding: 10px 15px;
                font-size: 0.9em;
            }

            .btn-small {
                padding: 6px 12px;
                font-size: 0.8em;
            }

            .button-group {
                flex-direction: column;
                gap: 8px;
            }

            body::after {
                font-size: 60px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-user-ninja icon"></i>Black Ninja</h1>
        <button id="createBtn" class="btn"><i class="fas fa-play icon"></i>Create Game Link</button>

        <div id="result" class="result">
            <h3>Your Game Link:</h3>
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
            <!-- Dynamically populated -->
        </div>
    </div>

    <script>
        // Store games in memory (simulating a database)
        let games = JSON.parse(localStorage.getItem('blackNinjaGames')) || [];

        document.getElementById('createBtn').addEventListener('click', generateGameLink);
        document.getElementById('copyBtn').addEventListener('click', copyGameLink);

        function generateGameLink(event) {
            const gameId = Math.random().toString(36).substring(2, 18);
            const timestamp = Date.now();
            const gameLink = `${window.location.origin}/game/link=${gameId}-${timestamp.toString().slice(-10)}`;

            document.getElementById('gameLink').textContent = gameLink;
            const openGameBtn = document.getElementById('open-game');
            openGameBtn.href = gameLink;
            openGameBtn.classList.add('show');

            const resultDiv = document.getElementById('result');
            resultDiv.classList.add('show');

            // Add to games list
            games.push({ link: gameLink, timestamp });
            localStorage.setItem('blackNinjaGames', JSON.stringify(games));
            renderGames();

            createParticles(event);
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
                console.error('Fallback copy failed: ', err);
            }
            document.body.removeChild(textarea);
        }

        function showCopyFeedback(event) {
            const copyBtn = document.getElementById('copyBtn');
            const originalHtml = copyBtn.innerHTML;
            copyBtn.innerHTML = '<i class="fas fa-check icon"></i>Copied!';
            copyBtn.style.background = 'linear-gradient(45deg, #4CAF50, #66BB6A)';

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

            for (let i = 0; i < 12; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                document.body.appendChild(particle);

                const angle = Math.random() * 360;
                const distance = Math.random() * 60 + 20;
                const xPos = x + Math.cos(angle * Math.PI / 180) * distance;
                const yPos = y + Math.sin(angle * Math.PI / 180) * distance;

                particle.style.left = `${xPos}px`;
                particle.style.top = `${yPos}px`;

                setTimeout(() => particle.remove(), 600);
            }
        }

        function renderGames() {
            const myGames = document.getElementById('my-games');
            myGames.innerHTML = '<h3>My Games</h3>';

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
                        <div class="game-time">Started: ${formattedTime}</div>
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

                // Trigger animation with slight delay for each item
                setTimeout(() => gameItem.classList.add('show'), index * 100);
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