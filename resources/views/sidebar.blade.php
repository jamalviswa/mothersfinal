<?php
    preg_match('/([a-z]*)@/i', Route::getCurrentRoute()->getActionName(), $matches);
    $controller = $matches[1];
    $action = explode('@', Route::getCurrentRoute()->getActionName())[1];
?>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark">
    <!-- BEGIN: Aside Menu -->
    <div 
        id="m_ver_menu" 
        class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " 
        data-menu-vertical="true"
        data-menu-scrollable="false" data-menu-dropdown-timeout="500"  
    >
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow " data-controller="">
            <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  data-menu-submenu-toggle="click" aria-haspopup="true">
                <a href="" class="m-menu__link @if(($controller=='CustomersController' && $action=='personal_index') || 
                    ($controller=='CustomersController' && $action=='personal_view') || 
                    ($controller=='CustomersController' && $action=='personal_edit') || 
                    ($controller=='CustomersController' && $action=='personal_add') )   active @endif m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-users"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                CUSTOMER DETAILS
                            </span>
                        </span>
                    </span>
                </a>
                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--pull">
                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item " aria-haspopup="true" >
                                <a  href="{{route('customers.personal_index')}}" class="m-menu__link @if(($controller=='CustomersController' && $action=='personal_index') || 
                                    ($controller=='CustomersController' && $action=='personal_view') || 
                                    ($controller=='CustomersController' && $action=='personal_edit') || 
                                    ($controller=='CustomersController' && $action=='personal_add') )  active @endif">
                                    <i class="m-menu__link-icon flaticon-users"></i>
                                    <span class="m-menu__link-title">
                                        <span class="m-menu__link-wrap">
                                            <span class="m-menu__link-text">
                                                PERSONAL DETAILS
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item " aria-haspopup="true" >
                                <a  href="{{route('customers.official_index')}}" class="m-menu__link @if(($controller=='CustomersController' && $action=='official_index') || 
                                    ($controller=='CustomersController' && $action=='official_view') || 
                                    ($controller=='CustomersController' && $action=='official_edit') || 
                                    ($controller=='CustomersController' && $action=='official_add') )  active @endif">
                                    <i class="m-menu__link-icon flaticon-users"></i>
                                    <span class="m-menu__link-title">
                                        <span class="m-menu__link-wrap">
                                            <span class="m-menu__link-text">
                                                DOCUMENT DETAILS
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>                 
                        </ul>
                </div>
            </li>
            <li class="m-menu__item " aria-haspopup="true" >
                <a  href="{{route('costs.index')}}" class="m-menu__link @if(($controller=='CostsController' && $action=='index') || 
                    ($controller=='CostsController' &&$action=='view') || 
                    ($controller=='CostsController' &&$action=='edit') || 
                    ($controller=='CostsController' && $action=='add') )  active @endif">
                    <i class="m-menu__link-icon flaticon-file"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                COST DETAILS
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__item " aria-haspopup="true" >
                <a  href="{{route('payments.index')}}" class="m-menu__link @if(($controller=='PaymentsController' && $action=='index') || 
                    ($controller=='PaymentsController' &&$action=='view') || 
                    ($controller=='PaymentsController' &&$action=='edit') || 
                    ($controller=='PaymentsController' && $action=='add') )  active @endif">
                    <i class="m-menu__link-icon flaticon-file"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                PAYMENT DETAILS
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__item " aria-haspopup="true" >
                <a  href="{{route('receipts.index')}}" class="m-menu__link @if(($controller=='ReceiptsController' && $action=='index') || 
                    ($controller=='ReceiptsController' &&$action=='view') || 
                    ($controller=='ReceiptsController' &&$action=='edit') || 
                    ($controller=='ReceiptsController' && $action=='add') )  active @endif">
                    <i class="m-menu__link-icon flaticon-file"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                RECEIPT
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__item " aria-haspopup="true" >
                <a  href="{{route('blocks.index')}}" class="m-menu__link @if(($controller=='BlocksController' && $action=='index') || 
                    ($controller=='BlocksController' &&$action=='view') || 
                    ($controller=='BlocksController' &&$action=='edit') || 
                    ($controller=='BlocksController' && $action=='add') )  active @endif">
                    <i class="m-menu__link-icon flaticon-file"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                BLOCK DETAILS
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            @if($sessionadmin->adminname == "Admin")
            <li class="m-menu__item " aria-haspopup="true" >
                <a  href="{{route('adminusers.subadmin_index')}}" class="m-menu__link @if(($controller=='AdminusersController' && $action=='subadmin_index') || 
                    ($controller=='AdminusersController' &&$action=='subadmin_view') || 
                    ($controller=='AdminusersController' &&$action=='subadmin_edit') || 
                    ($controller=='AdminusersController' && $action=='subadmin_add') )  active @endif">
                    <i class="m-menu__link-icon flaticon-file"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                SUB ADMIN MGNT
                            </span>
                        </span>
                    </span>
                </a>
            </li>

           
           
