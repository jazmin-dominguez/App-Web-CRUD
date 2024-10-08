<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Update</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFFCF7; /* Light background color */
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1 {
            color: #738290; /* Title color */
            font-size: 2.5em;
            padding: 15px;
            border: 2px solid #738290; /* Border around the title */
            display: inline-block;
            border-radius: 10px; /* Rounded borders */
            background-color: #FFFFFF; /* White background inside the border */
            margin-top: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Light shadow to highlight the title */
        }

        .search-bar {
            margin: 20px;
        }

        .search-bar input {
            padding: 10px;
            width: 300px;
            border-radius: 10px;
            border: 2px solid #738290; /* Custom color border */
            outline: none;
        }

        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #FFFFFF;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Shadow to highlight the table */
            border-radius: 10px; /* Rounded borders */
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            border: 1px solid #738290; /* Dark color cell borders */
            text-align: left;
        }

        th {
            background-color: #738290; /* Header background */
            color: white; /* White text in headers */
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #FFFCF7; /* Alternating background color for rows */
        }

        tr:hover {
            background-color: #e8e8e8; /* Hover effect for rows */
        }

        /* Footer */
        footer {
            background-color: #00738C; /* Footer background */
            color: white;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 0.9em;
        }

        /* Responsive styling */
        @media (max-width: 768px) {
            table, th, td {
                font-size: 14px;
            }
            .search-bar input {
                width: 100%;
                padding: 12px;
            }
        }
    </style>
</head>
<body>

    <h1>Activity Update</h1>

    <div class="search-bar">
        <input type="text" placeholder="Search activity..." id="search">
    </div>

    <table>
        <thead>
            <tr>
                <th>Activity Name</th>
                <th>Date</th>
                <th>Type</th>
                <th>Subject</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Exercises</td>
                <td>09/10/2024</td>
                <td>Research</td>
                <td>Mathematics</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Act.2</td>
                <td>09/10/2024</td>
                <td>Essay</td>
                <td>Methodologies</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Act.3</td>
                <td>09/10/2024</td>
                <td>Brochure</td>
                <td>Law</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <footer>
        &copy; 2024 Unity Class. All rights reserved.
    </footer>

</body>
</html>
