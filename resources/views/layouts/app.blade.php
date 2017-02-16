<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Keranjang Sayur</title>
        
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <!-- custom CSS -->
        <link href="{{ asset('/libs/css/keranjangsayur.css') }}" rel="stylesheet" />        
        <link rel="shortcut icon" href="{{ asset('/images/favicon.ico') }}" type="image/x-icon">
        <link href="{{ asset('/libs/js/bootstrap/dist/css/bootstrap-chosen.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <link href="{{ asset('/libs/js/bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet" />
        
        <style>
            .navbar-inverse {
                background-color: #88AC25;
                border-color: #88AC25;
            }
        </style>
        
    </head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div id="page-title" class="display-none"></div>
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/home') }}"><img src="http://128.199.226.96/libs/images/logoks4.png" width="75%" heigh="75%" style="margin-top: -8px;"/></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <!-- dropdown navbar create -->
                    <li role="presentation" class="dropdown"><a class="dropdown-toogle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expended="false" style="color: white;">Create <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/category/create')}}" id="create_category">Create Category</a></li>
                            <li><a href="{{ url('/item/create')}}" id="create_item">Create Item</a></li>
                            <li><a href="{{ url('/unit/create') }}" id="create_unit">Create Unit</a></li>
                            <li><a href="{{ url('/highlight/create') }}" id="create_highlight">Create Highlight</a></li>
                        </ul>
                    </li>
                    
                    <!-- dropdown navbar show -->
                    <li role="presentation" class="dropdown"><a class="dropdown-toogle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expended="false" style="color: white;">Show <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/category/') }}" id="show_category">Show Category</a></li>
                            <li><a href="{{ url('/item/') }}" id="show_item">Show Item</a></li>
                            <li><a href="{{ url('/unit/') }}" id="show_unit">Show Unit</a></li>
                            <li><a href="{{ url('/highlight/') }}" id="show_highlight">Show Highlight</a></li>
                        </ul>
                    </li>
                    
                    <!-- dropdown navbar transaction -->
                    <li role="presentation" class="dropdown"><a class="dropdown-toogle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expended="false" style="color: white;">Transaction <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/invoice/create') }}" id="create_invoice">New Invoice</a></li>
                            <li><a href="{{ url('/invoice/') }}" id="show_invoice">Show Invoice</a></li>
                            <li><a href="{{ url('/test') }}" id="detail_packing">Daily Omzet</a></li>
                            <li><a href="javascript://" id="detail_packing_pisah">Detail Packing</a></li>
                            <li><a href="javascript://" id="shipping_invoice">Shipping Invoice</a></li>
                            <li><a href="{{ route('form_print_invoice_by_date') }}" id="export_invoice">Export Invoice</a></li>
                        </ul>
                    </li>

                    <li role="presentation" class="dropdown"><a class="dropdown-toogle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expended="false" style="color: white;">Customer <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/customer/create') }}" id="create_customer">Create Customer</a></li>
                            <li><a href="{{ url('/customer/') }}" id="show_customer">Show Customer</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <!-- dropdown navbar login -->
                    <li role="presentation" class="dropdown"><a class="dropdown-toogle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expended="false" style="color: white;">Logged as {{ Auth::user()->name }}<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php
                            $isEnabled = "";    
                            if(Auth::user()->level == 3){
                                $isEnabled = "";
                            } else {
                                $isEnabled = "disabled";
                            }
                            ?>
                            <li class="<?php echo $isEnabled; ?>"><a href="{{ url('/user/') }}" id="show-user" class="<?php echo $isEnabled; ?>">User Control</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form></li>
                        </ul>
                    </li>
                </ul>
            </div>
            
            <!--/.nav-collapse -->
        </div>
    </nav>
    <div class="container">
        <br/>
        <br/>
        @yield('content')
    </div>
    <br/>
    <br/>
    <!--<div id="footer">Keranjang Sayur &copy; 2016</div>-->

<!-- jQuery library -->
<script src="{{ asset('/libs/js/jquery.js') }}"></script>
<script src="{{ asset('/libs/js/chosen/chosen.jquery.js') }}"></script>
<script src="{{ asset('/libs/js/chosen/chosen.jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
 
<!-- bootstrap JavaScript -->
<!-- Latest compiled and minified JavaScript -->
<script src="{{ asset('/libs/js/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!--
<script src="http://128.199.226.96libs/js/script.js"></script>
-->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    getDataVoucher();
    $('.chosen-select').chosen({width : "300px"});
    
    function getDataVoucher(){
            $(".customerName").autocomplete({
                  source: 'http://localhost/new_ks/public/customerJson',
                  select: function(event, ui){
                    if(ui.item)
                    {
                        $.ajax({
                            type: "GET",
                            url: "http://localhost/new_ks/public/customer/voucher",
                            data: {customer_id:ui.item.id},
                            success: function(d){
                                $('#voucherChooser').empty();
                                $('#voucherChooser').append($('<option>').text(""));
                                $.each(d, function(i, a){
                                    $('#voucherChooser').append($('<option>').text(a.credit).attr('value', a.id));
                                    console.log(a.id);
                                });
                            }
                        });
                    }
                }
            });
            $('#voucherChooser').select2();
            $('#voucherChooser').change(function(){
                var sum = 0;
                $("#voucherChooser option:selected").each(function(){
                    sum += Number($(this).text());
                });
                $('.voucherResult').val(sum);
            }).trigger("change");
        }
</script>
    @yield('script')
</body>
</html>