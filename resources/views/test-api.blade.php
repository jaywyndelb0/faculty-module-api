<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty API Test Dashboard</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 20px auto; padding: 20px; line-height: 1.6; background-color: #f4f4f9; }
        h1 { color: #333; text-align: center; }
        .card { background: white; padding: 20px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border-left: 5px solid #007bff; }
        .card h2 { margin-top: 0; color: #007bff; font-size: 1.2em; }
        .card p { margin: 5px 0; color: #666; font-size: 0.9em; }
        .input-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { background-color: #007bff; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; font-weight: bold; }
        button:hover { background-color: #0056b3; }
        .logout-btn { background-color: #dc3545; }
        .logout-btn:hover { background-color: #a71d2a; }
        pre { background: #eee; padding: 15px; border-radius: 4px; overflow-x: auto; white-space: pre-wrap; font-size: 0.9em; border: 1px solid #ccc; max-height: 300px; }
        .method { font-weight: bold; color: #fff; padding: 2px 6px; border-radius: 4px; font-size: 0.8em; margin-right: 5px; }
        .post { background: #28a745; }
        .get { background: #007bff; }
        .auth-status { text-align: center; margin-bottom: 20px; padding: 10px; border-radius: 4px; font-weight: bold; }
        .status-logged-in { background-color: #d4edda; color: #155724; }
        .status-logged-out { background-color: #f8d7da; color: #721c24; }
        .hidden { display: none; }
    </style>
</head>
<body>
    <h1>Faculty API Test Dashboard</h1>
    
    <div id="auth-status-bar" class="auth-status status-logged-out">
        Not Logged In (Protected routes will fail)
    </div>

    <!-- Auth Section -->
    <div class="card" style="border-left-color: #6f42c1;">
        <h2 style="color: #6f42c1;">Staff Authentication</h2>
        
        <div id="auth-forms">
            <h3>Register</h3>
            <div class="input-group">
                <label>Name</label>
                <input type="text" id="reg_name" placeholder="Full Name">
            </div>
            <div class="input-group">
                <label>Email</label>
                <input type="email" id="reg_email" placeholder="Email">
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" id="reg_password" placeholder="Min 8 chars">
            </div>
            <div class="input-group">
                <label>Confirm Password</label>
                <input type="password" id="reg_password_confirmation" placeholder="Confirm Password">
            </div>
            <button onclick="handleRegister()">Register Staff</button>
            <hr>
            <h3>Login</h3>
            <div class="input-group">
                <label>Email</label>
                <input type="email" id="login_email" placeholder="Email">
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" id="login_password" placeholder="Password">
            </div>
            <button onclick="handleLogin()">Login</button>
        </div>

        <div id="auth-user-info" class="hidden">
            <p>Logged in as: <strong id="user-display-name"></strong> (<span id="user-display-email"></span>)</p>
            <button onclick="handleLogout()" class="logout-btn">Logout</button>
            <button onclick="testGet('/api/profile')">Check Profile</button>
        </div>
    </div>

    <div id="api-modules" class="hidden">
        <!-- 0. List All Faculty (GET) -->
        <div class="card">
            <h2><span class="method get">GET</span> /api/faculty</h2>
            <p>View all faculty members.</p>
            <button onclick="testGet('/api/faculty')">View All Faculty</button>
        </div>

        <!-- Student Management (CRUD) -->
        <div class="card" style="border-left-color: #ffc107;">
            <h2 style="color: #ffc107;">Student Management</h2>
            <p>CRUD operations for students.</p>
            <button onclick="testGet('/api/students')">List All Students</button>
            <hr>
            <div class="input-group">
                <label>Student Name</label>
                <input type="text" id="new_student_name">
            </div>
            <div class="input-group">
                <label>Section ID</label>
                <input type="number" id="new_student_section_id" value="1">
            </div>
            <button onclick="testPost('/api/students', {
                name: document.getElementById('new_student_name').value,
                section_id: document.getElementById('new_student_section_id').value
            })">Create Student</button>
        </div>

        <!-- Section Management (CRUD) -->
        <div class="card" style="border-left-color: #17a2b8;">
            <h2 style="color: #17a2b8;">Section Management</h2>
            <p>CRUD operations for sections.</p>
            <button onclick="testGet('/api/sections')">List All Sections</button>
            <hr>
            <div class="input-group">
                <label>Section Name</label>
                <input type="text" id="new_section_name">
            </div>
            <div class="input-group">
                <label>Faculty ID (Optional)</label>
                <input type="number" id="new_section_faculty_id">
            </div>
            <button onclick="testPost('/api/sections', {
                section_name: document.getElementById('new_section_name').value,
                faculty_id: document.getElementById('new_section_faculty_id').value
            })">Create Section</button>
        </div>

        <!-- 1. Create Faculty (POST) -->
        <div class="card">
            <h2><span class="method post">POST</span> /api/faculty</h2>
            <p>Create a new faculty record.</p>
            <div class="input-group">
                <label>Name</label>
                <input type="text" id="faculty_name" placeholder="e.g., John Doe">
            </div>
            <div class="input-group">
                <label>Email</label>
                <input type="email" id="faculty_email" placeholder="e.g., john@example.com">
            </div>
            <div class="input-group">
                <label>Department</label>
                <input type="text" id="faculty_dept" placeholder="e.g., Science">
            </div>
            <button onclick="testPost('/api/faculty', {
                name: document.getElementById('faculty_name').value,
                email: document.getElementById('faculty_email').value,
                department: document.getElementById('faculty_dept').value
            })">Create Faculty</button>
        </div>

        <!-- 2. Assign Faculty to Section (POST) -->
        <div class="card">
            <h2><span class="method get">GET</span> /api/sections/{id}/faculty</h2>
            <p>View section assignment details.</p>
            <div class="input-group">
                <label>Section ID</label>
                <input type="number" id="view_section_id" value="1">
            </div>
            <button onclick="testGet('/api/sections/' + document.getElementById('view_section_id').value + '/faculty')">View Assignment</button>
            <hr>
            <h2><span class="method post">POST</span> /api/sections/{id}/assign-faculty</h2>
            <p>Assign a faculty member to a section.</p>
            <div class="input-group">
                <label>Section ID</label>
                <input type="number" id="assign_section_id" value="1">
            </div>
            <div class="input-group">
                <label>Faculty ID</label>
                <input type="number" id="assign_faculty_id" value="1">
            </div>
            <button onclick="testPost('/api/sections/' + document.getElementById('assign_section_id').value + '/assign-faculty', {
                faculty_id: document.getElementById('assign_faculty_id').value
            })">Assign Faculty</button>
        </div>

        <!-- 3. View Class List (GET) -->
        <div class="card">
            <h2><span class="method get">GET</span> /api/sections/{id}/classlist</h2>
            <p>View all students in a section.</p>
            <div class="input-group">
                <label>Section ID</label>
                <input type="number" id="get_classlist_id" value="1">
            </div>
            <button onclick="testGet('/api/sections/' + document.getElementById('get_classlist_id').value + '/classlist')">View Classlist</button>
        </div>

        <!-- 4. Upload Grade (POST) -->
        <div class="card">
            <h2><span class="method post">POST</span> /api/grades</h2>
            <p>Upload a student grade.</p>
            <div class="input-group">
                <label>Student ID</label>
                <input type="number" id="grade_student_id" value="1">
            </div>
            <div class="input-group">
                <label>Subject</label>
                <input type="text" id="grade_subject" placeholder="e.g., Mathematics">
            </div>
            <div class="input-group">
                <label>Grade</label>
                <input type="text" id="grade_value" placeholder="e.g., A">
            </div>
            <button onclick="testPost('/api/grades', {
                student_id: document.getElementById('grade_student_id').value,
                subject: document.getElementById('grade_subject').value,
                grade: document.getElementById('grade_value').value
            })">Upload Grade</button>
        </div>

        <!-- 5. View Student Grades (GET) -->
        <div class="card">
            <h2><span class="method get">GET</span> /api/grades</h2>
            <p>View all grades uploaded in the system.</p>
            <button onclick="testGet('/api/grades')">View All Grades</button>
            <hr>
            <h2><span class="method get">GET</span> /api/grades/{studentId}</h2>
            <p>View grades of a specific student.</p>
            <div class="input-group">
                <label>Student ID</label>
                <input type="number" id="get_grades_student_id" value="1">
            </div>
            <button onclick="testGet('/api/grades/' + document.getElementById('get_grades_student_id').value)">View Grades</button>
        </div>

        <!-- 6. Track Attendance (POST) -->
        <div class="card">
            <h2><span class="method post">POST</span> /api/attendance</h2>
            <p>Record student attendance.</p>
            <div class="input-group">
                <label>Student ID</label>
                <input type="number" id="att_student_id" value="1">
            </div>
            <div class="input-group">
                <label>Date</label>
                <input type="date" id="att_date" value="2026-03-06">
            </div>
            <div class="input-group">
                <label>Status</label>
                <input type="text" id="att_status" placeholder="e.g., present">
            </div>
            <button onclick="testPost('/api/attendance', {
                student_id: document.getElementById('att_student_id').value,
                date: document.getElementById('att_date').value,
                status: document.getElementById('att_status').value
            })">Record Attendance</button>
        </div>

        <!-- 7. View Attendance (GET) -->
        <div class="card">
            <h2><span class="method get">GET</span> /api/attendance/{studentId}</h2>
            <p>View attendance history of a student.</p>
            <div class="input-group">
                <label>Student ID</label>
                <input type="number" id="get_att_student_id" value="1">
            </div>
            <button onclick="testGet('/api/attendance/' + document.getElementById('get_att_student_id').value)">View Attendance History</button>
        </div>
    </div>

    <h3>API Response:</h3>
    <pre id="response-box">Click a button to see the response here...</pre>

    <script>
        const baseUrl = 'http://127.0.0.1:8000';
        let authToken = localStorage.getItem('auth_token');

        // Initialize UI
        updateAuthUI();

        function updateAuthUI() {
            const authStatus = document.getElementById('auth-status-bar');
            const authForms = document.getElementById('auth-forms');
            const authUserInfo = document.getElementById('auth-user-info');
            const apiModules = document.getElementById('api-modules');
            const user = JSON.parse(localStorage.getItem('auth_user'));

            if (authToken) {
                authStatus.innerText = 'Logged In Successfully';
                authStatus.className = 'auth-status status-logged-in';
                authForms.classList.add('hidden');
                authUserInfo.classList.remove('hidden');
                apiModules.classList.remove('hidden');
                if (user) {
                    document.getElementById('user-display-name').innerText = user.name;
                    document.getElementById('user-display-email').innerText = user.email;
                }
            } else {
                authStatus.innerText = 'Not Logged In (Protected routes will fail)';
                authStatus.className = 'auth-status status-logged-out';
                authForms.classList.remove('hidden');
                authUserInfo.classList.add('hidden');
                apiModules.classList.add('hidden');
            }
        }

        async function handleRegister() {
            const data = {
                name: document.getElementById('reg_name').value,
                email: document.getElementById('reg_email').value,
                password: document.getElementById('reg_password').value,
                password_confirmation: document.getElementById('reg_password_confirmation').value
            };
            
            const result = await apiCall('/api/register', 'POST', data);
            if (result.access_token) {
                saveAuth(result);
            }
        }

        async function handleLogin() {
            const data = {
                email: document.getElementById('login_email').value,
                password: document.getElementById('login_password').value
            };
            
            const result = await apiCall('/api/login', 'POST', data);
            if (result.access_token) {
                saveAuth(result);
            }
        }

        function saveAuth(result) {
            authToken = result.access_token;
            localStorage.setItem('auth_token', authToken);
            localStorage.setItem('auth_user', JSON.stringify(result.user));
            updateAuthUI();
        }

        async function handleLogout() {
            await apiCall('/api/logout', 'POST');
            localStorage.removeItem('auth_token');
            localStorage.removeItem('auth_user');
            authToken = null;
            updateAuthUI();
            document.getElementById('response-box').innerText = 'Logged out successfully.';
        }

        async function apiCall(endpoint, method, data = null) {
            const responseBox = document.getElementById('response-box');
            responseBox.innerText = `Sending ${method} request to ${endpoint}...`;
            
            const headers = { 
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            };
            
            if (authToken) {
                headers['Authorization'] = `Bearer ${authToken}`;
            }

            try {
                const options = { method, headers };
                if (data) options.body = JSON.stringify(data);

                const res = await fetch(baseUrl + endpoint, options);
                const result = await res.json();
                responseBox.innerText = JSON.stringify(result, null, 4);
                return result;
            } catch (error) {
                responseBox.innerText = 'Error: ' + error.message;
                return { error: error.message };
            }
        }

        // Wrapper functions for buttons
        function testPost(endpoint, data) { apiCall(endpoint, 'POST', data); }
        function testGet(endpoint) { apiCall(endpoint, 'GET'); }
    </script>
</body>
</html>
