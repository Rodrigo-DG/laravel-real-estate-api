<ul>
    <li class="nav-item @if(request()->routeIs('home')) active @endif">
        <a href="{{ route('home') }}">
              <span class="icon">
                <svg width="22" height="22" viewBox="0 0 22 22">
                  <path
                          d="M17.4167 4.58333V6.41667H13.75V4.58333H17.4167ZM8.25 4.58333V10.0833H4.58333V4.58333H8.25ZM17.4167 11.9167V17.4167H13.75V11.9167H17.4167ZM8.25 15.5833V17.4167H4.58333V15.5833H8.25ZM19.25 2.75H11.9167V8.25H19.25V2.75ZM10.0833 2.75H2.75V11.9167H10.0833V2.75ZM19.25 10.0833H11.9167V19.25H19.25V10.0833ZM10.0833 13.75H2.75V19.25H10.0833V13.75Z"
                  />
                </svg>
              </span>
            <span class="text">{{ __('Inicio') }}</span>
        </a>
    </li>

    <li class="nav-item nav-item-has-children">
        <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#ddmenu_1"
           aria-controls="ddmenu_1" aria-expanded="true" aria-label="Toggle navigation">
            <i class="lni lni-home"></i>
            <span class="text ms-3">Propiedades</span>
        </a>
        <ul id="ddmenu_1" class="dropdown-nav collapse" style="">
            <li>
                <a href="{{ route('index.properties') }}">Lista de propiedades</a>
            </li>
            <li>
                <a href="{{ route('manage.properties') }}">Crear propiedad</a>
            </li>
        </ul>
    </li>

    <li class="nav-item nav-item-has-children">
        <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#ddmenu_2"
           aria-controls="ddmenu_2" aria-expanded="true" aria-label="Toggle navigation">
            <i class="lni lni-users"></i>
            <span class="text ms-3">Clientes</span>
        </a>
        <ul id="ddmenu_2" class="dropdown-nav collapse" style="">
            <li>
                <a href="{{ route('index.clients') }}">Lista de clientes</a>
            </li>
            <li>
                <a href="{{ route('manage.clients') }}">Crear cliente</a>
            </li>
        </ul>
    </li>

    <li class="nav-item nav-item-has-children">
        <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#ddmenu_3"
           aria-controls="ddmenu_3" aria-expanded="true" aria-label="Toggle navigation">
            <i class="lni lni-calendar"></i>
            <span class="text ms-3">Solicitudes de visitas</span>
        </a>
        <ul id="ddmenu_3" class="dropdown-nav collapse" style="">
            <li>
                <a href="{{ route('index.visits') }}">Lista de visitas</a>
            </li>
            <li>
                <a href="{{ route('manage.visits') }}">Crear visita</a>
            </li>
        </ul>
    </li>
</ul>