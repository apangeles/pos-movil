 <!--begin::Header-->
 <nav class="app-header navbar navbar-expand bg-body">
     <!--begin::Container-->
     <div class="container-fluid">
         <!--begin::Start Navbar Links-->
         <ul class="navbar-nav">
             <li class="nav-item">
                 <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                     <i class="bi bi-list"></i>
                 </a>
             </li>

             <li class="nav-item d-none d-md-block">
                 <a href="../index.html" class="nav-link">
                     <i class="bi bi-grid-1x2 me-1" aria-hidden="true"></i>
                     Ventas
                 </a>
             </li>
             <li class="nav-item d-none d-md-block">
                 <a href="../docs/introduction.html" class="nav-link">
                     <i class="bi bi-book me-1" aria-hidden="true"></i>
                     Productos
                 </a>
             </li>
         </ul>
         <!--end::Start Navbar Links-->

         <!--begin::End Navbar Links-->
         <ul class="navbar-nav ms-auto">
             <!--begin::Fullscreen Toggle-->
             <li class="nav-item">
                 <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                     <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                     <i data-lte-icon="minimize" class="bi bi-fullscreen-exit d-none"></i>
                 </a>
             </li>
             <!--end::Fullscreen Toggle-->

             <!--begin::Color Mode Toggle (#6010)-->
             <li class="nav-item dropdown">
                 <a
                     class="nav-link"
                     href="#"
                     id="bd-theme"
                     aria-label="Toggle color scheme"
                     data-bs-toggle="dropdown"
                     aria-expanded="false">
                     <i class="bi bi-sun-fill" data-lte-theme-icon="light"></i>
                     <i class="bi bi-moon-fill d-none" data-lte-theme-icon="dark"></i>
                     <i class="bi bi-circle-half d-none" data-lte-theme-icon="auto"></i>
                 </a>
                 <ul
                     class="dropdown-menu dropdown-menu-end"
                     aria-labelledby="bd-theme"
                     style="--bs-dropdown-min-width: 8rem">
                     <li>
                         <button
                             type="button"
                             class="dropdown-item d-flex align-items-center"
                             data-bs-theme-value="light"
                             aria-pressed="false">
                             <i class="bi bi-sun-fill me-2"></i>
                             Light
                             <i class="bi bi-check-lg ms-auto d-none"></i>
                         </button>
                     </li>
                     <li>
                         <button
                             type="button"
                             class="dropdown-item d-flex align-items-center"
                             data-bs-theme-value="dark"
                             aria-pressed="false">
                             <i class="bi bi-moon-fill me-2"></i>
                             Dark
                             <i class="bi bi-check-lg ms-auto d-none"></i>
                         </button>
                     </li>
                     <li>
                         <button
                             type="button"
                             class="dropdown-item d-flex align-items-center active"
                             data-bs-theme-value="auto"
                             aria-pressed="true">
                             <i class="bi bi-circle-half me-2"></i>
                             Auto
                             <i class="bi bi-check-lg ms-auto d-none"></i>
                         </button>
                     </li>
                 </ul>
             </li>
             <!--end::Color Mode Toggle-->

             <!--begin::User Menu Dropdown-->
             @if(Auth::check())
             <li class="nav-item dropdown user-menu">
                 <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                     <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                 </a>
                 <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                     <!--begin::User Image-->
                     <li class="user-header text-bg-primary">
                         <p>
                             {{ Auth::user()->name }}
                         </p>
                     </li>
                     <!--end::User Image-->
                     <!--begin::Menu Footer-->
                     <li class="user-footer">
                         <a href="#" class="btn btn-outline-secondary">Perfil</a>
                         <a href="#" onclick="document.getElementById('logout-form').submit()" class="btn btn-outline-danger float-end">Cerrar Sesión</a>
                     </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                     <!--end::Menu Footer-->
                 </ul>
             </li>
             @endif

             <!--end::User Menu Dropdown-->
         </ul>
         <!--end::End Navbar Links-->
     </div>
     <!--end::Container-->
 </nav>
 <!--end::Header-->
