<!DOCTYPE html>
<html lang="en">

<head>

    @stack('title')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/style.css') }}">

</head>

<body>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            <div class="p-4 pt-5">
                <h1><a href="/" class="logo">All March</a></h1>
                <ul class="list-unstyled components mb-5">
                    <li class="active">
                        <a href="#salesSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Sales </a>
                        <ul class="collapse list-unstyled" id="salesSubmenu">
                            <li>
                                <a href="#">sales 1</a>
                            </li>
                            <li>
                                <a href="#">sales 2</a>
                            </li>
                            <li>
                                <a href="#">sales 3</a>
                            </li>
                        </ul>
                    </li>
                  
                    <li>
                        <a href="#accountsSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Accounts </a>
                        <ul class="collapse list-unstyled" id="accountsSubmenu">
                            <li>
                                <a href="#">accounts 1</a>
                            </li>
                            <li>
                                <a href="#">accounts 2</a>
                            </li>
                            <li>
                                <a href="#">accounts 3</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#employeeSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Employee </a>
                        <ul class="collapse list-unstyled" id="employeeSubmenu">
                            <li>
                                <a href="{{url('/employee/create')}}">Add Employee</a>
                            </li>
                            <li>
                                <a href="{{url('/employee/list')}}">Employees</a>
                            </li>
                            <li>
                                <a href="#">employee 3</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#productSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Product </a>
                        <ul class="collapse list-unstyled" id="productSubmenu">
                            <li>
                                <a href="{{url('/product/create')}}">Add Product</a>
                            </li>
                            <li>
                                <a href="{{url('/product/list')}}">Products</a>
                            </li>
                            <li>
                                <a href="#">product 3</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#customerSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Customer </a>
                        <ul class="collapse list-unstyled" id="customerSubmenu">
                            <li>
                                <a href="{{url('/customer/create')}}">Add Customer</a>
                            </li>
                            <li>
                                <a href="{{url('/customer/list')}}">Customers</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/auth/logout">Logout</a>
                    </li>
                </ul>
               
            </div>
        </nav>

        