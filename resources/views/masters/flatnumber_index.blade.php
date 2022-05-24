@extends('layouts.admin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Flat Number List
                </h3>
            </div>
            <div>
                <a href="{{route('masters.flatnumber_add')}}" rel="tooltip" title="" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle" data-original-title="Add New">
                    <i class="la la-plus"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet">
            <div class="m-portlet__body">
                <!--begin::Section-->
                <div class="m-section__content">
                    <form method="GET" class="search-form form-inline " action="#">
                        <div class="form-group">
                            <input type="text" class="form-control" name="s" placeholder="Search Flatnumber" @if(isset($_REQUEST['s'])) value="{{ $_REQUEST['s'] }}" @else value="" @endif />
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="phase">
                                @php
                                $phases = App\Phase::where('status','Active')->get();
                                @endphp
                                <option value="">Select Phase</option>
                                @foreach($phases as $phase)
                                <option @if(isset($_REQUEST['phase']) && $_REQUEST['phase']==$phase['phase']) selected @endif value="{{ $phase['phase_id'] }}">{{ $phase['phase_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="block">
                                @php
                                $blocks = App\Block::where('status','Active')->get();
                                @endphp
                                <option value="">Select Block</option>
                                @foreach($blocks as $block)
                                <option @if(isset($_REQUEST['block']) && $_REQUEST['block']==$block['block']) selected @endif value="{{ $block['block_id'] }}">{{ $block['block_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- <div class="form-group">
                            <select class="form-control" name="floor">
                                @php
                                $floors = App\Floor::where('status','Active')->get();
                                @endphp
                                <option value="">Select Floor</option>
                                @foreach($floors as $floor)
                                <option @if(isset($_REQUEST['floor_id']) && $_REQUEST['floor_id']==$floor['floor_id']) selected @endif value="{{ $floor['floor_id'] }}">{{ $floor['floor_name'] }}</option>
                                @endforeach
                            </select>
                        </div> -->
                        <!-- <div class="form-group">
                            <select class="form-control" name="flattype">
                                @php
                                $flattypes = App\Flattype::where('status','Active')->get();
                                @endphp
                                <option value="">Select Flat Type</option>
                                @foreach($flattypes as $flattype)
                                <option @if(isset($_REQUEST['flattype_id']) && $_REQUEST['flattype_id']==$flattype['flattype_id']) selected @endif value="{{ $flattype['flattype_id'] }}">{{ $flattype['flattype_name'] }}</option>
                                @endforeach
                            </select>
                        </div> -->
                        <div class="form-group">
                            <button class="btn btn-primary m-btn m-btn--air m-btn--custom" type="submit" name="search"><i class="fa fa-search"></i></button>
                            <?php if (isset($_REQUEST['search'])) { ?>
                                <a class="btn btn-danger m-btn m-btn--air m-btn--custom" href="{{route('masters.flatnumber_index')}}"><i class="fa fa-times"></i></a>
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
                        <?php if ($results->count() > '0') { ?>
                            <div class="table-responsive">
                                <table class="table m-table m-table--head-bg-brand">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th>Phase</th>
                                            <th>Block</th>
                                            <th>Floor</th>
                                            <th>Flat Type</th>
                                            <th>Flat Number</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = ($results->currentpage() - 1) * $results->perpage() + 1;
                                        foreach ($results as $result) {
                                            $phase = App\Phase::where('phase_id', $result['phase'])->first();
                                            $block = App\Block::where('block_id', $result['block'])->first();
                                            $floor = App\Floor::where('floor_id', $result['floor'])->first();
                                            $flattype = App\Flattype::where('flattype_id', $result['flattype'])->first();
                                        ?>
                                            <tr>
                                                <td width="5%">{{ $i }}</td>
                                                <td>{{ $phase['phase_name'] }}</td>
                                                <td>{{ $block['block_name'] }}</td>
                                                <td>{{ $floor['floor_name'] }}</td>
                                                <td>{{ $flattype['flattype'] }}</td>
                                                <td>{{ $result->flatnumber }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a rel="tooltip" class="btn btn-secondary m-btn m-btn--air m-btn--custom" title="Edit" href="{{ route("masters.flatnumber_edit", $result->flatnumber_id) }}">
                                                            <i class="fa fa-pencil"></i>
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