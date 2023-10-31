 <!-- Layout wrapper -->
 <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="text-center">
        <img src="{{url('/assets/img/logobulat.png')}}"  width="90"/>
        </div>

          <div class="app-brand demo">

            <a href="{{route('dashboard')}}" class="app-brand-link">
            <div class="text-center">
              <b>PT.Karya Indah Trasindo</b>
            </div>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item">
            <a href="{{route('dashboard')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>
            <!-- Forms & Tables -->
            <!-- <li class="menu-header small text-uppercase"><span class="menu-header-text">Forms &amp; Tables</span></li> -->
            <!-- Forms -->

            <!-- <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Users">Users</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{route('admin.user.index')}}" class="menu-link">
                    <div data-i18n="Vertical Form">List Users</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="form-layouts-horizontal.html" class="menu-link">
                    <div data-i18n="Horizontal Form">Tambah Users</div>
                  </a>
                </li>
              </ul>
            </li> -->

            @auth
            @if(Auth::user()->role_id == 1)
            <li class="menu-item">
              <a href="{{route('admin.user.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Pengguna</div>
              </a>
            </li>
            @endif
            @if(Auth::user()->role_id == 1)
            <li class="menu-item">
              <a href="{{route('admin.barangmasuk.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Barang Masuk</div>
              </a>
            </li>
            @endif
            @if(Auth::user()->role_id == 3)
            <li class="menu-item">
              <a href="{{route('admin.updatekiriman')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Update Kiriman</div>
              </a>
            </li>
            @endif
            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3)

            <li class="menu-item">
            <a href="{{route('admin.history')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">history</div>
              </a>
            </li>
            @endif

            @if(Auth::user()->role_id == 1)
            <li class="menu-item">
              <a href="{{route('admin.cargomanifest.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Cargo Manifest</div>
              </a>
            </li>
            @endif
          
            @if(Auth::user()->role_id == 1)
            <li class="menu-item">
              <a href="{{route('admin.daftarkiriman.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Daftar Kiriman</div>
              </a>
            </li>
            @endif

            @endauth

            <li class="menu-item">
              <a href="{{route('cekongkir')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Cek Ongkir</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="{{route('tracking')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Tracking</div>
              </a>
            </li>



            <!-- Tables -->
            <!-- <li class="menu-item active">
              <a href="tables-basic.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-table"></i>
                <div data-i18n="Tables">Tables</div>
              </a>
            </li> -->
            <!-- Misc -->
            <!-- <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li> -->
            <!-- <li class="menu-item">
              <a
                href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                target="_blank"
                class="menu-link"
              >
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Support">Support</div>
              </a>
            </li> -->
            <!-- <li class="menu-item">
              <a
                href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                target="_blank"
                class="menu-link"
              >
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Documentation">Documentation</div>
              </a>
            </li> -->
          </ul>
        </aside>
        <!-- / Menu -->
