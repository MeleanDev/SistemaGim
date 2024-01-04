<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{route('home')}}" class="app-brand-link">
      <span class="app-brand-logo demo">
        
      </span>
      <span class="app-brand-text demo menu-text fw-bolder ms-2">Sistema Gim</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item {{ request()->is('home') ? 'active' : '' }}">
      <a href="{{route('home')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Panel de Control</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-dock-top"></i>
        <div data-i18n="Account Settings">General</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->is('Clientes') ? 'active' : '' }}">
          <a href="{{ route('clientes') }}" class="menu-link">
            <div data-i18n="Account">Clientes</div>
          </a>
        </li>
        <li class="menu-item {{ request()->is('Personal') ? 'active' : '' }}">
          <a href="{{ route('personal') }}" class="menu-link">
            <div data-i18n="Notifications">Personal</div>
          </a>
        </li>
        <li class="menu-item {{ request()->is('Reportes-Pago') ? 'active' : '' }}">
          <a href="{{ route('registropago') }}" class="menu-link">
            <div data-i18n="Notifications">Reporte de pagos</div>
          </a>
        </li>
      </ul>
    </li>
    <!-- nuevos menu -->
  </ul>
</aside>