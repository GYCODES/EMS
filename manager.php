<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard - Employee Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2ecc71;
            --background-color: #f5f5f5;
            --text-color: #333;
            --header-color: #2c3e50;
            --danger-color: #e74c3c;
            --warning-color: #f39c12;
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

        .button-danger {
            background-color: var(--danger-color);
        }

        .button-warning {
            background-color: var(--warning-color);
        }

        .button:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

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
            padding-top: 60px;
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
                .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
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
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1em;
        }

        .error {
            color: var(--danger-color);
            font-size: 0.9em;
            margin-top: 5px;
        }

        .success {
            color: var(--secondary-color);
            font-size: 0.9em;
            margin-top: 5px;
        }

        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .flex-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .flex-item {
            flex-basis: 48%;
        }

        @media (max-width: 768px) {
            .flex-item {
                flex-basis: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <button class="menu-btn" id="menu-btn">&#9776;</button>
        <h1>Manager Dashboard</h1>
    </header>

    <div class="menu" id="menu">
        <span class="menu-close" id="menu-close">&times;</span>
        <a href="#dashboard" id="dashboard-link">Dashboard</a>
        <a href="#employee-management" id="employee-management-link">Employee Management</a>
        <a href="#leave-requests" id="leave-requests-link">Leave Requests</a>
        <a href="#performance-reviews" id="performance-reviews-link">Performance Reviews</a>
        <a href="#reports" id="reports-link">Reports</a>
    </div>

    <div class="container">
        <div id="dashboard" class="content active">
            <h2>Dashboard</h2>
            <div class="flex-container">
                <div class="flex-item card">
                    <h3>Employee Overview</h3>
                    <p>Total Employees: <span id="total-employees">0</span></p>
                    <p>Present Today: <span id="present-employees">0</span></p>
                    <p>On Leave: <span id="on-leave-employees">0</span></p>
                </div>
                <div class="flex-item card">
                    <h3>Quick Actions</h3>
                    <button class="button button-primary" id="add-employee-btn">Add New Employee</button>
                    <button class="button button-secondary" id="view-leave-requests-btn">View Leave Requests</button>
                </div>
            </div>
            <div class="card">
                <h3>Recent Activities</h3>
                <ul id="recent-activities">
                    <!--显示活动 -->
                </ul>
            </div>
        </div>

                <div id="employee-management" class="content">
            <h2>Employee Management</h2>
            <div class="card">
                <h3>Add New Employee</h3>
                <form id="add-employee-form">
                    <div class="form-group">
                        <label for="employee-name">Name</label>
                        <input type="text" id="employee-name" required>
                    </div>
                    <div class="form-group">
                        <label for="employee-email">Email</label>
                        <input type="email" id="employee-email" required>
                    </div>
                    <div class="form-group">
                        <label for="employee-position">Position</label>
                        <input type="text" id="employee-position" required>
                    </div>
                    <button type="submit" class="button button-primary">Add Employee</button>
                </form>
                <div id="add-employee-message" class="success"></div>
            </div>
            <div class="card">
                <h3>Employee List</h3>
                <table class="table" id="employee-list">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Position</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                </table>
            </div>
        </div>

        <div id="leave-requests" class="content">
            <h2>Leave Requests</h2>
            <div class="card">
                <h3>Pending Leave Requests</h3>
                <table class="table" id="leave-requests-table">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Reason</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                     
                    </tbody>
                </table>
            </div>
        </div>

        <div id="performance-reviews" class="content">
            <h2>Performance Reviews</h2>
            <div class="card">
                <h3>Conduct Performance Review</h3>
                <form id="performance-review-form">
                    <div class="form-group">
                        <label for="review-employee">Employee</label>
                        <select id="review-employee" required>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="review-period">Review Period</label>
                        <input type="text" id="review-period" required>
                    </div>
                    <div class="form-group">
                        <label for="review-performance">Performance Rating (1-5)</label>
                        <input type="number" id="review-performance" min="1" max="5" required>
                    </div>
                    <div class="form-group">
                        <label for="review-comments">Comments</label>
                        <textarea id="review-comments" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="button button-primary">Submit Review</button>
                </form>
                <div id="review-message" class="success"></div>
            </div>
            <div class="card">
                <h3>Recent Performance Reviews</h3>
                <table class="table" id="performance-reviews-table">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Review Period</th>
                            <th>Performance Rating</th>
                            <th>Actions</th>
                        </tr >
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>

        <div id="reports" class="content">
            <h2>Reports</h2>
            <div class="card">
                <h3>Employee Reports</h3>
                <table class="table" id="employee-reports-table">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Total Leaves</th>
                            <th>Average Performance Rating</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>

                  <script>
    // Menu function
    const menuBtn = document.getElementById('menu-btn');
    const menu = document.getElementById('menu');
    const menuClose = document.getElementById('menu-close');
    const menuLinks = document.querySelectorAll('.menu a');
    const contents = document.querySelectorAll('.content');

    menuBtn.addEventListener('click', () => {
        menu.classList.add('open');
        menuBtn.style.display = 'none';
    });

    menuClose.addEventListener('click', () => {
        menu.classList.remove('open');
        menuBtn.style.display = 'block';
    });

    menuLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = link.getAttribute('href').slice(1);
            contents.forEach(content => content.classList.remove('active'));
            document.getElementById(targetId).classList.add('active');
            menu.classList.remove('open');
            menuBtn.style.display = 'block';
        });
    });


    // Dashboard
    function updateDashboard() {
        document.getElementById('total-employees').textContent = employees.length;
        document.getElementById('present-employees').textContent = employees.length - leaveRequests.length;
        document.getElementById('on-leave-employees').textContent = leaveRequests.length;
    }

    // Employee Management
    const addEmployeeForm = document.getElementById('add-employee-form');
    const addEmployeeMessage = document.getElementById('add-employee-message');
    const employeeList = document.getElementById('employee-list').querySelector('tbody');

    addEmployeeForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const name = document.getElementById('employee-name').value;
        const email = document.getElementById('employee-email').value;
        const position = document.getElementById('employee-position').value;

        const newEmployee = { id: employees.length + 1, name, email, position };
        employees.push(newEmployee);

        updateEmployeeList();
        updateDashboard();

        addEmployeeForm.reset();
        addEmployeeMessage.textContent = 'Employee added successfully!';
        setTimeout(() => addEmployeeMessage.textContent = '', 3000);
    });

    function updateEmployeeList() {
        employeeList.innerHTML = '';
        employees.forEach(employee => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${employee.name}</td>
                <td>${employee.email}</td>
                <td>${employee.position}</td>
                <td>
                    <button class="button button-warning edit-employee" data-id="${employee.id}">Edit</button>
                    <button class="button button-danger delete-employee" data-id="${employee.id}">Delete</button>
                </td>
            `;
            employeeList.appendChild(row);
        });

        
         document.querySelectorAll('.edit-employee').forEach(button => {
            button.addEventListener('click', () => {
               
            });
        });

        document.querySelectorAll('.delete-employee').forEach(button => {
            button.addEventListener('click', () => {
               
            });
        });
    }

    updateEmployeeList();

    
    const leaveRequestsTable = document.getElementById('leave-requests-table').querySelector('tbody');

    function updateLeaveRequestsTable() {
        leaveRequestsTable.innerHTML = '';
        leaveRequests.forEach(request => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${employees.find(employee => employee.id === request.employeeId).name}</td>
                <td>${request.startDate}</td>
                <td>${request.endDate}</td>
                <td>${request.reason}</td>
                <td>
                    <button class="button button-success approve-leave" data-id="${request.id}">Approve</button>
                    <button class="button button-danger reject-leave" data-id="${request.id}">Reject</button>
                </td>
            `;
            leaveRequestsTable.appendChild(row);
        });

        
        document.querySelectorAll('.approve-leave').forEach(button => {
            button.addEventListener('click', () => {
                
            });
        });

        document.querySelectorAll('.reject-leave').forEach(button => {
            button.addEventListener('click', () => {
                
            });
        });
    }

    updateLeaveRequestsTable();

    // 业绩 Reviews
    const performanceReviewsTable = document.getElementById('performance-reviews-table').querySelector('tbody');

    function updatePerformanceReviewsTable() {
        performanceReviewsTable.innerHTML = '';
        performanceReviews.forEach(review => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${employees.find(employee => employee.id === review.employeeId).name}</td>
                <td>${review.period}</td>
                <td>${review.rating}</td>
                <td>
                    <button class="button button-success view-review" data-id="${review.id}">View</button>
                </td>
            `;
            performanceReviewsTable.appendChild(row);
        });

        
        document.querySelectorAll('.view-review').forEach(button => {
            button.addEventListener('click', () => {
               
            });
        });
    }

    updatePerformanceReviewsTable();


    const employeeReportsTable = document.getElementById('employee-reports-table').querySelector('tbody');

    function updateEmployeeReportsTable() {
        employeeReportsTable.innerHTML = '';
        employees.forEach(employee => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${employee.name}</td>
                <td>${leaveRequests.filter(request => request.employeeId === employee.id).length}</td>
                <td>${performanceReviews.filter(review => review.employeeId === employee.id).reduce((sum, review) => sum + review.rating, 0) / performanceReviews.filter(review => review.employeeId === employee.id).length}</td>
                <td>
                    <button class="button button-success view-report" data-id="${employee.id}">View</button>
                </td>
            `;
            employeeReportsTable.appendChild(row);
        });

        
        document.querySelectorAll('.view-report').forEach(button => {
            button.addEventListener('click', () => {
                
            });
        });
    }

    updateEmployeeReportsTable();
</script>
    </div>
    </body>
</html>
