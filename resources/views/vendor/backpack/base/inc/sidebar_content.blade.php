<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class='nav-item'><a class='nav-link' href="{{ backpack_url('client') }}"><i class='nav-icon fa fa-users'></i> Pengguna</a></li>
<li class='nav-item'><a class='nav-link' href="{{ backpack_url('book') }}"><i class='nav-icon fa fa-book'></i> Buku</a></li>
<li class='nav-item'><a class='nav-link' href="{{ backpack_url('archive') }}"><i class='nav-icon fa fa-database'></i> Peminjaman</a></li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-cogs"></i> Lanjutan</a>
    <ul class="nav-dropdown-items">
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('log') }}"><i class="nav-icon fa fa-terminal"></i> <span> Log</span></a></li>
    </ul>
</li>

<!-- <li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-database"></i> Peminjaman</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href="{{ backpack_url('archive') }}?type=pending "><i class='nav-icon fa fa-circle'></i> Tertunda</a></li>
        <li class='nav-item'><a class='nav-link' href="{{ backpack_url('creditor') }}"><i class='nav-icon fa fa-square-o'></i> Berlangsung</a></li>
        <li class='nav-item'><a class='nav-link' href="{{ backpack_url('order') }}"><i class='nav-icon fa fa-check-square-o'></i> Selesai</a></li>
    </ul>
</li> -->