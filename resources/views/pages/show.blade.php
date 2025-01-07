<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        header {
            background: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
        .calendar {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .calendar-controls {
            margin-bottom: 20px;
        }
        .calendar-controls select, .calendar-controls button {
            padding: 10px;
            margin: 0 10px;
            font-size: 16px;
        }
        .calendar-table {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            grid-gap: 10px;
            text-align: center;
            font-size: 18px;
        }
        .calendar-table div {
            padding: 15px;
            background-color: #f4f4f4;
            border-radius: 5px;
        }
        .calendar-table .day-name {
            font-weight: bold;
            background-color: #333;
            color: #fff;
        }
        .calendar-table .day {
            cursor: pointer;
        }
        .calendar-table .day:hover {
            background-color: #ddd;
        }
        .calendar-table .empty {
            background-color: transparent;
        }
    </style>
</head>
<body>

    <header>
        <h1>Schedule Kegiatan King Foto</h1>
    </header>

    <div class="container">
        <div class="calendar">
            <div class="calendar-controls">
                <select id="month-select">
                    <option value="0">Januari</option>
                    <option value="1">Februari</option>
                    <option value="2">Maret</option>
                    <option value="3">April</option>
                    <option value="4">Mei</option>
                    <option value="5">Juni</option>
                    <option value="6">Juli</option>
                    <option value="7">Agustus</option>
                    <option value="8">September</option>
                    <option value="9">Oktober</option>
                    <option value="10">November</option>
                    <option value="11">Desember</option>
                </select>
                <input type="number" id="year-input" value="2025" min="1900" max="2100" />
                <button onclick="generateCalendar()">Tampilkan</button>
            </div>

            <div class="calendar-table" id="calendar-table">
                <!-- Calendar will be generated here -->
            </div>
        </div>
    </div>

    <script>
        function generateCalendar() {
            const month = document.getElementById('month-select').value;
            const year = document.getElementById('year-input').value;

            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, parseInt(month) + 1, 0);

            const firstDayOfWeek = firstDay.getDay();
            const lastDate = lastDay.getDate();

            const daysInWeek = 7;
            const totalCells = Math.ceil((firstDayOfWeek + lastDate) / daysInWeek) * daysInWeek;

            const calendarTable = document.getElementById('calendar-table');
            calendarTable.innerHTML = '';

            const dayNames = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            dayNames.forEach(day => {
                const dayCell = document.createElement('div');
                dayCell.classList.add('day-name');
                dayCell.textContent = day;
                calendarTable.appendChild(dayCell);
            });

            let day = 1;
            for (let i = 0; i < totalCells; i++) {
                const cell = document.createElement('div');
                if (i >= firstDayOfWeek && day <= lastDate) {
                    cell.classList.add('day');
                    cell.textContent = day;
                    day++;
                } else {
                    cell.classList.add('empty');
                }
                calendarTable.appendChild(cell);
            }
        }

        window.onload = generateCalendar;
    </script>

</body>
</html>
