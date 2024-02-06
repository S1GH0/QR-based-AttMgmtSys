<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Tracker</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        td.present {
            background-color: #a3f3a3;
        }
        td.absent {
            background-color: #f3a3a3;
        }
        .status-present {
            color: green;
            font-weight: bold;
        }
        .status-absent {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<?php
session_start();
    // Database connection parameters
   include('connect.php');
    // Fetch possible attendance statuses from the database
    $statusQuery = $conn->query("SELECT DISTINCT present_status FROM attendance");
    $attendanceStatuses = $statusQuery->fetch_all(MYSQLI_ASSOC);

    // Fetch student data from the database
    $studentsQuery = $conn->query("SELECT * FROM attendance");
    $students = $studentsQuery->fetch_all(MYSQLI_ASSOC);
?>

<h2>Attendance Tracker</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="attendanceForm">
    <table>
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($students as $student): ?>
    <tr>
        <td><?= $student['id']; ?></td>
        <td><?= $student['sname']; ?></td>
        <?php
            $time_in = $student['time_in'];
            list($date, $time) = explode(' ', $time_in);

            $studentId = $student['id'];
            $statusQuery = $conn->query("SELECT present_status FROM attendance WHERE id = $studentId");
            $result = $statusQuery->fetch_assoc();
            $presentStatus = $result['present_status'];
        ?>
        <td><?= $date; ?></td>
        <td>
            <?php if ($presentStatus == '1'): ?>
                <span class="status-present">Present</span>
            <?php else: ?>
                <span class="status-absent">Absent</span>
            <?php endif; ?>
        </td>
    </tr>
<?php endforeach; ?>

        </tbody>
    </table>
<!-- 
    <button type="button" onclick="submitAttendance()">Submit Attendance</button> -->
</form>

<script>
    const selectedAttendance = [];

    document.addEventListener("DOMContentLoaded", function () {
        // Add event listeners for marking attendance
        const datePickers = document.querySelectorAll(".date-picker");
        const statusSelects = document.querySelectorAll(".attendance-status");

        datePickers.forEach((datePicker, index) => {
            datePicker.addEventListener("change", function () {
                markAttendance(index);
            });
        });

        // Function to mark attendance and store selected values
        function markAttendance(index) {
            const row = document.querySelectorAll("tbody tr")[index];
            const studentId = row.querySelector("td:first-child").innerText;
            const date = row.querySelector(".date-picker").value;
            const status = row.querySelector(".attendance-status").value;

            // Store selected values in an array
            selectedAttendance[index] = {
                studentId: studentId,
                date: date,
                status: present_status
            };
        }

        // Function to submit attendance form
        window.submitAttendance = function() {
            // Set hidden input values with selected attendance data
            selectedAttendance.forEach((data, index) => {
                const hiddenStudentId = document.createElement("input");
                hiddenStudentId.type = "hidden";
                hiddenStudentId.name = "id[]";
                hiddenStudentId.value = data.studentId;

                const hiddenDate = document.createElement("input");
                hiddenDate.type = "hidden";
                hiddenDate.name = "date[]";
                hiddenDate.value = data.date;

                const hiddenStatus = document.createElement("input");
                hiddenStatus.type = "hidden";
                hiddenStatus.name = "status[]";
                hiddenStatus.value = data.status;

                // Append hidden inputs to the form
                document.querySelector("#attendanceForm").appendChild(hiddenStudentId);
                document.querySelector("#attendanceForm").appendChild(hiddenDate);
                document.querySelector("#attendanceForm").appendChild(hiddenStatus);
            });

            // Submit the form
            document.querySelector("#attendanceForm").submit();
        };
    });
</script>

</body>
</html>
