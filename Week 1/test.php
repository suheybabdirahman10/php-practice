<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Counter Button</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, #f0f4ff, #dfe9ff);
            font-family: Arial, sans-serif;
        }

        .counter-box {
            background: #ffffff;
            padding: 32px 28px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
            text-align: center;
        }

        h1 {
            font-size: 4rem;
            margin: 0 0 20px;
            color: #1d4ed8;
        }

        .buttons {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        button {
            border: none;
            border-radius: 10px;
            padding: 12px 20px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            color: white;
            background: #2563eb;
            transition: transform 0.15s ease, opacity 0.15s ease;
        }

        button:hover {
            transform: translateY(-1px);
            opacity: 0.95;
        }

        button:nth-child(2) {
            background: #16a34a;
        }

        button:nth-child(3) {
            background: #dc2626;
        }
    </style>
</head>
<body>
    <div class="counter-box">
        <h1 id="count">0</h1>
        <div class="buttons">
            <button id="decreaseBtn">-1</button>
            <button id="increaseBtn">+1</button>
            <button id="resetBtn">Reset</button>
        </div>
    </div>

    <script>
        const countDisplay = document.getElementById('count');
        const increaseBtn = document.getElementById('increaseBtn');
        const decreaseBtn = document.getElementById('decreaseBtn');
        const resetBtn = document.getElementById('resetBtn');

        let count = 0;

        function updateCount() {
            countDisplay.textContent = count;
        }

        increaseBtn.addEventListener('click', () => {
            count += 1;
            updateCount();
        });

        decreaseBtn.addEventListener('click', () => {
            count -= 1;
            updateCount();
        });

        resetBtn.addEventListener('click', () => {
            count = 0;
            updateCount();
        });
    </script>
</body>
</html>