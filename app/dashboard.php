<?php include'includes/head.php'; ?>

        <div id="layoutSidenav">
            <?php include'includes/nav.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <!-- cards -->
                        <?php include'includes/cards.php';?> 
                        
                        
                    </div>
                </main>
                <?php include('includes/footer.php');?>
            </div>
        </div>
        <?php include('includes/footer_link.php');?>