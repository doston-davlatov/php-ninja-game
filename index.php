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
            background: linear-gradient(145deg, #1a1f21, #2c3538, #080b0e);
            color: #e0e0e0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 15px;
            overflow-x: hidden;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255, 0, 0, 0.2) 1.5%, transparent 1.6%);
            background-size: 20px 20px;
            opacity: 0.25;
            animation: starPulse 15s linear infinite;
            z-index: -1;
        }

        @keyframes starPulse {
            0% {
                background-position: 0 0;
                opacity: 0.25;
            }

            50% {
                opacity: 0.4;
            }

            100% {
                background-position: 150px 150px;
                opacity: 0.25;
            }
        }

        body::after {
            content: '\f0c4';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(0deg);
            color: rgba(255, 0, 0, 0.15);
            font-size: 100px;
            opacity: 0;
            tangent: animation: shurikenPulse 12s linear infinite;
            z-index: -2;
        }

        @keyframes shurikenPulse {
            0% {
                opacity: 0;
                transform: translate(-50%, -50%) rotate(0deg) scale(1);
            }

            50% {
                opacity: 0.2;
                transform: translate(-50%, -50%) rotate(180deg) scale(1.1);
            }

            100% {
                opacity: 0;
                transform: translate(-50%, -50%) rotate(360deg) scale(1);
            }
        }

        .container {
            max-width: 900px;
            width: 100%;
            background: rgba(10, 14, 17, 0.92);
            padding: 25px;
            border-radius: 15px;
            box-shadow:
                0 0 40px rgba(0, 0, 0, 0.7),
                0 0 60px rgba(255, 0, 0, 0.35);
            backdrop-filter: blur(15px);
            text-align: center;
            animation: slideIn 0.8s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            color: #ff0000;
            font-size: 2.8em;
            margin-bottom: 25px;
            text-shadow:
                0 0 12px rgba(255, 0, 0, 0.9),
                0 0 24px rgba(255, 0, 0, 0.5);
            animation: neonGlow 2.5s ease-in-out infinite alternate;
        }

        @keyframes neonGlow {
            from {
                text-shadow: 0 0 12px rgba(255, 0, 0, 0.9), 0 0 24px rgba(255, 0, 0, 0.5);
            }

            to {
                text-shadow: 0 0 18px rgba(255, 0, 0, 1), 0 0 36px rgba(255, 0, 0, 0.7);
            }
        }

        .btn {
            background: linear-gradient(45deg, #ff0000, #c62828);
            color: #fff;
            border: none;
            padding: 10px 25px;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            border-radius: 8px;
            box-shadow:
                0 5px 15px rgba(0, 0, 0, 0.6),
                inset 0 2px 0 rgba(255, 255, 255, 0.25);
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
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.5), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow:
                0 8px 20px rgba(255, 0, 0, 0.8),
                inset 0 2px 0 rgba(255, 255, 255, 0.3);
            background: linear-gradient(45deg, #e53935, #c62828);
        }

        .btn:active {
            transform: translateY(0);
            box-shadow:
                0 3px 8px rgba(0, 0, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .btn-secondary {
            background: linear-gradient(45deg, #263238, #455a64);
        }

        .btn-secondary:hover {
            background: linear-gradient(45deg, #1e272e, #37474f);
            box-shadow:
                0 8px 20px rgba(69, 90, 100, 0.8),
                inset 0 2px 0 rgba(255, 255, 255, 0.3);
        }

        .btn-danger {
            background: linear-gradient(45deg, #c62828, #e53935);
        }

        .btn-danger:hover {
            background: linear-gradient(45deg, #b71c1c, #d32f2f);
            box-shadow:
                0 8px 20px rgba(198, 40, 40, 0.8),
                inset 0 2px 0 rgba(255, 255, 255, 0.3);
        }

        #my-games {
            margin-top: 25px;
            padding: 20px;
            background: linear-gradient(45deg, rgba(0, 0, 0, 0.9), rgba(40, 40, 40, 0.9));
            border-radius: 12px;
            box-shadow:
                0 0 30px rgba(255, 0, 0, 0.6),
                inset 0 1px 0 rgba(255, 255, 255, 0.15);
            width: 100%;
            max-height: 400px;
            overflow-y: auto;
            animation: fadeInGames 1.2s ease-out;
        }

        @keyframes fadeInGames {
            from {
                opacity: 0;
                transform: scale(0.9);
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
            padding: 15px;
            margin-bottom: 12px;
            background: rgba(15, 15, 15, 0.95);
            border-radius: 10px;
            box-shadow:
                0 5px 20px rgba(255, 0, 0, 0.5),
                0 0 0 2px rgba(255, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
            animation: glowBorder 2s infinite alternate;
        }

        @keyframes glowBorder {
            from {
                box-shadow:
                    0 5px 20px rgba(255, 0, 0, 0.5),
                    0 0 0 2px rgba(255, 0, 0, 0.3);
            }

            to {
                box-shadow:
                    0 5px 25px rgba(255, 0, 0, 0.7),
                    0 0 0 3px rgba(255, 0, 0, 0.5);
            }
        }

        .game-item.show {
            opacity: 1;
            transform: translateY(0);
        }

        .game-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(255, 0, 0, 0.1), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .game-item:hover::before {
            opacity: 1;
        }

        .game-item:hover {
            transform: translateY(-5px);
            box-shadow:
                0 8px 25px rgba(255, 0, 0, 0.8),
                0 0 0 3px rgba(255, 0, 0, 0.6);
        }

        .game-info {
            flex: 1;
            text-align: left;
            padding-right: 15px;
            overflow: hidden;
        }

        .game-link {
            color: #ff5252;
            font-size: 0.95em;
            font-weight: 500;
            word-break: break-word;
            text-decoration: none;
            display: block;
            margin-bottom: 8px;
            transition: color 0.3s ease;
            overflow-wrap: anywhere;
            white-space: normal;
        }

        .game-link:hover {
            color: #ff8a80;
            text-decoration: underline;
        }

        .game-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.85em;
            color: #b0bec5;
            flex-wrap: wrap;
        }

        .game-time {
            background: rgba(255, 255, 255, 0.1);
            padding: 3px 8px;
            border-radius: 5px;
            font-style: italic;
            white-space: nowrap;
        }

        .game-players {
            display: flex;
            align-items: center;
            gap: 5px;
            background: rgba(255, 0, 0, 0.3);
            padding: 3px 10px;
            border-radius: 12px;
            font-weight: 600;
            animation: pulseBadge 1.5s ease-in-out infinite;
            white-space: nowrap;
        }

        @keyframes pulseBadge {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .game-actions {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-shrink: 0;
        }

        .btn-small {
            padding: 7px 14px;
            font-size: 0.9em;
            border-radius: 6px;
            transition: all 0.3s ease;
            min-width: 80px;
            text-align: center;
        }

        .btn-small:hover {
            transform: scale(1.1);
        }

        .particle {
            position: absolute;
            width: 12px;
            height: 12px;
            background: #ff5252;
            border-radius: 50%;
            pointer-events: none;
            animation: particleBurst 0.6s ease-out forwards;
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
            transition: transform 0.5s ease;
        }

        #my-games::-webkit-scrollbar {
            width: 8px;
        }

        #my-games::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.5);
        }

        #my-games::-webkit-scrollbar-thumb {
            background: #ff5252;
            border-radius: 4px;
        }

        #my-games::-webkit-scrollbar-thumb:hover {
            background: #e53935;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
                max-width: 100%;
            }

            h1 {
                font-size: 2.2em;
            }

            .btn {
                padding: 8px 20px;
                font-size: 0.95em;
            }

            .game-item {
                flex-direction: column;
                align-items: stretch;
                padding: 12px;
                margin-bottom: 10px;
            }

            .game-info {
                padding-right: 0;
                margin-bottom: 12px;
            }

            .game-link {
                font-size: 0.9em;
                line-height: 1.4;
            }

            .game-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .game-time,
            .game-players {
                font-size: 0.8em;
                padding: 3px 8px;
            }

            .game-actions {
                width: 100%;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 8px;
            }

            .btn-small {
                flex: 1;
                padding: 6px 10px;
                font-size: 0.85em;
                min-width: 0;
            }

            body::after {
                font-size: 80px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            .container {
                padding: 12px;
            }

            h1 {
                font-size: 1.8em;
                margin-bottom: 20px;
            }

            .btn {
                padding: 7px 15px;
                font-size: 0.9em;
            }

            .game-item {
                padding: 10px;
            }

            .game-link {
                font-size: 0.85em;
                line-height: 1.5;
            }

            .game-time,
            .game-players {
                font-size: 0.75em;
                padding: 2px 6px;
            }

            .btn-small {
                padding: 5px 8px;
                font-size: 0.8em;
            }

            body::after {
                font-size: 60px;
            }
        }

        @media (max-width: 320px) {
            .container {
                padding: 10px;
            }

            h1 {
                font-size: 1.6em;
            }

            .game-link {
                font-size: 0.8em;
            }

            .game-time,
            .game-players {
                font-size: 0.7em;
            }

            .btn-small {
                padding: 4px 6px;
                font-size: 0.75em;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1><i class="fas fa-user-ninja icon"></i> Black Ninja</h1>
        <button id="createBtn" class="btn"><i class="fas fa-play icon"></i>Create Game Link</button>

        <div id="my-games">
            <h3>My Games</h3>
            <!-- Dynamically populated -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const createBtn = document.getElementById('createBtn');
        createBtn.addEventListener('click', generateGameLink);

        function generateGameLink() {
            const gameId = Math.random().toString(36).substring(2, 18);
            const timestamp = Date.now();
            const gameLink = `${window.location.origin}/game/link=${gameId}-${timestamp.toString().slice(-10)}`;

            fetch('game/create.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ link: gameLink })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Game Created!',
                            text: 'Your game link has been successfully created.',
                            background: '#000000',
                            color: '#e0e0e0',
                            confirmButtonColor: '#ff0000',
                            confirmButtonText: 'OK',
                            timer: 2000,
                            timerProgressBar: true
                        });

                        fetchGames();
                        createParticles(createBtn); // ✔️ Muammo hal!
                    } else {
                        showError('Failed to create game link. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    showError('Network error occurred. Please try again.');
                });
        }

        function createParticles(targetElement) {
            if (!targetElement) return; // ❗ Har ehtimolga qarshi tekshiruv

            const rect = targetElement.getBoundingClientRect();
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
                particle.style.position = 'fixed';
                particle.style.width = '6px';
                particle.style.height = '6px';
                particle.style.background = 'red';
                particle.style.borderRadius = '50%';
                particle.style.pointerEvents = 'none';
                particle.style.zIndex = 9999;
                particle.style.transition = 'transform 0.5s ease-out, opacity 0.5s ease-out';

                requestAnimationFrame(() => {
                    particle.style.transform = `translate(${Math.random() * 100 - 50}px, ${Math.random() * 100 - 50}px) scale(0)`;
                    particle.style.opacity = '0';
                });

                setTimeout(() => particle.remove(), 600);
            }
        }

        function showError(message) {
            Swal.fire({
                icon: 'error',
                title: 'Xato!',
                text: message,
                background: '#000000',
                color: '#e0e0e0',
                confirmButtonColor: '#ff0000'
            });
        }

        function fetchGames() {
            fetch('game/get.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        renderGames(data.data);
                    } else {
                        showError('Failed to fetch games.');
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    showError('Network error. Try again later.');
                });
        }

        function renderGames(games) {
            const myGames = document.getElementById('my-games');
            myGames.innerHTML = '<h3>My Games</h3><br>';

            games.forEach((game, index) => {
                const gameItem = document.createElement('div');
                gameItem.classList.add('game-item');

                const date = new Date(game.created_at);
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
                    <div class="game-meta">
                        <span class="game-time"><i class="fas fa-clock icon"></i> ${formattedTime}</span>
                        <span class="game-players"><i class="fas fa-users icon"></i> ${game.player_number} players</span>
                    </div>
                </div>
                <div class="game-actions">
                    <button class="btn btn-secondary btn-small" onclick="copyGameLink('${game.link}', this)">
                        <i class="fas fa-copy icon"></i> Copy
                    </button>
                    <button class="btn btn-small" onclick="viewGame('${game.link}', this)">
                        <i class="fas fa-eye icon"></i> View
                    </button>
                    <button class="btn btn-danger btn-small" onclick="deleteGame(${game.id}, this)">
                        <i class="fas fa-trash icon"></i> Delete
                    </button>
                </div>
            `;

                myGames.appendChild(gameItem);
                setTimeout(() => gameItem.classList.add('show'), index * 200);
            });
        }

        function copyGameLink(link, btn) {
            if (!navigator.clipboard) {
                const textarea = document.createElement('textarea');
                textarea.value = link;
                document.body.appendChild(textarea);
                textarea.select();
                try {
                    document.execCommand('copy');
                    btn.innerHTML = '<i class="fas fa-check icon"></i> Copied!';
                    btn.style.background = 'green';
                } catch (err) {
                    showError('Copy failed.');
                }
                document.body.removeChild(textarea);
                setTimeout(() => {
                    btn.innerHTML = '<i class="fas fa-copy icon"></i> Copy';
                    btn.style.background = '';
                }, 2000);
                createParticles(btn);
                return;
            }

            navigator.clipboard.writeText(link).then(() => {
                btn.innerHTML = '<i class="fas fa-check icon"></i> Copied!';
                btn.style.background = 'green';
                setTimeout(() => {
                    btn.innerHTML = '<i class="fas fa-copy icon"></i> Copy';
                    btn.style.background = '';
                }, 2000);
                createParticles(btn);
            }).catch(err => {
                console.error('Clipboard error:', err);
                showError('Copy failed.');
            });
        }

        function viewGame(link, button) {
            window.open(link, '_blank');
            createParticles(button);
        }

        function deleteGame(id, button) {
            fetch('game/delete.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'Game link removed.',
                            background: '#000000',
                            color: '#e0e0e0',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        fetchGames();
                        createParticles(button);
                    } else {
                        showError('Failed to delete game.');
                    }
                })
                .catch(err => {
                    console.error(err);
                    showError('Network error while deleting.');
                });
        }

        // Load games at startup
        fetchGames();
    </script>
</body>

</html>