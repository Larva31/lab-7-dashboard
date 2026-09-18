<?php include 'initialize.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    <h3 class="text-2xl font-bold mb-6 text-gray-800 text-center">Create New User</h3>
    
    <?php
        if(isset($_SESSION['alert_message'])) {
            $isSuccess = strpos($_SESSION['alert_message'], 'created') !== false;
            $bgClass = $isSuccess ? 'bg-green-100 text-green-700 border-green-400' : 'bg-red-100 text-red-700 border-red-400';
            echo '<div class="border px-4 py-3 rounded relative mb-4 ' . $bgClass . '" role="alert">';
            echo '<span class="block sm:inline">' . $_SESSION['alert_message'] . '</span></div>';
            unset($_SESSION['alert_message']);
        }
    ?>
    
    <form method="POST" action="user_add_data.php" class="space-y-4">
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Firstname:</label>
            <input type="text" name="firstname" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Lastname:</label>
            <input type="text" name="lastname" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Username:</label>
            <input type="text" name="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
            <input type="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Confirm Password:</label>
            <input type="password" name="confirm_password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="flex items-center justify-between pt-4">
            <button name="register" type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">Add User</button>
        </div>
    </form>
    <div class="mt-4 text-center">
        <a href="user_records.php" class="text-blue-500 hover:text-blue-800 text-sm">View Record List</a>
    </div>
</div>

</body>
</html>