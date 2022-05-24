@extends('layouts.admin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Cost Details List
                </h3>
            </div>
            
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet">
            <div class="m-portlet__body">
                <!--begin::Section-->
                <div class="m-section__content    ">
                    <form method="GET" class="search-form form-inline " action="#">
                    <div class="form-group">
                            <select class="form-control" name="application_number">
                                @php
                                $customers = App\Document::where('status','Active')->orderby('application_number','asc')->get();
                                @endphp
                                <option value="">Select Application Number</option>
                                @foreach($customers as $customer)
                                <option @if(isset($_REQUEST['application_number']) && $_REQUEST['application_number']==$customer['application_number']) selected @endif value="{{ $customer['application_number'] }}">{{ $customer['application_number'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="applicant_name">
                                @php
                                $customers = App\Document::where('status','Active')->orderby('applicant_name','asc')->get();
                                @endphp
                                <option value="">Select Applicant Name</option>
                                @foreach($customers as $customer)
                                <option @if(isset($_REQUEST['applicant_name']) && $_REQUEST['applicant_name']==$customer['applicant_name']) selected @endif value="{{ $customer['applicant_name'] }}">{{ $customer['applicant_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary m-btn m-btn--air m-btn--custom" type="submit" name="search"><i class="fa fa-search"></i></button>
                            <?php if (isset($_REQUEST['search'])) { ?>
                                <a class="btn btn-danger m-btn m-btn--air m-btn--custom" href="{{route('deletes.cost_index')}}"><i class="fa fa-times"></i></a>
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
                        <?php if ($results->count() > '0') {
                        ?>
                            <div class="table-responsive">
                                <table class="table m-table m-table--head-bg-brand">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th>Profile</th>
                                            <th>Application Number</th>
                                            <th>Applicant Name</th>
                                            <th>Rate per SQFT</th>
                                            <th>Salable Area</th>
                                            <th>UDS Area</th>
                                            <th>Guideline Value</th>
                                            <th>Land Cost</th>
                                            <th>Construction Cost</th>
                                            <th>Gross Amount</th>
                                            <th>Total Amount</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                       
                                        $i = ($results->currentpage() - 1) * $results->perpage() + 1;
                                        foreach ($results as $result) {
                                            $customer = App\Customer::where('customer_id', $result['customer_id'])->first();
                                        ?>
                                            <tr>
                                                <td width="5%">{{ $i }}</td>
                                                <td class="text-center">
                                                    @if(!empty($customer['photo']))
                                                    <a href="{{URL::to('/files/customers/'.$customer['photo'].'')}}" target="_blank"><img src="{{URL::to('/files/customers/'.$customer['photo'].'')}}" width="50" height="50" style="border-radius: 50%;object-fit: cover;" />
                                                    </a>
                                                    @endif
                                                </td>
                                                <td>{{ $result->application_number }}</td>
                                                <td>{{ $result->applicant_name }}</td>
                                                <td class="text-center">{{ $result->rate_sqft }}</td>
                                                <td class="text-center">{{ $result->sal_area }}</td>
                                                <td class="text-center">{{ $result->uds_area }}</td>
                                                <td class="text-center">{{ $result->guideline_value }}</td>
                                                <td>{{"Rs."}}{{ $result->land_cost }}</td>
                                                <td class="text-center">{{"Rs. "}}{{ $result->construction_cost }}</td>
                                                <td class="text-center">{{"Rs. "}}{{ $result->gross_amount }}</td>
                                                <td class="text-center">{{"Rs. "}}{{ $result->total_amount }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a rel="tooltip" class="btn btn-secondary m-btn m-btn--air m-btn--custom" title="View" href="{{ route("deletes.cost_view", $result->cost_id) }}">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                     
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            {!! $results->appends(\Request::except('page'))->render() !!}
                            <!--@include('pagination.default', ['paginator' => $results])-->
                        <?php } else { ?>
                            <div class="text-center">
                                <img src="{{ asset('admin/img/no-record.png') }}">
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection