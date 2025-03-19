<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="dashboard_doctor.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>                             
                            <div class="sb-sidenav-menu-heading">Patients Data</div>
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