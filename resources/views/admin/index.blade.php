<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Add your existing head content here -->

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('combinedChart').getContext('2d');

            var userCount = @json($userCount);
            var orderCount = @json($orderCount);
            var vendorCount = @json($vendorCount);

            console.log('User Count:', userCount);
            console.log('Order Count:', orderCount);
            console.log('Vendor Count:', vendorCount);

            var combinedChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Total Users', 'Total Orders', 'Total Vendors'],
                    datasets: [{
                        label: 'Count',
                        data: [userCount, orderCount, vendorCount],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(75, 150, 192, 0.5)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: false,
                    maintainAspectRatio: false,
                }
            });
        });
    </script>


</head>
<body>
    <section>
        @include('components.navbaradmin')
    </section>
    <div>
        <h1>Halaman admin</h1>
        <p>Selamat datang {{ auth()->user()->name }}</p>

        <canvas id="combinedChart" width="400" height="400"></canvas>
    </div>
</body>
</html>
