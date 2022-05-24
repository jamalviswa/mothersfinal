@extends('layouts.admin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Post Management
                </h3>
            </div>
           
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet">
            <div class="m-portlet__body">
                <!--begin::Section-->
                <div class="m-section__content">
                    <form method="GET" class="search-form form-inline" action="#">
                        <div class="form-group">
                            <input type="text" class="form-control" name="s" placeholder="Search"  @if(isset($_REQUEST['s'])) value="{{ $_REQUEST['s'] }}" @else value="" @endif/>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary m-btn m-btn--air m-btn--custom" type="submit" name="search"><i class="fa fa-search"></i></button>
                            <?php if (isset($_REQUEST['search'])) { ?>
                                <a class="btn btn-danger m-btn m-btn--air m-btn--custom" href="{{route('posts.index')}}"><i class="fa fa-times"></i></a>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="m-portlet">
            <div class="m-portlet__body">
                <!--begin::Section-->
                <div class="m-section">
                    <div class="m-section__content">

                        <div class="table-responsive">
                            <table class="table m-table m-table--head-bg-brand">
                                <thead>
                                    <tr>
                                        <th> S.No </th>
                                        <th>Name</th>
                                        <th>Mobile No</th>
                                        <th>Card No.</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Posted Date</th>
                                        <th>User Type</th>
                                        

                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody> 

                                    <tr>
                                        <td>1 </td>
                                        <td>John </td>
                                        <td>87452136</td>
                                        <td>1523</td>
                                        <td>Push Up</td>
                                        <td></td>
                                        <td>26/06/2021</td>
                                        <td>Premium User</td>
                                        <td>

                                            <a rel="tooltip" class="btn btn-secondary m-btn m-btn--air m-btn--custom" title="View" href="#">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a rel="tooltip" class="delete btn btn-secondary m-btn m-btn--air m-btn--custom"  title="Delete" href="#">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2 </td>
                                        <td>Joseph </td>
                                        <td>89745621</td>
                                        <td>1655</td>
                                        <td>Swimming</td>
                                        <td></td>
                                        <td>27/06/2021</td>
                                        <td>Free User</td>
                                        <td>
                                            <a rel="tooltip" class="btn btn-secondary m-btn m-btn--air m-btn--custom" title="View" href="#">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a rel="tooltip" class="delete btn btn-secondary m-btn m-btn--air m-btn--custom"  title="Delete" href="#">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3 </td>
                                        <td>Francis </td>
                                        <td>98745622</td>
                                        <td>1789</td>
                                        <td>Jump</td>
                                        <td></td>
                                        <td>28/06/2021</td>
                                        <td>Premium User</td>
                                        <td>
                                            <a rel="tooltip" class="btn btn-secondary m-btn m-btn--air m-btn--custom" title="View" href="#">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a rel="tooltip" class="delete btn btn-secondary m-btn m-btn--air m-btn--custom"  title="Delete" href="#">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4 </td>
                                        <td>Keith </td>
                                        <td>97854611</td>
                                        <td>5431</td>
                                        <td>Runing</td>
                                        <td></td>
                                        <td>29/06/2021</td>
                                        <td>PremiumUser</td>
                                        <td>
                                            <a rel="tooltip" class="btn btn-secondary m-btn m-btn--air m-btn--custom" title="View" href="#">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a rel="tooltip" class="delete btn btn-secondary m-btn m-btn--air m-btn--custom"  title="Delete" href="#">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .form-control:disabled, .form-control[readonly] {
        background-color: #F26C4F;
        opacity: 1;
        color: #fff;
        text-align: center;
        padding: 11px !important;
        font-size: 20px;
    }
</style>
@endsection
