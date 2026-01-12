<!--start header -->
<header class="top-header">
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand gap-3">
            <div class="mobile-toggle-menu"><i class='bx bx-menu text-light'></i>
            </div>

            <div class="top-menu ms-auto">
           

                <ul class="navbar-nav align-items-center gap-1">


                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative bg-light" href="#" data-bs-toggle="dropdown"><span class="alert-count">{{ $unreadNotifications ? count($unreadNotifications) : 0 }}</span>
                            <i class='bx bx-bell'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">Notification{{ count($unreadNotifications) > 1 ? 's' : '' }}</p>
                                    <p class="msg-header-badge">{{ $unreadNotifications ? count($unreadNotifications) : 0 }} non lue{{ count($unreadNotifications) > 1 ? 's' : '' }}</p>
                                </div>
                            </a>
                            <div class="header-notifications-list">
                               
                                @forelse($allNotifications as $notification)
                                <a class="dropdown-item d-block p-3 border-bottom notification-item {{ $notification->read_at ? 'read-notification' : 'unread-notification' }}" 
                                   href="{{ route('notif.markToRead', $notification->id) }}"
                                   data-id="{{ $notification->id }}">
                                    <div class="d-flex align-items-start">
                                   
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <strong class="text-dark">{{ $notification->data['user'] }}</strong>
                                                <small class="text-muted">{{ \Carbon\Carbon::parse($notification->data['date'])->diffForHumans() }}</small>
                                            </div>
                                            <p class="mb-1 text-wrap">{{ $notification->data['title'] }}</p>
                                            @if(!$notification->read_at)
                                                <span class="badge bg-light-info text-info rounded-pill">Nouveau</span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="text-center py-4">
                                    <i class='bx bx-bell-off fs-1 text-muted mb-2'></i>
                                    <p class="mb-0 text-muted">Aucune notification disponible</p>
                                </div>
                            @endforelse
                              
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown dropdown-large d-none">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">8</span>
                            <i class='bx bx-shopping-bag'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">My Cart</p>
                                    <p class="msg-header-badge">10 Items</p>
                                </div>
                            </a>
                            <div class="header-message-list">
                               
                            </div>
                            <a href="javascript:;">
                                <div class="text-center msg-footer">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h5 class="mb-0">Total</h5>
                                        <h5 class="mb-0 ms-auto">$489.00</h5>
                                    </div>
                                    <button class="btn btn-primary w-100">Checkout</button>
                                </div>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
         
            
           
            <div class="user-box dropdown px-3">
                <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" 
                   href="#" 
                   role="button" 
                   data-bs-toggle="dropdown" 
                   aria-expanded="false">
                    @if(Auth::user()->membre->photo != null && Auth::user()->membre->photo != '')
                        <img src="{{ asset('images/userProfile/' . Auth::user()->membre->photo) }}" class="user-img" alt="user avatar">
                    @else
                        <img src="{{ asset('root/images/login-images/default.png')}}" class="user-img" alt="user avatar">
                    @endif
                  
                    <!-- User Info -->
                    <div class="user-info text-white">
                        <p class="user-name mb-0 text-white fw-bold">
                            {{ Auth::user()->membre->nom ?? '' }} {{ Auth::user()->membre->prenom ?? '' }}
                        </p>
                        <p class="designation mb-0 text-white fst-italic">
                            {{ Auth::user()->membre->role ?? 'Role Indéfini' }}
                        </p>
                    </div>
                </a>
            
                <!-- Dropdown Menu -->
                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <!-- Profile Link -->
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('setting.user.profile')}}">
                            <i class="bx bx-user fs-5 me-2"></i> 
                            <span>Profil</span>
                        </a>
                    </li>
                    
                    <!-- Divider -->
                    <li>
                        <div class="dropdown-divider my-2"></div>
                    </li>
            
                    <!-- Logout -->
                    <li>
                        <a class="dropdown-item d-flex align-items-center text-danger" 
                           href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bx bx-exit fs-5 me-2"></i> 
                            <span>Se Déconnecter</span>
                        </a>
                        <!-- Hidden Logout Form -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
            
        </nav>
    </div>
</header>