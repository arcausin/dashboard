<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?php echo $user['firstName'] . " " . $user['lastName']?></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Tableau de bord</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Organizations Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrganizations"
            aria-expanded="true" aria-controls="collapseOrganizations">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Organisations</span>
        </a>
        <div id="collapseOrganizations" class="collapse" aria-labelledby="headingOrganizations"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/to-do-list/">To Do List</a>
                <a class="collapse-item" href="/notes/">Notes</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Finances Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFinances"
            aria-expanded="true" aria-controls="collapseFinances">
            <i class="fas fa-fw fa-coins"></i>
            <span>Finances</span>
        </a>
        <div id="collapseFinances" class="collapse" aria-labelledby="headingFinances"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="#">Cryptomonnaies</a>
                <a class="collapse-item" href="#">Dépenses bancaires</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - SocialNetworks Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSocialNetworks"
            aria-expanded="true" aria-controls="collapseSocialNetworks">
            <i class="fas fa-fw fa-user-friends"></i>
            <span>Réseaux sociaux</span>
        </a>
        <div id="collapseSocialNetworks" class="collapse" aria-labelledby="headingSocialNetworks"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="#">Messagerie</a>
                <a class="collapse-item" href="#">Forum</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - contents Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsecontents"
            aria-expanded="true" aria-controls="collapsecontents">
            <i class="fas fa-fw fa-desktop"></i>
            <span>Contenus</span>
        </a>
        <div id="collapsecontents" class="collapse" aria-labelledby="headingcontents"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="#">Vidéo</a>
                <a class="collapse-item" href="#">Audio</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Tools Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTools"
            aria-expanded="true" aria-controls="collapseTools">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Outils</span>
        </a>
        <div id="collapseTools" class="collapse" aria-labelledby="headingTools"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="#">Envoi de mail</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Settings Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSettings"
            aria-expanded="true" aria-controls="collapseSettings">
            <i class="fas fa-fw fa-cog"></i>
            <span>Paramètres</span>
        </a>
        <div id="collapseSettings" class="collapse" aria-labelledby="headingSettings"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="#">Assistant Personel</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
