<?php
require "../../includes/header.php";
?>
<div class="container-fluid">
    <div class="row" style="height: 100vh !important;">
        <!-- navigation bar-left -->
        <div class="col-sm-2 bg-secondary  text-white pt-3">
            <h3><i class="fas fa-chart-line"></i> Dashboard</h3>
            <div class=" nav navbar">
                <ul class="navigation-list list-unstyled">
                    <li class="nav-item"><a href="" class="nav-link text-white"><i class="fas fa-file-invoice"></i> View Invoices</a></li>
                    <li class="nav-item"><a href="" class="nav-link text-white"><i class="fas fa-file-invoice-dollar"></i> Recurrent Bills</a></li>
                    <li class="nav-item"><a href="" class="nav-link text-white"><i class="fas fa-dollar"></i> Pay Rent</a></li>
                    <hr>
                    <li class="nav-item"><a href="" class="nav-link text-white"><i class="fa fa-user" aria-hidden="true"></i> My Account</a></li>
                    <li class="nav-item"><a href="" class="nav-link text-white"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-10 p-lg-3">
            <div class="heading">
                <h3>Welcome, Tenant</h3>
                <hr>
            </div>

            <!-- main content-area -->
            <div class="main-area" style="overflow-x: hidden;">
                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <div class="card text-white bg-primary mb-4">
                            <div class="card-header d-flex align-items-center justify-content-center">
                                <h4 class="mb-0"><i class="fas fa-money-check    "></i> Unpaid Bills</h4>
                            </div>
                            <div class="card-body text-white">
                                <p class="text-center font-monospace">10</p>
                            </div>
                            <div class="card-footer">
                                <p class="text-dark text-center"><button class="btn btn-light"><i class="fas fa-eye"></i> view all</button></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card text-white bg-success mb-4">
                            <div class="card-header d-flex align-items-center justify-content-center">
                                <h4 class="mb-0"><i class="fas fa-gauge"></i> Meter Reading</h4>
                            </div>
                            <div class="card-body text-white">
                                <p class=" text-center font-monospace">10</p>
                            </div>
                            <div class="card-footer">
                                <p class="text-dark text-center"><button class="btn btn-light"><i class="fas fa-eye"></i> view all</button></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card text-white bg-danger mb-4">
                            <div class="card-header d-flex align-items-center justify-content-center">
                                <h4 class="mb-0"><i class="fas fa-file-invoice"></i> Invoices</h4>
                            </div>
                            <div class="card-body text-white">
                                <p class=" text-center font-monospace">10</p>
                            </div>
                            <div class="card-footer">
                                <p class="text-dark text-center"><button class="btn btn-light"><i class="fas fa-eye"></i> view all</button></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- details section -->
            <div class="container-fluid">
                <div class="col-sm-12">
                    <h3>My Monthly Rent Summary (<?php echo date("Y") ?>)</h3>
                    <div
                        class="table-responsive">
                        <table
                            class="table table-primary table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Month</th>
                                    <th scope="col">Paid Rent (Kshs)</th>
                                    <th scope="col">Unpaid Rent (Kshs)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $months = [
                                    'January',
                                    'February',
                                    'March',
                                    'April',
                                    'May',
                                    'June'
                                ];
                                foreach ($months as $index => $month) {
                                    // Example data: generate random paid/unpaid values for demo
                                    $paid = rand(20000, 80000);
                                    $unpaid = rand(0, 20000);
                                    echo '<tr>';
                                    echo '<td scope="row">' . $month . " (" . date("Y") . ")" . '</td>';
                                    echo '<td>' . number_format($paid) . '</td>';
                                    echo '<td>' . number_format($unpaid) . '</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!-- charts js section -->
            <!-- Chart.js CDN -->
            <script src="<?php echo loadAsset('assets/js/chart.umd.min.js'); ?>"></script>
            <div class="row mt-4">
                <div class="col-md-8">
                    <canvas id="rentSummaryChart"></canvas>
                </div>
            </div>
            <script>
                // Example data (should match PHP table above)
                const months = ['January', 'February', 'March', 'April', 'May', 'June'];
                const paidData = [];
                const unpaidData = [];
                <?php
                // Generate the same random data as in the table for consistency
                $paidArr = [];
                $unpaidArr = [];
                foreach ($months as $index => $month) {
                    $paid = rand(0, 80000);
                    $paidArr[] = $paid;
                }
                ?>
                // Output PHP arrays as JS arrays
                paidData.push(...<?php echo json_encode($paidArr); ?>);

                const ctx = document.getElementById('rentSummaryChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: months,
                        datasets: [{
                                label: 'Paid Rent (Kshs)',
                                data: paidData,
                                backgroundColor: 'rgba(40, 167, 69, 0.7)'
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top'
                            },
                            title: {
                                display: true,
                                text: 'Monthly Rent Summary (<?php echo date("Y"); ?>)'
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return value.toLocaleString();
                                    }
                                }
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
</div>
<?php
require "../../includes/footer.php";
?>