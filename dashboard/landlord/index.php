<?php
require "../../includes/header.php";
$imagePath = loadAsset('assets/images/logo-1.png');
session_start();
?>
<div class="container-fluid">
    <div class="row" style="height: 100vh !important;">
        <!-- navigation bar-left -->
        <div class="col-sm-2 bg-secondary  text-white pt-3">
            <h3><i class="fas fa-chart-line"></i> Dashboard</h3>
            <div class=" nav navbar">
                <ul class="navigation-list list-unstyled">
                    <li class="nav-item"><a href="home" class="nav-link text-white"><i class="fas fa-home"></i> Home</a></li>
                    <li class="nav-item"><a href="view-apartments" class="nav-link text-white"><i class="fas fa-building"></i> View Apartments</a></li>
                    <li class="nav-item"><a href="view-houses" class="nav-link text-white"><i class="fas fa-home"></i> View Houses</a></li>
                    <li class="nav-item"><a href="view-tenants" class="nav-link text-white"><i class="fas fa-users"></i> View Tentants</a></li>
                    <li class="nav-item"><a href="view-caretakers" class="nav-link text-white"><i class="fas fa-users"></i> View Caretakers</a></li>
                    <li class="nav-item"><a href="view-invoices" class="nav-link text-white"><i class="fas fa-file-invoice"></i> View Invoices</a></li>
                    <li class="nav-item"><a href="view-water-bills" class="nav-link text-white"><i class="fas fa-water"></i> Water bills</a></li>
                    <li class="nav-item"><a href="view-recurrent-bills" class="nav-link text-white"><i class="fas fa-book"></i> Recurrent Bills</a></li>
                    <li class="nav-item"><a href="generate-invoices" class="nav-link text-white"><i class="fas fa-file-invoice-dollar"></i> Generate Invoices</a></li>
                    <hr>
                    <li class="nav-item"><a href="add-apartment" class="nav-link text-white"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Apartment</a></li>
                    <li class="nav-item"><a href="add-house" class="nav-link text-white"><i class="fa fa-plus-square" aria-hidden="true"></i> Add House</a></li>
                    <li class="nav-item"><a href="add-tenant" class="nav-link text-white"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Tenant</a></li>
                    <li class="nav-item"><a href="logout" class="nav-link text-white"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-10 p-lg-3">
            <div class="heading">
                <h3>Welcome, Admin: <?php echo $_SESSION["user_name"] ?></h3>
                <hr>
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <button type="button" class="btn-hover-animate btn btn-primary btn-lg w-100 py-3" data-bs-toggle="modal" data-bs-target="#addApartmentModal">
                                <i class="fas fa-building me-2"></i> Add Apartment
                            </button>
                        </div>
                        <div class="col-md-4 mb-3">
                            <button type="button" class="btn-hover-animate btn btn-success btn-lg w-100 py-3" data-bs-toggle="modal" data-bs-target="#addHouseModal">
                                <i class="fas fa-home me-2"></i> Add House
                            </button>
                        </div>
                        <div class="col-md-4 mb-3">
                            <button type="button" class="btn-hover-animate btn btn-info btn-lg w-100 py-3 text-white" data-bs-toggle="modal" data-bs-target="#addTenantModal">
                                <i class="fas fa-user-plus me-2"></i> Add Tenant
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <button type="button" class="btn-hover-animate btn btn-warning btn-lg w-100 py-3" data-bs-toggle="modal" data-bs-target="#addCaretakerModal">
                                <i class="fas fa-user-shield me-2"></i> Add Caretaker
                            </button>
                        </div>
                        <div class="col-md-4 mb-3">
                            <button type="button" class="btn-hover-animate btn btn-blue btn-lg w-100 py-3" data-bs-toggle="modal" data-bs-target="#addWaterBillModal" style="background-color: #0dcaf0;">
                                <i class="fas fa-tint me-2"></i> Add Water Bill
                            </button>
                        </div>
                        
                    </div>
                </div>
                <hr>
            </div>

            <!-- main content-area -->
            <div class="main-area" id="mainContent" style="overflow-x: hidden;">

            </div>
            <!-- details section -->
            <div class="container-fluid">
                <div class="col-sm-12">
                    <h3>Monthly Rent Summary (<?php echo date("Y") ?>)</h3>
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
                    $paid = rand(20000, 80000);
                    $unpaid = rand(0, 80000);
                    $paidArr[] = $paid;
                    $unpaidArr[] = $unpaid;
                }
                ?>
                // Output PHP arrays as JS arrays
                paidData.push(...<?php echo json_encode($paidArr); ?>);
                unpaidData.push(...<?php echo json_encode($unpaidArr); ?>);

                const ctx = document.getElementById('rentSummaryChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: months,
                        datasets: [{
                                label: 'Paid Rent (Kshs)',
                                data: paidData,
                                backgroundColor: 'rgba(40, 167, 69, 0.7)'
                            },
                            {
                                label: 'Unpaid Rent (Kshs)',
                                data: unpaidData,
                                backgroundColor: 'rgba(220, 53, 69, 0.7)'
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
require "../../includes/modals.php";
require "../../includes/footer.php";
?>