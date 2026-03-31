 <script language="javascript">
    setTimeout(function timeru(){$('.alert').fadeOut(1000)}, 3000);
   </script>

<style>
.navbar-btn {
    transition: all 0.3s ease;
}
.navbar-btn:hover {
    opacity: 0.8;
    transform: scale(1.05);
}
.dropdown-menu {
    animation: slideDown 0.3s ease;
}
@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.user-menu .dropdown-toggle {
    transition: all 0.3s ease;
}
.user-menu .dropdown-toggle:hover {
    background: rgba(255,255,255,0.1);
    border-radius: 4px;
}
@keyframes blink {
    0%, 49%, 100% {
        opacity: 1;
    }
    50%, 99% {
        opacity: 0.4;
    }
}
</style>

<header class="header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-bottom: 2px solid rgba(0,0,0,0.1); box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
    <a href="#" class="logo">
        <!-- Hospital Logo PNG -->
        <div class="logo-pms"><img src="<?php echo base_url()?>public/img/Hospital_Logo.png" height="36" style="width: auto; margin: 5px 0; object-fit: contain;"></div>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-bottom: none; padding: 0;">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button" style="color: white; transition: all 0.3s ease;">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar" style="background-color: white;"></span>
            <span class="icon-bar" style="background-color: white;"></span>
            <span class="icon-bar" style="background-color: white;"></span>
        </a>
        <div class="logo2" style="color: white; font-weight: 600; letter-spacing: 0.5px; font-size: 18px;">
                <?php echo $companyInfo->company_name?>
        </div>
        <div class="navbar-right" style="padding-right: 20px;">
            <ul class="nav navbar-nav">
                
               <!-- <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope"></i>
                        <span class="label label-success">1</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 1 messages</li>
                        <li>
                          
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="../../img/avatar3.png" class="img-circle" alt="User Image"/>
                                        </div>
                                        <h4>
                                            Support Team
                                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                        </h4>
                                        <p>Why not buy a new awesome theme?</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">See All Messages</a></li>
                    </ul>
                </li>-->
                
               <!-- <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-warning"></i>
                        <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>
                        <li>
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-warning danger"></i> Very long description here that may not fit into the page and may cause design problems
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>-->
                
                <!--<li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-tasks"></i>
                        <span class="label label-danger">9</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 9 tasks</li>
                        <li>
                           
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <h3>
                                            Design some buttons
                                            <small class="pull-right">20%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">View all tasks</a>
                        </li>
                    </ul>
                </li>-->
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: white; font-weight: 700; padding: 15px 20px; font-size: 15px; letter-spacing: 0.3px; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='rgba(255,255,255,0.15)'; this.style.borderRadius='4px';" onmouseout="this.style.backgroundColor='transparent'; this.style.borderRadius='0'">
                        <i class="glyphicon glyphicon-user" style="margin-right: 8px; font-size: 16px;"></i>
                        <span><?php echo $userInfo->firstname." ".$userInfo->lastname;?></span>
                        <i class="fa fa-circle" style="font-size: 8px; margin-left: 8px; color: #27ae60; animation: blink 2s infinite;"></i>
                        <i class="caret" style="margin-left: 5px;"></i>
                    </a>
                    <ul class="dropdown-menu" style="border-radius: 8px; box-shadow: 0 8px 16px rgba(0,0,0,0.15); border: none; margin-top: 5px;">
                        <!-- User image -->
                        <li class="user-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 8px 8px 0 0;">
                            <?php if($userInfo->picture == ""){?>
                    	<img src="<?php echo base_url()?>public/user_picture/no_avatar.gif" class="img-circle" alt="User Image" style="border: 3px solid white;"/>
                    <?php }else{?>
                    	<img src="<?php echo base_url()?>public/user_picture/<?php echo $userInfo->picture;?>" class="img-circle" alt="User Image" style="border: 3px solid white;"/>
                    <?php }?>
                            <p style="margin-top: 10px; margin-bottom: 0;">
                                <?php echo $userInfo->firstname." ".$userInfo->lastname;?> <br /> <small><?php echo $userInfo->designation;?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer" style="padding: 15px; background: #f8f9fa; border-radius: 0 0 8px 8px; border-top: 1px solid #e9ecef;">
                            <div class="pull-left">
                                <a href="<?php echo base_url()?>myprofile" class="btn btn-default btn-sm" style="border-radius: 4px; border: 1px solid #667eea; color: #667eea; font-weight: 500;">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo base_url()?>login/logout" class="btn btn-danger btn-sm" style="border-radius: 4px; background: #667eea; border: 1px solid #667eea; color: white; font-weight: 500;">Sign Out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>





<script type="text/javascript">
function closeAd(id)
{
    $('#' + id).remove();
}
</script>
