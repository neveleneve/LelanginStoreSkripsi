<ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link text-success{{ Request::is('admin/dashboard') ? ' active fw-bold border-bottom border-success' : null }}"
            href="{{ route('admindashboard') }}">Dashboard</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link text-success{{ Request::is('admin/users') ? ' active fw-bold border-bottom border-success' : null }}"
            href="{{ route('adminusers') }}">Users</a>
    </li>
    @if (Auth::user()->role == 0)
        <li class="nav-item" role="presentation">
            <a class="nav-link text-success{{ Request::is('admin/administrators') ? ' active fw-bold border-bottom border-success' : null }}"
                href="{{ route('adminusersadmin') }}">Administrator</a>
        </li>
    @endif
    <li class="nav-item" role="presentation">
        <a class="nav-link text-success{{ Request::is('admin/payments') ? ' active fw-bold border-bottom border-success' : null }}"
            href="{{ route('adminpayments') }}">Payment</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link text-success{{ Request::is('admin/items') ? ' active fw-bold border-bottom border-success' : null }}"
            href="{{ route('adminitems') }}">Items</a>
    </li>
</ul>
