<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examination Results Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap');

:root {
    --primary-color: #302f49;
    --secondary-color: #45a049;
    --accent-color: #4a4972;
    --text-light: #ffffff;
    --hover-color: rgba(255, 255, 255, 0.1);
}

        body {
            font-family: 'Quicksand', sans-serif;
            margin: 0;
            background-color: #f4f6f9;
        }

        .main-content {
            padding: 30px;
            transition: margin-left 0.3s ease;
        }

        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
            overflow: hidden;
        }

        .card-header {
            background: var(--primary-color);
            color: white;
            padding: 15px 20px;
            font-weight: 500;
        }

        .card-body {
            padding: 20px;
        }

        .form-control {
            width: 100%;
            padding: 10px 15px;
            border: 2px solid #e1e5eb;
            border-radius: 6px;
            font-family: 'Quicksand', sans-serif;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(69, 160, 73, 0.1);
        }

        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            font-family: 'Quicksand', sans-serif;
        }

        .btn-primary {
            background: var(--secondary-color);
            color: white;
        }

        .btn-primary:hover {
            background: #3c8a3f;
            transform: translateY(-1px);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            background: #f8f9fa;
            color: var(--primary-color);
            font-weight: 600;
            padding: 12px 15px;
            text-align: left;
            border-bottom: 2px solid #e1e5eb;
        }

        .table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e1e5eb;
            color: #555;
        }

        .table tbody tr:hover {
            background: #f8f9fa;
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 20px;
            }
            
            .search-container {
                flex-direction: column;
                gap: 10px;
            }
            
            .search-input {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <h1 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-graduation-cap mr-2"></i>
                    Examination Results Portal
                </h1>
                <div class="relative w-full md:w-64">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="candidateSearch" 
                           class="w-full pl-10 px-4 py-2 rounded-lg border focus:ring-2 focus:ring-secondary-color" 
                           placeholder="Search candidate number...">
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 max-w-7xl w-full mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-search mr-2"></i>
                    Search Results
                </div>
                <div class="card-body">
                    <form id="searchForm" class="mb-8">
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="flex-1">
                                <label for="center_no" class="block text-sm font-medium text-gray-700 mb-1">
                                    Center Number
                                </label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-building text-gray-400"></i>
                                    </div>
                                    <input type="text" name="center_no" id="center_no" required
                                           class="form-control pl-10"
                                           placeholder="e.g. X51">
                                </div>
                            </div>
                            <div class="flex items-end">
                                <button type="submit" class="btn btn-primary w-full md:w-auto">
                                    <i class="fas fa-search mr-2"></i>
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>

                    <div id="resultsContainer" class="mt-4 overflow-x-auto">
                        <table class="table" id="resultsTable">
                            <thead>
                                <tr>
                                    <th>
                                        <i class="fas fa-id-card mr-2"></i>
                                        Candidate Number
                                    </th>
                                    <th>
                                        <i class="fas fa-poll mr-2"></i>
                                        Results
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Results will be inserted here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 mt-8">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                <p class="text-center text-sm text-gray-500">
                    © 2024 Examination Results Portal
                </p>
            </div>
        </footer>
    </div>

    <script>
        document.getElementById('searchForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            document.querySelector('#resultsTable tbody').innerHTML = 
                '<tr><td colspan="2" class="text-center py-4"><i class="fas fa-spinner fa-spin mr-2"></i>Loading...</td></tr>';

            const formData = new FormData(this);
            
            fetch('get_results.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    throw new Error(data.error);
                }
                const results = data.Data || data.data || data;
                displayResults(results);
            })
            .catch(error => {
                console.error('Error:', error);
                document.querySelector('#resultsTable tbody').innerHTML = 
                    `<tr><td colspan="2" class="text-center py-4 text-red-500"><i class="fas fa-exclamation-circle mr-2"></i>Error: ${error.message}</td></tr>`;
            });
        });

        document.getElementById('candidateSearch').addEventListener('input', function(e) {
            filterResults(e.target.value);
        });

        function filterResults(searchTerm) {
            const rows = document.querySelectorAll('#resultsTable tbody tr');
            searchTerm = searchTerm.toLowerCase();
            
            rows.forEach(row => {
                const candidateNumber = row.querySelector('td:first-child')?.textContent.toLowerCase() || '';
                row.style.display = candidateNumber.includes(searchTerm) ? '' : 'none';
            });
        }

        function displayResults(data) {
            const tbody = document.querySelector('#resultsTable tbody');
            tbody.innerHTML = '';

            if (!data || !Array.isArray(data)) {
                tbody.innerHTML = '<tr><td colspan="2" class="text-center py-4"><i class="fas fa-info-circle mr-2"></i>No results found</td></tr>';
                return;
            }

            data.forEach(result => {
                if (!result.line) return;
                
                const line = result.line.replace(/\"/g, '').trim();
                const [candidateNumber, ...restOfData] = line.split(/\s+/);

                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50';
                
                const numberCell = document.createElement('td');
                numberCell.className = 'px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900';
                numberCell.textContent = candidateNumber;
                
                const resultsCell = document.createElement('td');
                resultsCell.className = 'px-6 py-4 text-sm text-gray-500';
                resultsCell.textContent = restOfData.join(' ');
                
                row.appendChild(numberCell);
                row.appendChild(resultsCell);
                tbody.appendChild(row);
            });
        }
    </script>
</body>
</html>