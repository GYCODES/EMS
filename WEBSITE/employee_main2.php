<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2ecc71;
            --background-color: #f5f5f5;
            --text-color: #333;
            --header-color: #2c3e50;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        header {
            background-color: var(--header-color);
            color: white;
            padding: 1em;
            text-align: center;
            position: relative;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        #clock {
            font-size: 2.5em;
            color: var(--primary-color);
            text-align: center;
            padding: 20px;
            border: 2px solid var(--primary-color);
            border-radius: 10px;
            width: 300px;
            margin: 30px auto;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        #controls {
            text-align: center;
            margin-top: 20px;
        }

        .button {
            padding: 0.8em 2em;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            font-size: 1em;
            transition: all 0.3s ease;
            margin: 5px;
        }

        .button-primary {
            background-color: var(--primary-color);
        }

        .button-secondary {
            background-color: var(--secondary-color);
        }

        .button:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        form {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1em;
        }

        .error {
            color: #e74c3c;
            font-size: 0.9em;
            margin-top: 5px;
        }

        ul {
            list-style-type: none;
        }

        ul li {
            background: white;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .profile-info {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table th {
            background-color: #f2f2f2;
            text-align: left;
        }

        /* Hamburger Menu Styles */
        .menu-btn {
            background: var(--header-color);
            border: none;
            color: white;
            padding: 15px;
            font-size: 20px;
            cursor: pointer;
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 1000;
            transition: opacity 0.3s;
        }

        .menu {
            display: none;
            position: fixed;
            top: 0;
            right: 0;
            background: var(--header-color);
            color: white;
            width: 250px;
            height: 100%;
            padding: 20px;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.5);
            z-index: 999;
            padding-top: 60px;/
        }

        .menu a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 0;
            font-size: 18px;
            margin-bottom: 10px; 
        }

        .menu a:hover {
            background: #575757;
        }

        .menu.open {
            display: block;
        }

        .menu-close {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 30px;
            cursor: pointer;
        }

        .content {
            display: none;
        }

        .active {
            display: block;
        }

        .confirmation {
            color: green;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }

        .reminder {
            color: #D30433;
            font-size: 0.9em;
            line-height: 35px;
        }
    </style>
</head>
<body>
    <header>
        <button class="menu-btn" id="menu-btn">&#9776;</button>
        <h1>Employee Management System</h1>
    </header>
    <div class="menu" id="menu">
        <span class="menu-close" id="menu-close">&times;</span>
        <a href="#home" id="home-link">Home</a>
        <a href="#leave-history" id="leave-history-link">Leave History</a>
        <a href="#feedback-history" id="feedback-history-link">Feedback History</a>
    </div>

    <div class="container">
        <div id="home" class="content active">
            <div id="clock">Loading...</div>
            <div id="controls">
                <button id="toggleFormat" class="button button-primary">Toggle Format</button>
                <button id="setAlarm" class="button button-secondary">Set Alarm</button>
            </div>
            <audio id="alarmSound" src="clock-alarm-8761.mp3" preload="auto"></audio>

            <div id="profile-section">
                <h2>Profile Information</h2>
                <div class="profile-info">
                    <div class="form-group">
                        <label for="profile-name">Name</label>
                        <input type="text" id="profile-name" disabled>
                    </div>
                    <div class="form-group">
                        <label for="profile-email">Email</label>
                        <input type="email" id="profile-email" disabled>
                        <div id="profile-email-error" class="error"></div>
                    </div>
                    <button id="edit-profile-btn" class="button button-primary">Edit Profile</button>
                </div>
            </div>

            <div>
                <h2>Clock In/Out</h2>
                <button id="clock-in-btn" class="button button-primary">Clock In</button>
                <button id="clock-out-btn" class="button button-secondary">Clock Out</button>
                <div id="clock-reminder" class="reminder"></div>
                <h3>Clock In/Out History</h3>
                <table class="table" id="clock-history">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Action</th>
                            <th>Time</th>
                        </tr >
                    </thead>
                    <tbody id="clock-history-list"></tbody>
                </table>
            </div>

            <div>
    <h2>Leave Request</h2>
    <form id="leave-form">
        <div class="form-group">
            <label for="leave-dates">Dates (yyyy/mm/dd to yyyy/mm/dd)</label>
            <input type="text" id="leave-dates">
            <div id="leave-dates-error" class="error"></div>
        </div>
        <div class="form-group">
            <label for="leave-reason">Reason</label>
            <input type="text" id="leave-reason">
            <div id="leave-reason-error" class="error"></div>
        </div>
        <button type="submit" class="button button-primary">Submit Leave Request</button>
    </form>
    <div id="leave-confirmation" class="confirmation"></div>
