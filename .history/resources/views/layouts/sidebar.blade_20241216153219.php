<nav id="sidebar" class="col-md-3 col-lg-2 sidebar">
    <div id="userprofile" class="position-relative" style="height: 100%">
        <ul class="nav flex-column">
            <!-- Dashboard -->
            <li class="nav-item">
                <div class="sidebar-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a class="collapsed submenu" href="{{ route('home') }}" style="justify-content: flex-start">
                        <span class="icon">
                            <x-simpleline-grid class="icon-size" />
                        </span>
                        <span class="d-none d-md-inline">
                            Dashboard
                        </span>
                    </a>
                </div>
            </li>

            <!-- Manage Shops with unique ID and target -->
            <li class="nav-item">
                <div class="sidebar-link {{ request()->is('galleries*') ? 'active' : '' }}">
                    <a class="collapsed submenu" href="{{ route('galleries.index') }}">
                        <span class="icon">
                            <x-bi-image class="icon-size" />
                        </span>
                        <span class="d-none d-md-inline">
                            Gallery
                        </span>
                    </a>
                </div>
            </li>


            <!-- Inventory Management with unique ID and target -->
            <li class="nav-item">
                <div class="sidebar-link {{ request()->is('about-us*') ? 'active' : '' }}">
                    <a class="collapsed submenu" href="{{ route('about-us.index') }}">
                        <span class="icon">
                            <x-simpleline-user class="icon-size" />
                        </span>
                        <span class="d-none d-md-inline">
                            About Us
                        </span>
                    </a>
                </div>
            </li>




            <!-- Sales Management with unique ID and target -->
            <li class="nav-item">

                <div class="sidebar-link {{ request()->is('news*') ? 'active' : '' }}">
                    <a class="collapsed submenu" href="{{ route('news.index') }}">
                        <span class="icon">
                            <x-bi-newspaper class="icon-size" />
                        </span>
                        <span class="d-none d-md-inline">
                            News
                        </span>
                    </a>
                </div>
            </li>




            <!-- Sidebar link for Purchase Management with collapsible submenu for CRUD operations -->
            <li class="nav-item">

                <div class="sidebar-link {{ request()->is('homepage*') ? 'active' : '' }}">
                    <a class="collapsed submenu" href="{{ route('homepage.index') }}">
                        <span class="icon">
                            <x-simpleline-home class="icon-size" />
                        </span>
                        <span class="d-none d-md-inline">
                            Home page
                        </span>
                    </a>
                    <span class="icon toggle-arrow d-none d-md-inline" data-bs-toggle="collapse"
                        data-bs-target="#homeSubmenu" aria-expanded="false" aria-controls="homeSubmenu">
                        @if (request()->has('homeSubmenu') && request('homeSubmenu') == 'expanded')
                            <x-simpleline-arrow-up class="arrow-size" />
                        @else
                            <x-simpleline-arrow-down class="arrow-size" />
                        @endif
                    </span>
                </div>

                <div id="homeSubmenu" class="collapse">
                    <ul class="nav flex-column">
                        <!-- Check for 'Full control' role or permission for 'create expense' -->
                        <li class="nav-item">
                            <a class="nav-link submenu-link {{ request()->routeIs('homepage.about') ? 'active' : '' }}"
                                href="{{ route('homepage.index') }}">
                                <span>About Us</span>
                            </a>
                        </li>

                        <!-- Check for 'Full control' role or permission for 'view expense' -->
                        <li class="nav-item">
                            <a class="nav-link submenu-link {{ request()->routeIs('homepage.slider') ? 'active' : '' }}"
                                href="{{ route('homepage.index') }}">
                                <span>Slider</span>
                            </a>
                        </li>

                        <!-- Check for 'Full control' role or permission for 'edit expense' -->
                        <li class="nav-item">
                            <a class="nav-link submenu-link {{ request()->routeIs('homepage.index') ? 'active' : '' }}"
                                href="{{ route('homepage.index') }}">
                                <span>Vision</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>




            <!-- Sidebar link for Expense Management with collapsible submenu for CRUD operations -->
            <li class="nav-item">

                <div class="sidebar-link {{ request()->is('expense*') ? 'active' : '' }}">
                    <a class="collapsed submenu" href="#">
                        <span class="icon">
                            <x-simpleline-wallet class="icon-size" />
                        </span>
                        <span class="d-none d-md-inline">
                            Expense
                        </span>
                    </a>
                    <span class="icon toggle-arrow d-none d-md-inline" data-bs-toggle="collapse"
                        data-bs-target="#expenseSubmenu" aria-expanded="false" aria-controls="expenseSubmenu">
                        @if (request()->has('expenseSubmenu') && request('expenseSubmenu') == 'expanded')
                            <x-simpleline-arrow-up class="arrow-size" />
                        @else
                            <x-simpleline-arrow-down class="arrow-size" />
                        @endif
                    </span>
                </div>

                <div id="expenseSubmenu" class="collapse">
                    <ul class="nav flex-column">
                        <!-- Check for 'Full control' role or permission for 'create expense' -->
                        <li class="nav-item">
                            <a class="nav-link submenu-link {{ request()->routeIs('expense.create') ? 'active' : '' }}"
                                href="#">
                                <span>Create Expense</span>
                            </a>
                        </li>

                        <!-- Check for 'Full control' role or permission for 'view expense' -->
                        <li class="nav-item">
                            <a class="nav-link submenu-link {{ request()->routeIs('expense') ? 'active' : '' }}"
                                href="#">
                                <span>View Expenses</span>
                            </a>
                        </li>

                        <!-- Check for 'Full control' role or permission for 'edit expense' -->
                        <li class="nav-item">
                            <a class="nav-link submenu-link" href="#">
                                <span>Edit Expense</span>
                            </a>
                        </li>

                        <!-- Check for 'Full control' role or permission for 'delete expense' -->
                        <li class="nav-item">
                            <a class="nav-link submenu-link" href="#">
                                <span>Delete Expense</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <!-- Sidebar link for Users Management with collapsible submenu for CRUD operations -->
            <li class="nav-item">

                <div class="sidebar-link {{ request()->is('user*') ? 'active' : '' }}">
                    <a class="collapsed submenu" href="#">
                        <span class="icon">
                            <x-simpleline-user class="icon-size" />
                        </span>
                        <span class="d-none d-md-inline">
                            Users
                        </span>
                    </a>
                    <span class="icon toggle-arrow d-none d-md-inline" data-bs-toggle="collapse"
                        data-bs-target="#usersSubmenu" aria-expanded="false" aria-controls="usersSubmenu">
                        @if (request()->has('usersSubmenu') && request('usersSubmenu') == 'expanded')
                            <x-simpleline-arrow-up class="arrow-size" />
                        @else
                            <x-simpleline-arrow-down class="arrow-size" />
                        @endif
                    </span>
                </div>

                <div id="usersSubmenu" class="collapse">
                    <ul class="nav flex-column">
                        <!-- Check for 'Full control' role or permission for 'add user' -->
                        <li class="nav-item">
                            <a class="nav-link submenu-link {{ request()->routeIs('user.create') ? 'active' : '' }}"
                                href="#">
                                <span>Add User</span>
                            </a>
                        </li>

                        <!-- Check for 'Full control' role or permission for 'view users' -->
                        <li class="nav-item">
                            <a class="nav-link submenu-link {{ request()->routeIs('user') ? 'active' : '' }}"
                                href="#">
                                <span>View Users</span>
                            </a>
                        </li>

                        <!-- Check for 'Full control' role or permission for 'edit user' -->
                        <li class="nav-item">
                            <a class="nav-link submenu-link {{ request()->routeIs('user.edit') ? 'active' : '' }}"
                                href="#">
                                <span>Edit Users</span>
                            </a>
                        </li>

                        <!-- Check for 'Full control' role or permission for 'delete user' -->
                        <li class="nav-item">
                            <a class="nav-link submenu-link {{ request()->routeIs('user.destroy') ? 'active' : '' }}"
                                href="#">
                                <span>Delete Users</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <!-- Collapsible menu with arrow toggle -->
            <li class="nav-item">
                <div
                    class="sidebar-link {{ request()->is('roles*') || request()->is('permissions*') ? 'active' : '' }}">
                    <a class="collapsed submenu" href="#">
                        <span class="icon">
                            <x-bi-person-plus class="icon-size" />
                        </span>
                        <div class="d-none d-md-inline text-truncate" style="max-width: 7.60rem;">
                            Roles & Permission
                        </div>
                    </a>
                    <span class="icon toggle-arrow d-none d-md-inline" data-bs-toggle="collapse"
                        data-bs-target="#rolessubmenu"
                        aria-expanded="{{ request()->is('roles*') ? 'true' : 'false' }}"
                        aria-controls="rolessubmenu">
                        @if (request()->is('roles*'))
                            <x-simpleline-arrow-up class="arrow-size" />
                        @else
                            <x-simpleline-arrow-down class="arrow-size" />
                        @endif
                    </span>
                </div>

                <div id="rolessubmenu" class="collapse">
                    <ul class="nav flex-column">
                        <!-- Check for 'Full control' role or permission for 'view roles' -->
                        <li class="nav-item">
                            <a class="nav-link submenu-link {{ request()->routeIs('roles.index') ? 'active' : '' }}"
                                href="#">
                                <span>Roles</span>
                            </a>
                        </li>

                        <!-- Check for 'Full control' role or permission for 'view permissions' -->
                        <li class="nav-item">
                            <a class="nav-link submenu-link {{ request()->routeIs('permissions.index') ? 'active' : '' }}"
                                href="#">
                                <span>Permissions</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <div id="loginUser" class="position-absolute">
            <ul class="nav flex-column">

                <!-- Settings -->
                <li class="nav-item">
                    <div class="sidebar-link {{ request()->is('settings*') ? 'active' : '' }}"
                        style="margin-bottom: 10px;">
                        <a class="collapsed submenu" href="{{ route('settings.index') }}"
                            style="justify-content: flex-start">
                            <span class="icon">
                                <x-bi-gear-fill class="icon-size" />
                            </span>
                            <span class="d-none d-md-inline"> Settings
                            </span>
                        </a>
                    </div>
                </li>

                <!-- Logout -->
                <li class="nav-item d-lg-none">
                    <div class="sidebar-link">
                        <a class="collapsed submenu" href="#" style="justify-content: flex-start">
                            <span class="d-lg-none"> <!-- Visible only on small screens -->
                                <!-- Logout Link -->
                                <form method="POST" action="#">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <x-simpleline-power class="icon-size" />
                                    </button>
                                </form>
                            </span>
                        </a>
                    </div>
                </li>


                <!-- Collapsible menu with arrow toggle -->
                <li class="nav-item position-relative">
                    <div class="sidebar-link profile">
                        <!-- Updated to have only one id for profileLink -->
                        <a id="profileLink" class="submenu d-flex align-items-center" data-bs-toggle="collapse"
                            href="#profilesubmenu" role="button" aria-expanded="false"
                            aria-controls="profilesubmenu" style="cursor: pointer;">
                            <!-- Person Circle Icon for Mobile -->
                            <span class=" d-block" id="mobileToggle">
                                <img id="userAvatar" class="user-avatar"
                                    src="https://ui-avatars.com/api/?&background=222831&color=ffffff&length=1&name=Yogesh"
                                    alt="Yogesh" />
                            </span>
                            <span class="d-none d-md-inline ms-2">
                                Yogesh<br>
                                <small>Yogerudra@gmail.com</small>
                            </span>
                        </a>
                    </div>

                    <div id="profilesubmenu" class="collapse dropup-menu">
                        <ul class="nav flex-column p-2">
                            <li class="nav-item">
                                <strong>Yogesh</strong><br>
                                <small class="text-muted">Yogesh@gmail.com</small>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="nav-item">
                                <!-- Logout Link -->
                                <form method="POST" action="#">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <x-bi-box-arrow-right class="icon-size me-2" /> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>




                <!-- Logout -->
                {{-- <li class="nav-item">
                <div class="sidebar-link">
                    <!-- Form for logging out -->
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <a class="collapsed submenu" href="#" style="justify-content: flex-start"
                            onclick="this.closest('form').submit(); return false;">
                            <span class="icon">
                                <x-bi-box-arrow-right class="icon-size" />
                            </span>
                            <span class="d-none d-md-inline">Logout</span>
                        </a>
                    </form>
                </div>
            </li> --}}
            </ul>
        </div>
    </div>
</nav>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const profileLink = document.getElementById("profileLink");

        // Ensure the profileLink exists before modifying it
        if (profileLink) {
            function updateProfileLink() {
                if (window.innerWidth < 992) { // Small screens (less than lg)
                    profileLink.removeAttribute("href");
                    profileLink.removeAttribute("data-bs-toggle");
                    profileLink.style.cursor = "default";
                } else { // Large screens
                    profileLink.setAttribute("href", "#profilesubmenu");
                    profileLink.setAttribute("data-bs-toggle", "collapse");
                    profileLink.style.cursor = "pointer";
                }
            }

            // Run profile link update on page load
            updateProfileLink();

            // Run profile link update on window resize
            window.addEventListener("resize", updateProfileLink);
        }
    });
</script>
