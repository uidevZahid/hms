<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Hospital Management System - Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    
    <link href="<?php echo base_url()?>public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>public/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>public/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>public/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>public/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    
    <style>
        .modern-dashboard {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .metric-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 5px solid #667eea;
        }

        .metric-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
        }

        .metric-number {
            font-size: 32px;
            font-weight: 700;
            color: #2c3e50;
            margin: 10px 0;
        }

        .metric-label {
            color: #95a5a6;
            font-size: 14px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .metric-icon {
            font-size: 28px;
            float: right;
            opacity: 0.3;
            color: #667eea;
        }

        .card-header-modern {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 18px 24px;
            border-radius: 10px 10px 0 0;
            font-weight: 600;
            border-bottom: none;
        }

        .chart-container {
            position: relative;
            height: 300px;
            margin: 20px 0;
        }

        .section-title {
            color: #2c3e50;
            font-size: 20px;
            font-weight: 700;
            margin: 30px 0 20px 0;
            border-bottom: 3px solid #667eea;
            padding-bottom: 10px;
        }

        .table-modern tbody tr {
            transition: background-color 0.3s ease;
        }

        .table-modern tbody tr:hover {
            background-color: #f8f9fa;
        }

        .table-modern thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .box-modern {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: none;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .box-modern .box-body {
            padding: 20px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-active {
            background: #d4edda;
            color: #155724;
        }

        .contact-info-box {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
        }

        .contact-info-box h4 {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 15px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }

        .contact-detail {
            margin: 12px 0;
            color: #555;
            font-size: 14px;
        }

        .contact-detail strong {
            color: #2c3e50;
            min-width: 100px;
            display: inline-block;
        }

        .no-data-message {
            text-align: center;
            color: #95a5a6;
            padding: 30px;
            font-style: italic;
        }

        .dashboard-wrapper {
            padding: 30px 15px;
        }

        @media (max-width: 768px) {
            .metric-card {
                padding: 16px;
            }

            .metric-number {
                font-size: 24px;
            }

            .chart-container {
                height: 250px;
            }
        }
    </style>
</head>

<body class="skin-blue modern-dashboard">
    <?php require_once(APPPATH.'views/include/header.php');?>
    
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <?php require_once(APPPATH.'views/include/sidebar.php');?>

        <aside class="right-side">
            <!-- Content Header -->
            <section class="content-header" style="background: white; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                <h1 style="color: #2c3e50; font-weight: 700; margin: 0;">
                    <i class="fa fa-dashboard" style="color: #667eea; margin-right: 10px;"></i>Dashboard
                </h1>
                <p style="color: #95a5a6; margin-top: 5px;">Welcome back! Here's your hospital overview</p>
            </section>

            <section class="content dashboard-wrapper">

                <!-- Key Metrics Row -->
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="metric-card">
                            <div class="metric-icon"><i class="fa fa-users"></i></div>
                            <div class="metric-label">Total Patients</div>
                            <div class="metric-number"><?php echo number_format($total_patients); ?></div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="metric-card">
                            <div class="metric-icon"><i class="fa fa-calendar-check-o"></i></div>
                            <div class="metric-label">Today's Appointments</div>
                            <div class="metric-number"><?php echo $today_appointments; ?></div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="metric-card">
                            <div class="metric-icon"><i class="fa fa-user-md"></i></div>
                            <div class="metric-label">Today's Visits</div>
                            <div class="metric-number"><?php echo $today_visits; ?></div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="metric-card">
                            <div class="metric-icon"><i class="fa fa-stethoscope"></i></div>
                            <div class="metric-label">Total Doctors</div>
                            <div class="metric-number"><?php echo $total_doctors; ?></div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="box-modern">
                            <div class="card-header-modern">
                                <i class="fa fa-pie-chart"></i> Appointment Status Today
                            </div>
                            <div class="box-body">
                                <div class="chart-container">
                                    <canvas id="appointmentStatusChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="box-modern">
                            <div class="card-header-modern">
                                <i class="fa fa-bar-chart"></i> Visits by Department
                            </div>
                            <div class="box-body">
                                <div class="chart-container">
                                    <canvas id="departmentChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Monthly Trend -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-modern">
                            <div class="card-header-modern">
                                <i class="fa fa-line-chart"></i> Appointment Trend (Last 12 Months)
                            </div>
                            <div class="box-body">
                                <div style="height: 350px;">
                                    <canvas id="trendChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Today's Appointments -->
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="section-title"><i class="fa fa-calendar"></i> Today's Appointments</h3>
                        <div class="box-modern">
                            <div class="box-body">
                                <?php if($getTodayAppointment): ?>
                                <div class="table-responsive">
                                    <table class="table table-hover table-modern">
                                        <thead>
                                            <tr>
                                                <th><i class="fa fa-hashtag"></i> Patient No.</th>
                                                <th><i class="fa fa-user"></i> Patient Name</th>
                                                <th><i class="fa fa-clock-o"></i> Appointment Time</th>
                                                <th><i class="fa fa-stethoscope"></i> Doctor</th>
                                                <th><i class="fa fa-info-circle"></i> Reason</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($getTodayAppointment as $appointment): ?>
                                            <tr>
                                                <td><a href="patient/view/<?php echo $appointment->patient_no?>" style="color: #667eea; font-weight: 600;"><?php echo $appointment->patient_no?></a></td>
                                                <td><?php echo $appointment->name?></td>
                                                <td>
                                                    <span class="status-badge status-active">
                                                        <?php echo date("M d, Y", strtotime($appointment->appointmentDate))." ".$appointment->appHour.":".$appointment->appMinutes." ".$appointment->appAMPM;?>
                                                    </span>
                                                </td>
                                                <td><?php echo $appointment->consultantDoctor?></td>
                                                <td><small><?php echo substr($appointment->appointmentReason, 0, 50); ?></small></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php else: ?>
                                <div class="no-data-message">
                                    <i class="fa fa-calendar-times-o" style="font-size: 40px; opacity: 0.3; margin-bottom: 10px;"></i>
                                    <p>No appointments scheduled for today</p>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- New Patients and Visited Patients -->
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="section-title"><i class="fa fa-user-plus"></i> New Patients Today</h3>
                        <div class="box-modern">
                            <div class="box-body">
                                <?php if($latest_patient): ?>
                                <div class="table-responsive">
                                    <table class="table table-hover table-modern">
                                        <thead>
                                            <tr>
                                                <th>Patient No.</th>
                                                <th>Name</th>
                                                <th>Age</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($latest_patient as $patient): ?>
                                            <tr>
                                                <td><a href="patient/view/<?php echo $patient->patient_no?>" style="color: #667eea; font-weight: 600;"><?php echo $patient->patient_no?></a></td>
                                                <td><?php echo $patient->patient?></td>
                                                <td><?php echo $patient->age?></td>
                                                <td><?php echo date("M d, Y", strtotime($patient->date_entry2));?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php else: ?>
                                <div class="no-data-message">
                                    <p>No new patients today</p>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h3 class="section-title"><i class="fa fa-user-check"></i> Visited Patients Today</h3>
                        <div class="box-modern">
                            <div class="box-body">
                                <?php if($latest_visited_patient): ?>
                                <div class="table-responsive">
                                    <table class="table table-hover table-modern">
                                        <thead>
                                            <tr>
                                                <th>OPD No.</th>
                                                <th>Name</th>
                                                <th>Department</th>
                                                <th>Visit Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($latest_visited_patient as $visitor): ?>
                                            <tr>
                                                <td><a href="#" style="color: #667eea; font-weight: 600;"><?php echo $visitor->IO_ID?></a></td>
                                                <td><?php echo $visitor->patient?></td>
                                                <td><?php echo $visitor->dept_name?></td>
                                                <td><?php echo date("M d, Y", strtotime($visitor->date_visit))." ".$visitor->time_visit;?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php else: ?>
                                <div class="no-data-message">
                                    <p>No visited patients today</p>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hospital Contact Information -->
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="section-title"><i class="fa fa-hospital-o"></i> Hospital Information</h3>
                        <?php if($hospital_contact): ?>
                        <div class="contact-info-box">
                            <h4><?php echo $hospital_contact->company_name; ?></h4>
                            
                            <?php if($hospital_contact->company_contactNo): ?>
                            <div class="contact-detail">
                                <strong><i class="fa fa-phone"></i> Phone:</strong>
                                <a href="tel:<?php echo $hospital_contact->company_contactNo; ?>" style="color: #667eea;">
                                    <?php echo $hospital_contact->company_contactNo; ?>
                                </a>
                            </div>
                            <?php endif; ?>
                            
                            <?php if($hospital_contact->company_address): ?>
                            <div class="contact-detail">
                                <strong><i class="fa fa-map-marker"></i> Address:</strong><br>
                                <?php echo $hospital_contact->company_address; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

            </section>
        </aside>
    </div>

    <!-- Scripts -->
    <script src="<?php echo base_url();?>public/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>public/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>public/js/AdminLTE/app.js"></script>

    <script>
        // Appointment Status Chart
        <?php $statusData = json_decode($appointments_by_status, true); ?>
        <?php if($statusData && !empty($statusData)): ?>
        const statusCtx = document.getElementById('appointmentStatusChart').getContext('2d');
        const statusChart = new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: [<?php foreach($statusData as $d): ?>'<?php echo $d['appointmentStatus']; ?>', <?php endforeach; ?>],
                datasets: [{
                    data: [<?php foreach($statusData as $d): ?><?php echo $d['total']; ?>, <?php endforeach; ?>],
                    backgroundColor: ['#667eea', '#764ba2', '#fd7e14', '#dc3545'],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
        <?php endif; ?>

        // Department Chart
        <?php $deptData = json_decode($visits_by_department, true); ?>
        <?php if($deptData && !empty($deptData)): ?>
        const deptCtx = document.getElementById('departmentChart').getContext('2d');
        const deptChart = new Chart(deptCtx, {
            type: 'bar',
            data: {
                labels: [<?php foreach($deptData as $d): ?>'<?php echo isset($d['dept_name']) ? $d['dept_name'] : 'Unknown'; ?>', <?php endforeach; ?>],
                datasets: [{
                    label: 'Visits',
                    data: [<?php foreach($deptData as $d): ?><?php echo $d['total']; ?>, <?php endforeach; ?>],
                    backgroundColor: '#667eea',
                    borderColor: '#764ba2',
                    borderWidth: 2,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y',
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: { beginAtZero: true, grid: { drawBorder: false } },
                    y: { grid: { display: false } }
                }
            }
        });
        <?php endif; ?>

        // Trend Chart
        <?php $trendData = json_decode($monthly_trend, true); ?>
        <?php if($trendData && !empty($trendData)): ?>
        const trendCtx = document.getElementById('trendChart').getContext('2d');
        const trendChart = new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: [<?php foreach($trendData as $d): ?>'<?php echo date("M Y", strtotime($d['month']."-01")); ?>', <?php endforeach; ?>],
                datasets: [{
                    label: 'Appointments',
                    data: [<?php foreach($trendData as $d): ?><?php echo $d['total']; ?>, <?php endforeach; ?>],
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointBackgroundColor: '#764ba2',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top' }
                },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                    x: { grid: { display: false } }
                }
            }
        });
        <?php endif; ?>
    </script>
</body>
</html>