</div>

            <div>
                <h2>Feedback</h2>
                <form id="feedback-form">
                    <div class="form-group">
                        <label for="feedback">Your Feedback</label>
                        <textarea id="feedback"></textarea>
                        <div id="feedback-error" class="error"></div>
                    </div>
                    <button type="submit" class="button button-primary">Submit Feedback</button>
                </form>
                <div id="feedback-confirmation" class="confirmation"></div>
            </div>
        </div>

        <div id="leave-history" class="content">
            <h2>Leave History</h2>
            <ul id="leave-history-list"></ul>
            <button class="button button-secondary" id="back-to-home">Back to Home</button>
        </div>

        <div id="feedback-history" class="content">
            <h2>Feedback History</h2>
            <ul id="feedback-history-list"></ul>
            <button class="button button-secondary" id="back-to-home-feedback">Back to Home</button>
        </div>
    </div>

    <script>
        // Clock functionality
        let is24HourFormat = true;
        let alarmTime = null;

        function updateClock() {
            const clock = document.getElementById('clock');
            const now = new Date();
            let hours = now.getHours();
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');
            let ampm = '';

            if (!is24HourFormat) {
                ampm = hours >= 12 ? ' PM' : ' AM';
                hours = hours % 12;
                hours = hours ? hours : 12; 
            }

            hours = hours.toString().padStart(2, '0');
            clock.textContent = `${hours}:${minutes}:${seconds}${ampm}`;

            if (alarmTime && now.getHours() === alarmTime.hours && now.getMinutes() === alarmTime.minutes && now.getSeconds() === 0) {
                alert('Alarm ringing!');
                alarmTime = null; // alarm 响
            }
        }

        function toggleFormat() {
            is24HourFormat = !is24HourFormat;
            updateClock(); // 更新时钟
        }

        function setAlarm() {
            const alarmHours = prompt('Enter alarm hour (0-23):');
            const alarmMinutes = prompt('Enter alarm minutes (0-59):');

            if (alarmHours !== null && alarmMinutes !== null) {
                alarmTime = {
                    hours: parseInt(alarmHours, 10),
                    minutes: parseInt(alarmMinutes, 10)
                };
                alert(`Alarm set for ${alarmTime.hours}:${alarmTime.minutes.toString().padStart(2, '0')}`);
            }
        }

        document.getElementById('toggleFormat').addEventListener('click', toggleFormat);
        document.getElementById('setAlarm').addEventListener('click', setAlarm);

        setInterval(updateClock, 1000);
        updateClock();

        // Clock In/Out function
        const clockInBtn = document.getElementById('clock-in-btn');
        const clockOutBtn = document.getElementById('clock-out-btn');
        const clockHistoryList = document.getElementById('clock-history-list');
        const clockReminder = document.getElementById('clock-reminder');
        let clockInDone = false;
        let clockOutDone = false;
        const clockInOutHistory = [];

        clockInBtn.addEventListener('click', function() {
            if (clockInDone) {
                alert('You have already clocked in.');
                return;
            }
            clockInDone = true;
            clockOutDone = false;
            const now = new Date();
            clockInOutHistory.push({ action: 'Clock In', time: now.toLocaleTimeString(), date: now.toLocaleDateString() });
            renderClockHistory();
            alert('Clocked in');
 });

        clockOutBtn.addEventListener('click', function() {
            if (!clockInDone) {
                alert('You must clock in first.');
                return;
            }
            if (clockOutDone) {
                alert('You have already clocked out.');
                return;
            }
            clockOutDone = true;
            const now = new Date();
            clockInOutHistory.push({ action: 'Clock Out', time: now.toLocaleTimeString(), date: now.toLocaleDateString() });
            renderClockHistory();
            alert('Clocked out');
        });

        function renderClockHistory() {
            clockHistoryList.innerHTML = '';
            clockInOutHistory.forEach(entry => {
                clockHistoryList.innerHTML += `
                    <tr>
                        <td>${entry.date}</td>
                        <td>${entry.action}</td>
                        <td>${entry.time}</td>
                    </tr>
                `;
            });
        }

        // Leave request form 
        const leaveForm = document.getElementById('leave-form');
        const leaveDatesInput = document.getElementById('leave-dates');
        const leaveReasonInput = document.getElementById('leave-reason');
        const leaveDatesError = document.getElementById('leave-dates-error');
        const leaveReasonError = document.getElementById('leave-reason-error');
        const leaveHistoryList = document.getElementById('leave-history-list');
        const leaveMessage = document.getElementById('leave-message');

        leaveForm.addEventListener('submit', function(event) {
    event.preventDefault();
    const leaveDates = leaveDatesInput.value.trim();
    const leaveReason = leaveReasonInput.value.trim();
    leaveDatesError.textContent = '';
    leaveReasonError.textContent = '';

    const leaveDatePattern = /^(\d{4})\/(\d{2})\/(\d{2}) to (\d{4})\/(\d{2})\/(\d{2})$/;
    const match = leaveDates.match(leaveDatePattern);

    if (!match) {
        leaveDatesError.textContent = 'Dates must follow the yyyy/mm/dd to yyyy/mm/dd format.';
        return;
    }

    const [_, startYear, startMonth, startDay, endYear, endMonth, endDay] = match;
    const startDate = new Date(startYear, startMonth - 1, startDay);
    const endDate = new Date(endYear, endMonth - 1, endDay);
    const now = new Date();

    if (startDate > endDate || startDate < now || endDate.getMonth() > 11) {
        leaveDatesError.textContent = 'Invalid dates. Ensure dates are within valid months and days.';
        return;
    }

    if (!leaveReason) {
        leaveReasonError.textContent = 'Please enter a reason for your leave request.';
        return;
    }

    leaveHistoryList.innerHTML += `<li>${leaveDates} - ${leaveReason}</li>`;
    leaveDatesInput.value = '';
    leaveReasonInput.value = '';

    leaveMessage.textContent = 'You have submitted your leave request';
    setTimeout(() => leaveMessage.textContent = '', 3000);
});

        const feedbackForm = document.getElementById('feedback-form');
        const feedbackInput = document.getElementById('feedback');
        const feedbackError = document.getElementById('feedback-error');
        const feedbackHistoryList = document.getElementById('feedback-history-list');
        const feedbackMessage = document.getElementById('feedback-message');
        let feedbackCount = 0;

        feedbackForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const feedback = feedbackInput.value.trim();
            feedbackError.textContent = '';

            if (!feedback) {
                feedbackError.textContent = 'Please enter your feedback.';
                return;
            }

            const currentDate = new Date().toLocaleDateString();
            feedbackCount = feedbackHistoryList.querySelectorAll(`li[data-date="${currentDate}"]`).length;

            if (feedbackCount >= 2) {
                feedbackError.textContent = 'You can only submit 2 feedbacks per day.';
                return;
            }

            feedbackHistoryList.innerHTML += `<li data-date="${currentDate}">${feedback}</li>`;
            feedbackInput.value = '';

            feedbackMessage.textContent = 'You have submitted your feedback';
            setTimeout(() => feedbackMessage.textContent = '', 1000);
        });

        // Profile validation
        const profileName = document.getElementById('profile-name');
        const profileEmail = document.getElementById('profile-email');
        const profileEmailError = document.getElementById('profile-email-error');
        const editProfileBtn = document.getElementById('edit-profile-btn');

        editProfileBtn.addEventListener('click', function() {
            profileName.disabled = false;
            profileName.focus();
            profileEmail.disabled = false;
            profileEmail.focus();
        });

        profileEmail.addEventListener('blur', function() {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(profileEmail.value)) {
                profileEmailError.textContent = 'Please enter a valid email address.';
            } else {
                profileEmailError.textContent = '';
                profileEmail.disabled = true;
            }
        });

        //提醒 clock in
        const clockReminderMessage = "Please remember to clock in for your shift.";
        if (!clockInDone) {
            clockReminder.textContent = clockReminderMessage;
        }

        //提醒
        function clearClockReminder() {
            clockReminder.textContent = '';
        }

        clockInBtn.addEventListener('click', clearClockReminder);

        // Hamburger Menu function
        const menuBtn = document.getElementById('menu-btn');
        const menu = document.getElementById('menu');
        const menuClose = document.getElementById('menu-close');
        const homeLink = document.getElementById('home-link');
        const leaveHistoryLink = document.getElementById('leave-history-link');
        const feedbackHistoryLink = document.getElementById('feedback-history-link');
        const backToHome = document.getElementById('back-to-home');
        const backToHomeFeedback = document.getElementById('back-to-home-feedback');

        menuBtn.addEventListener('click', function() {
            menu.classList.toggle('open');
            menuBtn.style.display = 'none'; // 隐藏秘制小汉堡
        });

        menuClose.addEventListener('click', function() {
            menu.classList.remove('open');
            menuBtn.style.display = 'block'; // 显示秘制小汉堡
        });

        homeLink.addEventListener('click', function() {
            document.querySelectorAll('.content').forEach(content => content.classList.remove('active'));
            document.getElementById('home').classList.add('active');
            menu.classList.remove('open'); // 关
            menuBtn.style.display = 'block';
        });

        leaveHistoryLink.addEventListener('click', function() {
            document.querySelectorAll('.content').forEach(content => content.classList.remove('active'));
            document.getElementById('leave-history').classList.add('active');
            menu.classList.remove('open'); // 关
            menuBtn.style.display = 'block';
        });

        feedbackHistoryLink.addEventListener('click', function() {
            document.querySelectorAll('.content').forEach(content => content.classList.remove('active'));
            document.getElementById('feedback-history').classList.add ('active');
            menu.classList.remove('open'); // 关
            menuBtn.style.display = 'block';
        });

        backToHome.addEventListener('click', function() {
            document.querySelectorAll('.content').forEach(content => content.classList.remove('active'));
            document.getElementById('home').classList.add('active');
            menu.classList.remove('open'); // 关
            menuBtn.style.display = 'block';
        });

        backToHomeFeedback.addEventListener('click', function() {
            document.querySelectorAll('.content').forEach(content => content.classList.remove('active'));
            document.getElementById('home').classList.add('active');
            menu.classList.remove('open'); // 关
            menuBtn.style.display = 'block';
        });
    </script>
</body>
</html>