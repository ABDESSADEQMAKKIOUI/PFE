
         <!-- Navbar -->
         <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: rgba(62,88,113);">
                   <!-- Left navbar links -->
         <ul class="navbar-nav">
            <li class="nav-item">
               <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
         </ul>
         
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
               <li class="nav-item">
                  <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-widget="fullscreen" href="../index.php">
                  <i class="fas fa-power-off"></i>
                  </a>
               </li>
            </ul>
            
         </nav>
        
         <!-- /.navbar -->
         <!-- Main Sidebar Container -->
         <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: rgba(44,62,80); position: fixed;">
            <!-- Brand Logo -->
<a href="index.html" class="brand-link animated swing">
<img src="../asset/img/logo.jpeg" alt="DSMS Logo" width="200">
</a>
<!-- Sidebar -->
<div class="sidebar" style="margin-top: -10px">
   <!-- Sidebar user panel (optional) -->
   <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
         <img src="../asset/img/profile.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
         <a href="profile.php" class="d-block"> <?php echo $_SESSION['name'];?></a>
      </div>
   </div>
   <!-- Sidebar Menu -->
   <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <li class="nav-item">
            <a href="formation.php" class="nav-link">
               <i class="nav-icon fa fa-clinic-medical"></i>
               <p>
                  Dashboard
               </p>
            </a>
         </li>
         <li class="nav-item">
            <a href="#" class="nav-link">
               <i class="nav-icon fas fa-capsules"></i>
               <p>
                  Formations
               </p>
                  <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                  <a href="inscrit_formation.php" class="nav-link">
                     <i class="nav-icon fa fa-plus"></i>
                     <p>Inscrit</p>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="gérer_formation.php" class="nav-link">
                     <i class="nav-icon fa fa-list"></i>
                     <p>Consulter</p>
                  </a>
               </li>
            </ul>
         </li>
         
         <li class="nav-item">
            <a href="emploi.php" class="nav-link">
               <i class="nav-icon fas fa-capsules"></i>
               <p>
                  Emploi du temps
               </p>
                  <i class="right fas fa-angle-left"></i>
            </a>
            
         </li>
         <li class="nav-item">
            <a href="note.php" class="nav-link">
               <i class="nav-icon fas fa-capsules"></i>
               <p>
                  Note
               </p>
                  <i class="right fas fa-angle-left"></i>
            </a>
            
         </li>
         <li class="nav-item">
            <a href="contact.php" class="nav-link">
               <i class="nav-icon fas fa-capsules"></i>
               <p>
                  Demande
               </p>
                  <i class="right fas fa-angle-left"></i>
            </a>
            
         </li>
         
         <li class="nav-item">
            <a href="about.php" class="nav-link">
               <i class="nav-icon fa fa-layer-group"></i>
               <p>
                  A propre de centre
               </p>
                  <i class="right fas fa-angle-left"></i>
            </a>
         </li>
         <li class="nav-item">
            <a href="certificat.php" class="nav-link">
               <i class="nav-icon fa fa-file-prescription"></i>
               <p>
                  Certificats
               </p>
                  <i class="right fas fa-angle-left"></i>
            </a>
            
         </li>
      
      </ul>
   </nav>
   
   <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>