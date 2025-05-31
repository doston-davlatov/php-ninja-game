<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Black Ninja</title>
</head>

<body>
  <div class="container">
    <div id="score"></div>
    <canvas id="game" width="375" height="375"></canvas>
    <div id="introduction">Tayoqni cho'zish uchun sichqonchani bosib turing</div>
    <div id="perfect">Ajoyib</div>
    <button id="restart">RESTART</button>
  </div>

  <script>
    Array.prototype.last = function () {
      return this[this.length - 1];
    };

    // Radian o'rniga darajalarni qabul qiluvchi sinus funksiyasi
    Math.sinus = function (degree) {
      return Math.sin((degree / 180) * Math.PI);
    };

    // O'yin ma'lumotlari
    let phase = "waiting"; // kutish | cho'zish | burilish | yurish | o'tish | tushish
    let lastTimestamp; // Oldingi requestAnimationFrame siklining vaqt tamg'asi

    let heroX; // Oldinga siljishda o'zgarishlar
    let heroY; // Faqat yiqilganda o'zgaradi
    let sceneOffset; // Butun o'yinni siljitadi

    let platforms = [];
    let sticks = [];
    let trees = [];

    // Todo: yuqori ballni localStorage-ga saqlang (?)
    let score = 0;

    // Konfiguratsiya
    const canvasWidth = 375;
    const canvasHeight = 375;
    const platformHeight = 100;
    const heroDistanceFromEdge = 10; // kutayotganda
    const paddingX = 100; // Asl tuval o'lchamidan qahramonning kutish holati
    const perfectAreaSize = 10;

    // Fon qahramonga qaraganda sekinroq harakat qiladi
    const backgroundSpeedMultiplier = 0.2;

    const hill1BaseHeight = 100;
    const hill1Amplitude = 10;
    const hill1Stretch = 1;
    const hill2BaseHeight = 70;
    const hill2Amplitude = 20;
    const hill2Stretch = 0.5;

    const stretchingSpeed = 4; // Pikselni chizish uchun millisekundlar ketadi
    const turningSpeed = 4; // Darajani o'zgartirish uchun millisekundlar kerak bo'ladi
    const walkingSpeed = 4;
    const transitioningSpeed = 2;
    const fallingSpeed = 2;

    const heroWidth = 17; // 24
    const heroHeight = 30; // 40

    const canvas = document.getElementById("game");
    canvas.width = window.innerWidth; // Canvasni to'liq ekranga aylantiring
    canvas.height = window.innerHeight;

    const ctx = canvas.getContext("2d");

    const introductionElement = document.getElementById("introduction");
    const perfectElement = document.getElementById("perfect");
    const restartButton = document.getElementById("restart");
    const scoreElement = document.getElementById("score");

    // Tartibni ishga tushirish
    resetGame();

    // O'yin o'zgaruvchilari va tartiblarini tiklaydi, lekin o'yinni boshlamaydi (o'yin tugmachani bosgandan keyin boshlanadi)
    function resetGame() {
  // O'yin jarayonini tiklash
      phase = "waiting";
      lastTimestamp = undefined;
      sceneOffset = 0;
      score = 0;

      introductionElement.style.opacity = 1;
      perfectElement.style.opacity = 0;
      restartButton.style.display = "none";
      scoreElement.innerText = score;

      // Birinchi platforma har doim bir xil
      // x + w paddingX ga mos kelishi kerak
      platforms = [{ x: 50, w: 50 }];
      generatePlatform();
      generatePlatform();
      generatePlatform();
      generatePlatform();

      sticks = [{ x: platforms[0].x + platforms[0].w, length: 0, rotation: 0 }];

      trees = [];
      generateTree();
      generateTree();
      generateTree();
      generateTree();
      generateTree();
      generateTree();
      generateTree();
      generateTree();
      generateTree();
      generateTree();

      heroX = platforms[0].x + platforms[0].w - heroDistanceFromEdge;
      heroY = 0;

      draw();
    }

    function generateTree() {
      const minimumGap = 30;
      const maximumGap = 150;

      // Eng uzoq daraxtning o'ng chetining X koordinatasi
      const lastTree = trees[trees.length - 1];
      let furthestX = lastTree ? lastTree.x : 0;

      const x =
        furthestX +
        minimumGap +
        Math.floor(Math.random() * (maximumGap - minimumGap));

      const treeColors = ["#6D8821", "#8FAC34", "#98B333"];
      const color = treeColors[Math.floor(Math.random() * 3)];

      trees.push({ x, color });
    }

    function generatePlatform() {
      const minimumGap = 40;
      const maximumGap = 200;
      const minimumWidth = 20;
      const maximumWidth = 100;

     // Eng uzoq platformaning o'ng chetining X koordinatasi
      const lastPlatform = platforms[platforms.length - 1];
      let furthestX = lastPlatform.x + lastPlatform.w;

      const x =
        furthestX +
        minimumGap +
        Math.floor(Math.random() * (maximumGap - minimumGap));
      const w =
        minimumWidth + Math.floor(Math.random() * (maximumWidth - minimumWidth));

      platforms.push({ x, w });
    }

    resetGame();

