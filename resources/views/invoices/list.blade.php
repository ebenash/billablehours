@extends('layouts.app')

@section('content')
<div class="bd-example">
    <div>
        <h1>We found {{count($data['companies'])}} Companies in your csv file. </h1>
        <h3>Click on a Company to generate an invoice.</h3>
        <br/>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table id="invoiceTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th width="15%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                @foreach($data['companies'] as $company)
                    @php
                        $company_projects = array();
                    @endphp
                    @foreach ($data['projects'] as $project)
                        
                        @if($project->company == $company)
                            @php
                                $company_projects[] = $project;
                                
                            @endphp
                            
                        @endif
                    @endforeach
                    
                    <tr>
                        
                        <td>{{$company}}</td>
                        
                        <td><form action="{{route('invoicegenerate')}}" method="POST"> @csrf <input type="hidden" value="{{$company}}" name="company"> <input type="hidden" value="{{base64_encode(json_encode($company_projects))}}"  name="projects"> <button type="submit" class="btn btn-sm btn-outline-secondary">View Invoice</button></form></td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection