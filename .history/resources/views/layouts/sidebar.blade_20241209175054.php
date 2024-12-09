<nav id="sidebar" class="col-md-3 col-lg-2 sidebar">
    <div id="userprofile" class="position-relative" style="height: 100%">
        <ul class="nav flex-column">
            <!-- Dashboard -->
            <li class="nav-item">
                <div class="sidebar-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a class="collapsed submenu" href="{{ route('home') }}" style="justify-content: flex-start">
                        <span class="icon">
                            <x-simpleline-home class="icon-size" />
                        </span>
                        <span class="d-none d-md-inline">
                            Dashboard
                        </span>
                    </a>
                </div>
            </li>

            <!-- Manage Shops with unique ID and target -->
                <li class="nav-item">
                    <div class="sidebar-link {{ request()->is('shop*') ? 'active' : '' }}">
                        <a class="collapsed submenu" href="#">
                            <span class="icon">
                                {{-- <x-bi-shop class="icon-size" /> --}}
                            </span>
                            <span class="d-none d-md-inline">
                                Shop
                            </span>
                        </a>
                        <span class="icon toggle-arrow d-none d-md-inline" data-bs-toggle="collapse"
                            data-bs-target="#shopSubmenu" aria-expanded="false" aria-controls="shopSubmenu">
                            @if (request()->has('shopSubmenu') && request('shopSubmenu') == 'expanded')
                                <x-simpleline-arrow-up class="arrow-size" />
                            @else
                                <x-simpleline-arrow-down class="arrow-size" />
                            @endif
                        </span>
                    </div>

                    <div id="shopSubmenu" class="collapse">
                        <ul class="nav flex-column">
                            @if (auth()->user()->can('Full control') || auth()->user()->can('create shop'))
                                <li class="nav-item">
                                    <a class="nav-link submenu-link {{ request()->routeIs('shop.create') ? 'active' : '' }}"
                                        href="#">
                                        <span>Add Shop</span>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->can('Full control') || auth()->user()->can('view shop'))
                                <li class="nav-item">
                                    <a class="nav-link submenu-link {{ request()->routeIs('shop') ? 'active' : '' }}"
                                        href="#">
                                        <span>View Shops</span>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->can('Full control') || auth()->user()->can('edit shop'))
                                <li class="nav-item">
                                    <a class="nav-link submenu-link" href="#">
                                        <span>Edit Shop</span>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->can('Full control') || auth()->user()->can('delete shop'))
                                <li class="nav-item">
                                    <a class="nav-link submenu-link" href="#">
                                        <span>Delete Shop</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
            </li>


            <!-- Inventory Management with unique ID and target -->
                <li class="nav-item">
                    <div class="sidebar-link {{ request()->is('inventory*') ? 'active' : '' }}">
                        <a class="collapsed submenu" href="#">
                            <span class="icon">
                                <x-bi-boxes class="icon-size" />
                            </span>
                            <span class="d-none d-md-inline">
                                Inventory
                            </span>
                        </a>
                        <span class="icon toggle-arrow d-none d-md-inline" data-bs-toggle="collapse"
                            data-bs-target="#inventorySubmenu" aria-expanded="false" aria-controls="inventorySubmenu">
                            @if (request()->has('inventorySubmenu') && request('inventorySubmenu') == 'expanded')
                                <x-simpleline-arrow-up class="arrow-size" />
                            @else
                                <x-simpleline-arrow-down class="arrow-size" />
                            @endif
                        </span>
                    </div>

                    <div id="inventorySubmenu" class="collapse">
                        <ul class="nav flex-column">
                            <!-- Check for 'Full control' role or permission for 'create inventory' -->
                            @if (auth()->user()->can('Full control') || auth()->user()->can('create inventory'))
                                <li class="nav-item">
                                    <a class="nav-link submenu-link {{ request()->routeIs('inventory.create') ? 'active' : '' }}"
                                        href="#">
                                        <span>Add Inventory</span>
                                    </a>
                                </li>
                            @endif

                            <!-- Check for 'Full control' role or permission for 'view inventory' -->
                            @if (auth()->user()->can('Full control') || auth()->user()->can('view inventory'))
                                <li class="nav-item">
                                    <a class="nav-link submenu-link {{ request()->routeIs('inventory') ? 'active' : '' }}"
                                        href="#">
                                        <span>View Inventory</span>
                                    </a>
                                </li>
                            @endif

                            <!-- Check for 'Full control' role or permission for 'edit inventory' -->
                            @if (auth()->user()->can('Full control') || auth()->user()->can('edit inventory'))
                                <li class="nav-item">
                                    <a class="nav-link submenu-link" href="#">
                                        <span>Edit Inventory</span>
                                    </a>
                                </li>
                            @endif

                            <!-- Check for 'Full control' role or permission for 'delete inventory' -->
                            @if (auth()->user()->can('Full control') || auth()->user()->can('delete inventory'))
                                <li class="nav-item">
                                    <a class="nav-link submenu-link" href="#">
                                        <span>Delete Inventory</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
            </li>




            <!-- Sales Management with unique ID and target -->
                <li class="nav-item">

                    <div class="sidebar-link {{ request()->is('sales*') ? 'active' : '' }}">
                        <a class="collapsed submenu" href="#">
                            <span class="icon">
                                <x-bi-graph-up class="icon-size" />
                            </span>
                            <span class="d-none d-md-inline">
                                Sales
                            </span>
                        </a>
                        <!-- Arrow icon to toggle submenu -->
                        <span class="icon toggle-arrow d-none d-md-inline" data-bs-toggle="collapse"
                            data-bs-target="#salesSubmenu" aria-expanded="false" aria-controls="salesSubmenu">
                            @if (request()->has('salesSubmenu') && request('salesSubmenu') == 'expanded')
                                <x-simpleline-arrow-up class="arrow-size" />
                            @else
                                <x-simpleline-arrow-down class="arrow-size" />
                            @endif
                        </span>
                    </div>

                    <div id="salesSubmenu" class="collapse">
                        <ul class="nav flex-column">
                            <!-- Check for 'Full control' role or permission for 'create sale' -->
                            @if (auth()->user()->can('Full control') || auth()->user()->can('create sales'))
                                <li class="nav-item">
                                    <a class="nav-link submenu-link {{ request()->routeIs('sales.create') ? 'active' : '' }}"
                                        href="#">
                                        <span>Add Sale</span>
                                    </a>
                                </li>
                            @endif

                            <!-- Check for 'Full control' role or permission for 'view sale' -->
                            @if (auth()->user()->can('Full control') || auth()->user()->can('view sales'))
                                <li class="nav-item">
                                    <a class="nav-link submenu-link {{ request()->routeIs('sales') ? 'active' : '' }}"
                                        href="#">
                                        <span>View Sales</span>
                                    </a>
                                </li>
                            @endif

                            <!-- Check for 'Full control' role or permission for 'edit sale' -->
                            @if (auth()->user()->can('Full control') || auth()->user()->can('edit sales'))
                                <li class="nav-item">
                                    <a class="nav-link submenu-link" href="#">
                                        <span>Edit Sale</span>
                                    </a>
                                </li>
                            @endif

                            <!-- Check for 'Full control' role or permission for 'delete sale' -->
                            @if (auth()->user()->can('Full control') || auth()->user()->can('delete sales'))
                                <li class="nav-item">
                                    <a class="nav-link submenu-link" href="#">
                                        <span>Delete Sale</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
            </li>




            <!-- Sidebar link for Purchase Management with collapsible submenu for CRUD operations -->
                <li class="nav-item">
                    <div class="sidebar-link {{ request()->is('purchase*') ? 'active' : '' }}">
                        <a class="collapsed submenu" href="#">
                            <span class="icon">
                                <x-bi-cart class="icon-size" />
                            </span>
                            <span class="d-none d-md-inline">
                                Purchase
                            </span>
                        </a>
                        <span class="icon toggle-arrow d-none d-md-inline" data-bs-toggle="collapse"
                            data-bs-target="#purchaseSubmenu" aria-expanded="false" aria-controls="purchaseSubmenu">
                            @if (request()->has('purchaseSubmenu') && request('purchaseSubmenu') == 'expanded')
                                <x-simpleline-arrow-up class="arrow-size" />
                            @else
                                <x-simpleline-arrow-down class="arrow-size" />
                            @endif
                        </span>
                    </div>

                    <div id="purchaseSubmenu" class="collapse">
                        <ul class="nav flex-column">
                            <!-- Check for 'Full control' role or permission for 'create purchase' -->
                            @if (auth()->user()->can('Full control') || auth()->user()->can('create purchase'))
                                <li class="nav-item">
                                    <a class="nav-link submenu-link {{ request()->routeIs('purchase.create') ? 'active' : '' }}"
                                        href="#">
                                        <span>Add Purchase</span>
                                    </a>
                                </li>
                            @endif

                            <!-- Check for 'Full control' role or permission for 'view purchase' -->
                            @if (auth()->user()->can('Full control') || auth()->user()->can('view purchase'))
                                <li class="nav-item">
                                    <a class="nav-link submenu-link {{ request()->routeIs('purchase') ? 'active' : '' }}"
                                        href="#">
                                        <span>View Purchases</span>
                                    </a>
                                </li>
                            @endif

                            <!-- Check for 'Full control' role or permission for 'edit purchase' -->
                            @if (auth()->user()->can('Full control') || auth()->user()->can('edit purchase'))
                                <li class="nav-item">
                                    <a class="nav-link submenu-link" href="#">
                                        <span>Edit Purchase</span>
                                    </a>
                                </li>
                            @endif

                            <!-- Check for 'Full control' role or permission for 'delete purchase' -->
                            @if (auth()->user()->can('Full control') || auth()->user()->can('delete purchase'))
                                <li class="nav-item">
                                    <a class="nav-link submenu-link" href="#">
                                        <span>Delete Purchase</span>
                                    </a>
                                </li>
                            @endif
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
                            @if (auth()->user()->can('Full control') || auth()->user()->can('create expense'))
                                <li class="nav-item">
                                    <a class="nav-link submenu-link {{ request()->routeIs('expense.create') ? 'active' : '' }}"
                                        href="#">
                                        <span>Create Expense</span>
                                    </a>
                                </li>
                            @endif

                            <!-- Check for 'Full control' role or permission for 'view expense' -->
                            @if (auth()->user()->can('Full control') || auth()->user()->can('view expense'))
                                <li class="nav-item">
                                    <a class="nav-link submenu-link {{ request()->routeIs('expense') ? 'active' : '' }}"
                                        href="#">
                                        <span>View Expenses</span>
                                    </a>
                                </li>
                            @endif

                            <!-- Check for 'Full control' role or permission for 'edit expense' -->
                            @if (auth()->user()->can('Full control') || auth()->user()->can('edit expense'))
                                <li class="nav-item">
                                    <a class="nav-link submenu-link" href="#">
                                        <span>Edit Expense</span>
                                    </a>
                                </li>
                            @endif

                            <!-- Check for 'Full control' role or permission for 'delete expense' -->
                            @if (auth()->user()->can('Full control') || auth()->user()->can('delete expense'))
                                <li class="nav-item">
                                    <a class="nav-link submenu-link" href="#">
                                        <span>Delete Expense</span>
                                    </a>
                                </li>
                            @endif
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
                            @if (auth()->user()->can('Full control') || auth()->user()->can('add user'))
                                <li class="nav-item">
                                    <a class="nav-link submenu-link {{ request()->routeIs('user.create') ? 'active' : '' }}"
                                        href="#">
                                        <span>Add User</span>
                                    </a>
                                </li>
                            @endif

                            <!-- Check for 'Full control' role or permission for 'view users' -->
                            @if (auth()->user()->can('Full control') || auth()->user()->can('view users'))
                                <li class="nav-item">
                                    <a class="nav-link submenu-link {{ request()->routeIs('user') ? 'active' : '' }}"
                                        href="#">
                                        <span>View Users</span>
                                    </a>
                                </li>
                            @endif

                            <!-- Check for 'Full control' role or permission for 'edit user' -->
                            @if (auth()->user()->can('Full control') || auth()->user()->can('edit user'))
                                <li class="nav-item">
                                    <a class="nav-link submenu-link {{ request()->routeIs('user.edit') ? 'active' : '' }}"
                                        href="#">
                                        <span>Edit Users</span>
                                    </a>
                                </li>
                            @endif

                            <!-- Check for 'Full control' role or permission for 'delete user' -->
                            @if (auth()->user()->can('Full control') || auth()->user()->can('delete user'))
                                <li class="nav-item">
                                    <a class="nav-link submenu-link {{ request()->routeIs('user.destroy') ? 'active' : '' }}"
                                        href="#">
                                        <span>Delete Users</span>
                                    </a>
                                </li>
                            @endif
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
                            @if (auth()->user()->can('Full control') || auth()->user()->can('view roles'))
                                <li class="nav-item">
                                    <a class="nav-link submenu-link {{ request()->routeIs('roles.index') ? 'active' : '' }}"
                                        href="#">
                                        <span>Roles</span>
                                    </a>
                                </li>
                            @endif

                            <!-- Check for 'Full control' role or permission for 'view permissions' -->
                            @if (auth()->user()->can('Full control') || auth()->user()->can('view permissions'))
                                <li class="nav-item">
                                    <a class="nav-link submenu-link {{ request()->routeIs('permissions.index') ? 'active' : '' }}"
                                        href="{{ route('permissions.index') }}">
                                        <span>Permissions</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
            </li>
        </ul>
        <div id="loginUser" class="position-absolute">
            <ul class="nav flex-column">

                <!-- Settings -->
                <li class="nav-item">
                    <div class="sidebar-link {{ request()->routeIs('settings.index') ? 'settings-active' : '' }}" style="margin-bottom: 10px;">
                        <a class="collapsed submenu" href="{{ route('settings.index') }}" style="justify-content: flex-start">
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
                                <form method="POST" action="{{ route('logout') }}">
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
                        <a id="user-info" class="submenu d-flex align-items-center" id="profileLink" data-bs-toggle="collapse"
                            href="#profilesubmenu" role="button" aria-expanded="false"
                            aria-controls="profilesubmenu" style="cursor: pointer;">
                            <!-- Person Circle Icon for Mobile -->
                            <span class=" d-block" id="mobileToggle">
                                <img id="userAvatar" class="user-avatar"
                                    src="https://ui-avatars.com/api/?&background=222831&color=ffffff&length=1&name={{ urlencode(auth()->user()->username) }}"
                                    alt="{{ auth()->user()->username }}" />
                            </span>
                            <span class="d-none d-md-inline ms-2">
                                {{ \Illuminate\Support\Str::limit(ucfirst(auth()->user()->username), 15, '...') }}<br>
                                <small>{{ \Illuminate\Support\Str::limit(auth()->user()->email, 15, '...') }}</small>
                            </span>
                        </a>
                    </div>

                    <div id="profilesubmenu" class="collapse dropup-menu">
                        <ul class="nav flex-column p-2">
                            <li class="nav-item">
                                <strong>{{ auth()->user()->username }}</strong><br>
                                <small class="text-muted">{{ auth()->user()->email }}</small>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="nav-item">
                                <!-- Logout Link -->
                                <form method="POST" action="{{ route('logout') }}">
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
        const submenus = document.querySelectorAll('.collapse'); // All submenu divs
        const toggleArrows = document.querySelectorAll('.toggle-arrow'); // All toggle arrows

        // Function to toggle the arrow direction based on collapse state
        function toggleArrow(arrow, expanded) {
            if (expanded) {
                arrow.innerHTML = '<x-simpleline-arrow-down class="arrow-size" />'; // Show down arrow
            } else {
                arrow.innerHTML = '<x-simpleline-arrow-up class="arrow-size" />'; // Show up arrow
            }
            arrow.setAttribute('aria-expanded', !expanded);
        }

        // Function to close all submenus except the currently targeted one
        function closeOtherSubmenus(currentId) {
            submenus.forEach(submenu => {
                if (submenu.id !== currentId) {
                    submenu.classList.remove('show'); // Collapse other submenus
                }
            });

            // Reset arrows for non-active submenus
            toggleArrows.forEach(arrow => {
                const targetId = arrow.getAttribute('data-bs-target').replace('#', '');
                if (targetId !== currentId) {
                    toggleArrow(arrow, true); // Reset to collapsed state (down arrow)
                }
            });
        }

        // Add event listeners to toggle arrows
        toggleArrows.forEach(arrow => {
            arrow.addEventListener('click', function() {
                const targetId = arrow.getAttribute('data-bs-target').replace('#', '');
                const targetElement = document.querySelector(`#${targetId}`);
                const expanded = arrow.getAttribute('aria-expanded') === 'true';

                // Close other submenus before toggling this one
                closeOtherSubmenus(targetId);

                // Toggle the current submenu
                if (expanded) {
                    targetElement.classList.remove('show'); // Collapse current submenu
                } else {
                    targetElement.classList.add('show'); // Expand current submenu
                }

                // Update the arrow direction for the current toggle
                toggleArrow(arrow, expanded);
            });
        });

        // Profile link behavior adjustment for responsiveness
        const profileLink = document.getElementById("profileLink");

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
    });
</script>