// Agar bo'sh joy bosilsa, o'yinni qaytadan boshlang
    window.addEventListener("keydown", function (event) {
      if (event.key == " ") {
        event.preventDefault();
        resetGame();
        return;
      }
    });

    window.addEventListener("mousedown", function (event) {
      if (phase == "waiting") {
        lastTimestamp = undefined;
        introductionElement.style.opacity = 0;
        phase = "stretching";
        window.requestAnimationFrame(animate);
      }
    });

    window.addEventListener("mouseup", function (event) {
      if (phase == "stretching") {
        phase = "turning";
      }
    });

    window.addEventListener("resize", function (event) {
      canvas.width = window.innerWidth;
      canvas.height = window.innerHeight;
      draw();
    });

    // Barmoq bosilganda (touch start)
window.addEventListener("touchstart", function (event) {
  if (phase == "waiting") {
    lastTimestamp = undefined;
    introductionElement.style.opacity = 0;
    phase = "stretching";
    window.requestAnimationFrame(animate);
  }
});

// Barmoq ko‘tarilganda (touch end)
window.addEventListener("touchend", function (event) {
  if (phase == "stretching") {
    phase = "turning";
  }
});


    window.requestAnimationFrame(animate);

    // Asosiy o'yin tsikli
    function animate(timestamp) {
      if (!lastTimestamp) {
        lastTimestamp = timestamp;
        window.requestAnimationFrame(animate);
        return;
      }

      switch (phase) {
        case "waiting":
          return; // Loopni to'xtating
        case "stretching": {
          sticks.last().length += (timestamp - lastTimestamp) / stretchingSpeed;
          break;
        }
        case "turning": {
          sticks.last().rotation += (timestamp - lastTimestamp) / turningSpeed;

          if (sticks.last().rotation > 90) {
            sticks.last().rotation = 90;

            const [nextPlatform, perfectHit] = thePlatformTheStickHits();
            if (nextPlatform) {
              // Ballarni oshirish
              score += perfectHit ? 2 : 1;
              scoreElement.innerText = score;

              if (perfectHit) {
                perfectElement.style.opacity = 1;
                setTimeout(() => (perfectElement.style.opacity = 0), 1000);
              }

              generatePlatform();
              generateTree();
              generateTree();
            }

            phase = "walking";
          }
          break;
        }
        case "walking": {
          heroX += (timestamp - lastTimestamp) / walkingSpeed;

          const [nextPlatform] = thePlatformTheStickHits();
          if (nextPlatform) {
            // Agar qahramon boshqa platformaga chiqsa, uning chetidagi o'rnini cheklang
            const maxHeroX = nextPlatform.x + nextPlatform.w - heroDistanceFromEdge;
            if (heroX > maxHeroX) {
              heroX = maxHeroX;
              phase = "transitioning";
            }
          } else {
            // Agar qahramon boshqa platformaga chiqmasa, uning qutb oxiridagi pozitsiyasini cheklang
            const maxHeroX = sticks.last().x + sticks.last().length + heroWidth;
            if (heroX > maxHeroX) {
              heroX = maxHeroX;
              phase = "falling";
            }
          }
          break;
        }
        case "transitioning": {
          sceneOffset += (timestamp - lastTimestamp) / transitioningSpeed;

          const [nextPlatform] = thePlatformTheStickHits();
          if (sceneOffset > nextPlatform.x + nextPlatform.w - paddingX) {
            // Keyingi qadamni qo'shing
            sticks.push({
              x: nextPlatform.x + nextPlatform.w,
              length: 0,
              rotation: 0
            });
            phase = "waiting";
          }
          break;
        }
        case "falling": {
          if (sticks.last().rotation < 180)
            sticks.last().rotation += (timestamp - lastTimestamp) / turningSpeed;

          heroY += (timestamp - lastTimestamp) / fallingSpeed;
          const maxHeroY =
            platformHeight + 100 + (window.innerHeight - canvasHeight) / 2;
          if (heroY > maxHeroY) {
            restartButton.style.display = "block";
            return;
          }
          break;
        }
        default:
          throw Error("Wrong phase");
      }

      draw();
      window.requestAnimationFrame(animate);

      lastTimestamp = timestamp;
    }

    // tayoq urilgan platformani qaytaradi (agar u hech qanday tayoqqa tegmagan bo'lsa, aniqlanmagan holda qaytaring)
    function thePlatformTheStickHits() {
      if (sticks.last().rotation != 90)
        throw Error(`Stick is ${sticks.last().rotation}°`);
      const stickFarX = sticks.last().x + sticks.last().length;

      const platformTheStickHits = platforms.find(
        (platform) => platform.x < stickFarX && stickFarX < platform.x + platform.w
      );

      // Agar tayoq mukammal maydonga tegsa
      if (
        platformTheStickHits &&
        platformTheStickHits.x + platformTheStickHits.w / 2 - perfectAreaSize / 2 <
        stickFarX &&
        stickFarX <
        platformTheStickHits.x + platformTheStickHits.w / 2 + perfectAreaSize / 2
      )
        return [platformTheStickHits, true];

      return [platformTheStickHits, false];
    }

    function draw() {
      ctx.save();
      ctx.clearRect(0, 0, window.innerWidth, window.innerHeight);

      drawBackground();

      // Asosiy canvas maydonini ekranning o'rtasiga o'tkazing
      ctx.translate(
        (window.innerWidth - canvasWidth) / 2 - sceneOffset,
        (window.innerHeight - canvasHeight) / 2
      );

      // Sahna chizish
      drawPlatforms();
      drawHero();
      drawSticks();

      // Transformatsiyani tiklash
      ctx.restore();
    }

    restartButton.addEventListener("click", function (event) {
      event.preventDefault();
      resetGame();
      restartButton.style.display = "none";
    });

    function drawPlatforms() {
      platforms.forEach(({ x, w }) => {
        // Chizma platformasi
        ctx.fillStyle = "black";
        ctx.fillRect(
          x,
          canvasHeight - platformHeight,
          w,
          platformHeight + (window.innerHeight - canvasHeight) / 2
        );

        // Qahramon hali platformaga etib bormagan taqdirdagina mukammal maydonni chizing
        if (sticks.last().x < x) {
          ctx.fillStyle = "red";
          ctx.fillRect(
            x + w / 2 - perfectAreaSize / 2,
            canvasHeight - platformHeight,
            perfectAreaSize,
            perfectAreaSize
          );
        }
      });
    }

    function drawHero() {
      ctx.save();
      ctx.fillStyle = "black";
      ctx.translate(
        heroX - heroWidth / 2,
        heroY + canvasHeight - platformHeight - heroHeight / 2
      );

      // Body
      drawRoundedRect(
        -heroWidth / 2,
        -heroHeight / 2,
        heroWidth,
        heroHeight - 4,
        5
      );

      // Legs
      const legDistance = 5;
      ctx.beginPath();
      ctx.arc(legDistance, 11.5, 3, 0, Math.PI * 2, false);
      ctx.fill();
      ctx.beginPath();
      ctx.arc(-legDistance, 11.5, 3, 0, Math.PI * 2, false);
      ctx.fill();

      // Eye
      ctx.beginPath();
      ctx.fillStyle = "white";
      ctx.arc(5, -7, 3, 0, Math.PI * 2, false);
      ctx.fill();

      // Band
      ctx.fillStyle = "red";
      ctx.fillRect(-heroWidth / 2 - 1, -12, heroWidth + 2, 4.5);
      ctx.beginPath();
      ctx.moveTo(-9, -14.5);
      ctx.lineTo(-17, -18.5);
      ctx.lineTo(-14, -8.5);
      ctx.fill();
      ctx.beginPath();
      ctx.moveTo(-10, -10.5);
      ctx.lineTo(-15, -3.5);
      ctx.lineTo(-5, -7);
      ctx.fill();

      ctx.restore();
    }

    function drawRoundedRect(x, y, width, height, radius) {
      ctx.beginPath();
      ctx.moveTo(x, y + radius);
      ctx.lineTo(x, y + height - radius);
      ctx.arcTo(x, y + height, x + radius, y + height, radius);
      ctx.lineTo(x + width - radius, y + height);
      ctx.arcTo(x + width, y + height, x + width, y + height - radius, radius);
      ctx.lineTo(x + width, y + radius);
      ctx.arcTo(x + width, y, x + width - radius, y, radius);
      ctx.lineTo(x + radius, y);
      ctx.arcTo(x, y, x, y + radius, radius);
      ctx.fill();
    }

    function drawSticks() {
      sticks.forEach((stick) => {
        ctx.save();

        // Anchor nuqtasini tayoqning boshiga o'tkazing va aylantiring
        ctx.translate(stick.x, canvasHeight - platformHeight);
        ctx.rotate((Math.PI / 180) * stick.rotation);

        // Tayoq chizish
        ctx.beginPath();
        ctx.lineWidth = 2;
        ctx.moveTo(0, 0);
        ctx.lineTo(0, -stick.length);
        ctx.stroke();

        // Transformatsiyalarni tiklash
        ctx.restore();
      });
    }

    function drawBackground() {
      // Osmonni chizish
      var gradient = ctx.createLinearGradient(0, 0, 0, window.innerHeight);
      gradient.addColorStop(0, "#BBD691");
      gradient.addColorStop(1, "#FEF1E1");
      ctx.fillStyle = gradient;
      ctx.fillRect(0, 0, window.innerWidth, window.innerHeight);

      // Tog'larni chizish
      drawHill(hill1BaseHeight, hill1Amplitude, hill1Stretch, "#95C629");
      drawHill(hill2BaseHeight, hill2Amplitude, hill2Stretch, "#659F1C");

      // Daraxtlarni chizish
      trees.forEach((tree) => drawTree(tree.x, tree.color));
    }

    // Tepalik - cho'zilgan sinus to'lqini ostidagi shakl
    function drawHill(baseHeight, amplitude, stretch, color) {
      ctx.beginPath();
      ctx.moveTo(0, window.innerHeight);
      ctx.lineTo(0, getHillY(0, baseHeight, amplitude, stretch));
      for (let i = 0; i < window.innerWidth; i++) {
        ctx.lineTo(i, getHillY(i, baseHeight, amplitude, stretch));
      }
      ctx.lineTo(window.innerWidth, window.innerHeight);
      ctx.fillStyle = color;
      ctx.fill();
    }

    function drawTree(x, color) {
      ctx.save();
      ctx.translate(
        (-sceneOffset * backgroundSpeedMultiplier + x) * hill1Stretch,
        getTreeY(x, hill1BaseHeight, hill1Amplitude)
      );

      const treeTrunkHeight = 5;
      const treeTrunkWidth = 2;
      const treeCrownHeight = 25;
      const treeCrownWidth = 10;

      // Magistral chizish
      ctx.fillStyle = "#7D833C";
      ctx.fillRect(
        -treeTrunkWidth / 2,
        -treeTrunkHeight,
        treeTrunkWidth,
        treeTrunkHeight
      );

      // Tojni chizish
      ctx.beginPath();
      ctx.moveTo(-treeCrownWidth / 2, -treeTrunkHeight);
      ctx.lineTo(0, -(treeTrunkHeight + treeCrownHeight));
      ctx.lineTo(treeCrownWidth / 2, -treeTrunkHeight);
      ctx.fillStyle = color;
      ctx.fill();

      ctx.restore();
    }

    function getHillY(windowX, baseHeight, amplitude, stretch) {
      const sineBaseY = window.innerHeight - baseHeight;
      return (
        Math.sinus((sceneOffset * backgroundSpeedMultiplier + windowX) * stretch) *
        amplitude +
        sineBaseY
      );
    }

    function getTreeY(x, baseHeight, amplitude) {
      const sineBaseY = window.innerHeight - baseHeight;
      return Math.sinus(x) * amplitude + sineBaseY;
    }
  </script>
</body>

</html>