<?php include 'initialize.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-gray-800">User Dashboard</h3>
        <a href="user_add.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add New User</a>
    </div>

    <!-- Alert placeholder -->
    <?php if(isset($_SESSION['alert_message'])): ?>
        <div class="bg-green-100 text-green-700 border-green-400 border px-4 py-3 rounded mb-4 text-center">
            <?php echo $_SESSION['alert_message']; unset($_SESSION['alert_message']); ?>
        </div>
    <?php endif; ?>

    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Firstname</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lastname</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Username</th>
                </tr>
            </thead>
            <tbody id="table-body" class="bg-white divide-y divide-gray-200">
                <!-- Skeleton Loader -->
                <tr class="animate-pulse">
                    <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-1/2"></div></td>
                    <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-3/4"></div></td>
                    <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-3/4"></div></td>
                    <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-3/4"></div></td>
                </tr>
                <tr class="animate-pulse">
                    <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-1/2"></div></td>
                    <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-3/4"></div></td>
                    <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-3/4"></div></td>
                    <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-3/4"></div></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination Controls -->
    <div id="pagination" class="mt-4 flex justify-center space-x-2"></div>
</div>

<script>
    async function loadUsers(page = 1) {
        // Show skeleton briefly while fetching
        document.getElementById('table-body').innerHTML = `
            <tr class="animate-pulse"><td class="px-6 py-4" colspan="4"><div class="h-4 bg-gray-200 rounded w-full"></div></td></tr>
            <tr class="animate-pulse"><td class="px-6 py-4" colspan="4"><div class="h-4 bg-gray-200 rounded w-full"></div></td></tr>
        `;

        try {
            const response = await fetch(`api_users.php?page=${page}`);
            const data = await response.json();
            
            let html = '';
            data.users.forEach(user => {
                html += `
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">${user.id}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">${user.firstname}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">${user.lastname}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">${user.username}</td>
                    </tr>
                `;
            });
            document.getElementById('table-body').innerHTML = html || '<tr><td colspan="4" class="text-center py-4">No records found.</td></tr>';

            // Build pagination
            let paginationHtml = '';
            for(let i = 1; i <= data.totalPages; i++) {
                const activeClass = i === data.currentPage ? 'bg-blue-500 text-white' : 'bg-gray-200 hover:bg-gray-300';
                paginationHtml += `<button onclick="loadUsers(${i})" class="px-3 py-1 rounded ${activeClass}">${i}</button>`;
            }
            document.getElementById('pagination').innerHTML = paginationHtml;

        } catch (error) {
            console.error("Failed to load users", error);
        }
    }

    // Initialize
    loadUsers();
</script>

</body>
</html>