<!-- /*Masters*/ -->
            <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  data-menu-submenu-toggle="click" aria-haspopup="true">
                <a href="" class="m-menu__link @if(($controller=='MastersController' && $action=='phase_index') || 
                    ($controller=='MastersController' && $action=='phase_edit') || 
                    ($controller=='MastersController' && $action=='phase_add') ||
                    ($controller=='MastersController' && $action=='block_add') ||
                    ($controller=='MastersController' && $action=='block_edit') || 
                    ($controller=='MastersController' && $action=='block_index') || 
                    ($controller=='MastersController' && $action=='floor_add') ||
                    ($controller=='MastersController' && $action=='floor_edit') || 
                    ($controller=='MastersController' && $action=='floor_index') || 
                    ($controller=='MastersController' && $action=='flattype_add') ||
                    ($controller=='MastersController' && $action=='flattype_edit') || 
                    ($controller=='MastersController' && $action=='flattype_index') || 
                    ($controller=='MastersController' && $action=='flatnumber_add') ||
                    ($controller=='MastersController' && $action=='flatnumber_edit') || 
                    ($controller=='MastersController' && $action=='flatnumber_index')  )   active @endif  m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-users"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                               MASTER
                            </span>
                        </span>
                    </span>
                </a>
                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--pull">
                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                        <ul class="m-menu__subnav"  href="{{route('masters.phase_index')}}" class="m-menu__link @if(($controller=='MastersController' && $action=='phase_index') || 
                                    ($controller=='MastersController' && $action=='phase_add') ||
                                    ($controller=='MastersController' && $action=='phase_edit') )  active @endif">
                            <li class="m-menu__item " aria-haspopup="true" >
                                <a  href="{{route('masters.phase_index')}}" class="m-menu__link @if(($controller=='MastersController' && $action=='phase_index') || 
                                    ($controller=='MastersController' && $action=='phase_add') ||
                                    ($controller=='MastersController' && $action=='phase_edit') )  active @endif">
                                    <i class="m-menu__link-icon flaticon-users"></i>
                                    <span class="m-menu__link-title">
                                        <span class="m-menu__link-wrap">
                                            <span class="m-menu__link-text">
                                                PHASE
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item" aria-haspopup="true" >
                                <a  href="{{route('masters.block_index')}}" class="m-menu__link @if(($controller=='MastersController' && $action=='block_index') || 
                                    ($controller=='MastersController' && $action=='block_add')   ||
                                    ($controller=='MastersController' && $action=='block_edit') )  active @endif">
                                    <i class="m-menu__link-icon flaticon-users"></i>
                                    <span class="m-menu__link-title">
                                        <span class="m-menu__link-wrap">
                                            <span class="m-menu__link-text">
                                                BLOCK
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item" aria-haspopup="true" >
                                <a  href="{{route('masters.floor_index')}}" class="m-menu__link @if(($controller=='MastersController' && $action=='floor_index') || 
                                    ($controller=='MastersController' && $action=='floor_add') ||
                                    ($controller=='MastersController' && $action=='floor_edit') )  active @endif">
                                    <i class="m-menu__link-icon flaticon-users"></i>
                                    <span class="m-menu__link-title">
                                        <span class="m-menu__link-wrap">
                                            <span class="m-menu__link-text">
                                                FLOOR
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item" aria-haspopup="true" >
                                <a  href="{{route('masters.flattype_index')}}" class="m-menu__link @if(($controller=='MastersController' && $action=='flattype_index') || 
                                ($controller=='MastersController' && $action=='flattype_add') ||
                                    ($controller=='MastersController' && $action=='flattype_edit') )  active @endif">
                                    <i class="m-menu__link-icon flaticon-users"></i>
                                    <span class="m-menu__link-title">
                                        <span class="m-menu__link-wrap">
                                            <span class="m-menu__link-text">
                                                FLAT TYPE
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item" aria-haspopup="true" >
                                <a  href="{{route('masters.flatnumber_index')}}" class="m-menu__link @if(($controller=='MastersController' && $action=='flatnumber_index') || 
                                    ($controller=='MastersController' && $action=='flatnumber_add') ||
                                    ($controller=='MastersController' && $action=='flatnumber_edit') )  active @endif">
                                    <i class="m-menu__link-icon flaticon-users"></i>
                                    <span class="m-menu__link-title">
                                        <span class="m-menu__link-wrap">
                                            <span class="m-menu__link-text">
                                                FLAT NUMBER
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                                         
                        </ul>
                </div>
            </li>
            @endif
            <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  data-menu-submenu-toggle="click" aria-haspopup="true">
                <a href="" class="m-menu__link @if(($controller=='DeletesController' && $action=='personal_index') || 
                    ($controller=='DeletesController' && $action=='personal_view') )   active @endif  m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-file"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                              TRASH RECORDS
                            </span>
                        </span>
                    </span>
                </a>
                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--pull">
                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                        <ul class="m-menu__subnav"  href="{{route('deletes.personal_index')}}" class="m-menu__link @if(($controller=='DeletesController' && $action=='personal_index') || 
                                    ($controller=='DeletesController' && $action=='personal_view') )  active @endif">
                            <li class="m-menu__item " aria-haspopup="true" >
                                <a  href="{{route('deletes.personal_index')}}" class="m-menu__link @if(($controller=='DeletesController' && $action=='personal_index') || 
                                    ($controller=='DeletesController' && $action=='personal_view')  )  active @endif">
                                    <i class="m-menu__link-icon flaticon-users"></i>
                                    <span class="m-menu__link-title">
                                        <span class="m-menu__link-wrap">
                                            <span class="m-menu__link-text">
                                                PERSONAL DETAILS
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item " aria-haspopup="true" >
                                <a  href="{{route('deletes.official_index')}}" class="m-menu__link @if(($controller=='DeletesController' && $action=='official_index') || 
                                    ($controller=='DeletesController' && $action=='official_view')  )  active @endif">
                                    <i class="m-menu__link-icon flaticon-users"></i>
                                    <span class="m-menu__link-title">
                                        <span class="m-menu__link-wrap">
                                            <span class="m-menu__link-text">
                                                DOCUMENT DETAILS
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                           
                            <li class="m-menu__item " aria-haspopup="true" >
                                <a  href="{{route('deletes.cost_index')}}" class="m-menu__link @if(($controller=='DeletesController' && $action=='cost_index') || 
                                    ($controller=='DeletesController' && $action=='cost_view')  )  active @endif">
                                    <i class="m-menu__link-icon flaticon-file"></i>
                                    <span class="m-menu__link-title">
                                        <span class="m-menu__link-wrap">
                                            <span class="m-menu__link-text">
                                                COST DETAILS
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item " aria-haspopup="true" >
                                <a  href="{{route('deletes.payment_index')}}" class="m-menu__link @if(($controller=='DeletesController' && $action=='payment_index') || 
                                    ($controller=='DeletesController' && $action=='payment_view')  )  active @endif">
                                    <i class="m-menu__link-icon flaticon-file"></i>
                                    <span class="m-menu__link-title">
                                        <span class="m-menu__link-wrap">
                                            <span class="m-menu__link-text">
                                                PAYMENT DETAILS
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item " aria-haspopup="true" >
                                <a  href="{{route('deletes.receipt_index')}}" class="m-menu__link @if(($controller=='DeletesController' && $action=='receipt_index') || 
                                    ($controller=='DeletesController' && $action=='receipt_view')  )  active @endif">
                                    <i class="m-menu__link-icon flaticon-file"></i>
                                    <span class="m-menu__link-title">
                                        <span class="m-menu__link-wrap">
                                            <span class="m-menu__link-text">
                                               RECEIPT
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                           
                           
                         
                                         
                        </ul>
                </div>
            </li>

           
         

            
            <li class="m-menu__item " aria-haspopup="true" >
                <a href="<?php echo url('/adminusers/logout'); ?>" class="m-menu__link">
                    <i class="m-menu__link-icon flaticon-logout"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                LOGOUT
                            </span>
                        </span>
                    </span>
                </a>
            </li>
        </ul>
    </div>
    <!-- END: Aside Menu -->
</div>
<style>
    .m-aside-left.m-aside-left--skin-dark {
        background-color: #4AB0CF !important;
    }
</style>