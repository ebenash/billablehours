@extends('layouts.app')
@php
    $total = 0;
@endphp
@section('content')
<div class="bd-example">
    <div class="row">
        <div class="col-lg-12">
            <div class="row justify-content-end">
                <div class="pull-right">
                    <button type="submit" class="btn btn-outline-secondary" onclick="window.print()">Print Invoice</button>
                </div>
            </div>
            <br/>
            <div class="card" id="invoiceSection">
                <div class="row invoice-contact">
                    <div class="col-md-8">
                        <div class="invoice-box row">
                            <div class="col-sm-12">
                                <table class="table table-responsive invoice-table table-borderless p-l-20">
                                    <tbody>
                                        <tr>
                                            <td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><h1>Company: {{$data['company']}}</h1></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-end">
                        <div class="float-right">
                            <h1 class="" style="color:green">INVOICE</h1>
                            <br/>
                            <h6 class="m-b-20"><span>#{{time()}}</span></h6>
                            <br/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr class="thead-default">
                                            <th>Employee ID</th>
                                            <th>Number of Hours</th>
                                            <th>Unit Price</th>
                                            <th>Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach ($data['project'] as $project)
                                        
                                        <tr>
                                            @php
                                                $start = date_create_from_format('d/m/Y:H:i', $project->date.":".$project->start);
                                                $end = date_create_from_format('d/m/Y:H:i', $project->date.":".$project->end);
                                                $hours = date_diff($end, $start)->format('%h');
                                                $cost = $hours*$project->rate;
                                                $total += $cost;
                                            @endphp
                                            <td>
                                                <h6>{{$project->employee}}</h6>
                                            </td>
                                            <td>{{$hours}}</td>
                                            <td>{{$project->rate}}</td>
                                            <td>{{$cost}}</td>
                                        </tr>
                                        
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="tfoot-default">
                                            <th></th>
                                            <th></th>
                                            <th class="text-primary m-r-10">Total Due:</th>
                                            <th class="text-primary m-r-10">GHS {{$total}}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection