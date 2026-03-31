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
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"><">"</script>
    
    <style>
        .modern-dashboard { background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 100vh; }
        .metric-card { background: white; border-radius: 12px; padding: 24px; margin-bottom: 20px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08); transition: transform 0.3s ease, box-shadow 0.3s ease; border-left: 5px solid #667eea; }
        .metric-card:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15); }
        .metric-number { font-size: 32px; font-weight: 700; color: #2c3e50; margin: 10px 0; }
        .metric-label { color: #95a5a6; font-size: 14px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; }
        .metric-icon { font-size: 28px; float: right; opacity: 0.3; color: #667eea; }
        .card-header-modern { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 18px 24px; border-radius: 10px 10px 0 0; font-weight: 600; }
        .chart-container { position: relative; height: 300px; margin: 20px 0; }
        .section-title { color: #2c3e50; font-size: 20px; font-weight: 700; margin: 30px 0 20px 0; border-bottom: 3px solid #667eea; padding-bottom: 10px; }
        .box-modern { background: white; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08); border: none; overflow: hidden; margin-bottom: 20px; }
        .box-modern .box-body { padding: 20px; }
        .table-modern thead { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .status-badge { display: inline-block; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .status-active { background: #d4edda; color: #155724; }
        .contact-info-box { background: white; border-radius: 10px; padding: 20px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08); margin-bottom: 20px; }
        .dashboard-wrapper { padding: 30px 15px; }
        .no-data-message { text-align: center; color: #95a5a6; padding: 30px; }
    </style>
</head>
<body class="skin-blue modern-dashboard">
    <?php require_once(APPPATH.'views/include/header.php');?>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <?php require_once(APPPATH.'views/include/sidebar.php');?>
        <aside class="right-side">
            <section class="content-header" style="background: white; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                <h1 style="color: #2c3e50; font-weight: 700; margin: 0;"><i class="fa fa-dashboard" style="color: #667eea; margin-right: 10px;"><">"</i>Dashboard</h1>
                <p style="color: #95a5a6; margin-top: 5px;">Welcome back! Here's your hospital overview</p>
            </section>
            <section class="content dashboard-wrapper">
                <div class="row">
                    <div class="col-md-3 col-sm-6"><div class="metric-card blue"><div class="metric-icon"><i class="fa fa-users"><">"</i></div><div class="metric-label">Total Patients</div><div class="metric-number"><?php echo number_format(); ?></div></div></div>
                    <div class="col-md-3 col-sm-6"><div class="metric-card purple"><div class="metric-icon"><i class="fa fa-calendar-check-o"><">"</i></div><div class="metric-label">Today's Appointments</div><div class="metric-number"><?php echo ; ?></div></div></div>
                    <div class="col-md-3 col-sm-6"><div class="metric-card teal"><div class="metric-icon"><i class="fa fa-user-md"><">"</i></div><div class="metric-label">Today's Visits</div><div class="metric-number"><?php echo ; ?></div></div></div>
                    <div class="col-md-3 col-sm-6"><div class="metric-card orange"><div class="metric-icon"><i class="fa fa-stethoscope"><">"</i></div><div class="metric-label">Total Doctors</div><div class="metric-number"><?php echo ; ?></div></div></div>
                </div>
