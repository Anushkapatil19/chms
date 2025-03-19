<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="case_registration.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-plus-square"></i></div>
                                New Case
                            </a>

                            <?php if($_SESSION["user_type"] == 1): ?>
                                <a class="nav-link" href="user_registration.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-user"></i></div>
                                User Registration
                            </a>
                            <?php endif; ?>
                            <div class="sb-sidenav-menu-heading">Case</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Health Issues
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="respiratory_system_assessments.php">Respiratory System </a>
                                    <a class="nav-link" href="cardiovascular_system_assessments.php">Cardiovascular System</a>
                                    <a class="nav-link" href="central_nervous_system_assessments.php">Central Nervous System</a>
                                    <a class="nav-link" href="perabdominal_assessments.php">Perabdominal Assessments</a>
                                </nav>
                            </div>
                            
                            
                            <div class="sb-sidenav-menu-heading">Reports</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Health Issues Reports
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="report_respiratory_system_assessments.php">Respiratory System </a>
                                    <a class="nav-link" href="report_cardiovascular_system_assessments.php">Cardiovascular System</a>
                                    <a class="nav-link" href="report_central_nervous_system_assessments.php">Central Nervous System</a>
                                    <a class="nav-link" href="report_perabdominal_assessments.php">Perabdominal Report</a>
                                </nav>
                            </div>

                        </div>
                    </div>
                    <div class="sb-sidenav-footer"><div class="small">email:<?php echo $_SESSION['email'] ?></div></div>
                </nav>
            </div>