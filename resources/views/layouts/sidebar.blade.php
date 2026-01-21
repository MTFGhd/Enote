<aside class="provided-sidebar">
    <nav>
        <ul class="flex flex-col h-full">
            <li class="flex justify-center">
                <a href="{{ route('dashboard') }}" class="logo-link !p-0 !bg-transparent">
                    <img src="{{ asset('enote-logo.png') }}" alt="{{ config('app.name', 'Enote') }}" class="logo-img">
                </a>
            </li>
            <li>
                <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">
                    <i class="bx bx-home"></i>
                    <span>Accueil</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bx bx-tachometer"></i>
                    <span>Tableau</span>
                </a>
            </li>

            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'D')
            <li>
                <a href="{{ route('avancement.index') }}" class="{{ request()->routeIs('avancement.*') ? 'active' : '' }}">
                    <i class="bx bx-bar-chart-alt-2"></i>
                    <span>Avancement</span>
                </a>
            </li>
            <li>
                <a href="{{ route('cours.index') }}" class="{{ request()->routeIs('cours.*') ? 'active' : '' }}">
                    <i class="bx bx-book-open"></i>
                    <span>Cours</span>
                </a>
            </li>
            <li>
                <a href="{{ route('etudiants.index') }}" class="{{ request()->routeIs('etudiants.*') ? 'active' : '' }}">
                    <i class="bx bx-group"></i>
                    <span>Étudiants</span>
                </a>
            </li>
            <li>
                <a href="{{ route('absence.index') }}" class="{{ request()->routeIs('absence.*') ? 'active' : '' }}">
                    <i class="bx bx-calendar-x"></i>
                    <span>Absences</span>
                </a>
            </li>
            <li>
                <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <i class="bx bx-user-plus"></i>
                    <span>Utilisateurs</span>
                </a>
            </li>
            <li>
                <a href="{{ route('enseignants.index') }}" class="{{ request()->routeIs('enseignants.*') ? 'active' : '' }}">
                    <i class="bx bx-id-card"></i>
                    <span>Enseignants</span>
                </a>
            </li>
            <li>
                <a href="{{ route('departements.index') }}" class="{{ request()->routeIs('departements.*') ? 'active' : '' }}">
                    <i class="bx bx-building"></i>
                    <span>Départements</span>
                </a>
            </li>
            <li>
                <a href="{{ route('classes.index') }}" class="{{ request()->routeIs('classes.*') ? 'active' : '' }}">
                    <i class="bx bx-group"></i>
                    <span>Classes</span>
                </a>
            </li>
            <li>
                <a href="{{ route('matieres.index') }}" class="{{ request()->routeIs('matieres.*') ? 'active' : '' }}">
                    <i class="bx bx-book"></i>
                    <span>Matières</span>
                </a>
            </li>
            @else
             <li>
                <a href="{{ route('cours.index') }}" class="{{ request()->routeIs('cours.*') ? 'active' : '' }}">
                    <i class="bx bx-book-open"></i>
                    <span>Mes Cours</span>
                </a>
            </li>
            @endif

            <li>
                <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                    <i class="bx bx-cog"></i>
                    <span>Paramètres</span>
                </a>
            </li>
            <li>
                <!-- Wrap form inside li correctly -->
                <form method="POST" action="{{ route('logout') }}" id="logout-form" class="hidden">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bx bx-log-out"></i>
                    <span>Déconnexion</span>
                </a>
            </li>
            <li>
                <a href="#" data-resize-btn>
                    <i class="bx bx-chevrons-right"></i>
                    <span>Réduire</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
