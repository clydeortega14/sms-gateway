@extends('partial.master')

@section('body')
    <div class="page-wrapper">

        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Clients</h3>
            </div>
        </div>


        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-title">
                            <a href="{{ route('clients.create') }}" class="btn btn-primary btn-sm pull-right" data-toggle="tooltip" title="Create new Client">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Client Name</th>
                                            <th>Email</th>
                                            <th>Contact Number</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($clients as $client)
                                            <tr>
                                                <td>{{ $client->name }}</td>
                                                <td>{{ $client->email }}</td>
                                                <td>{{ $client->contact_number }}</td>
                                                <td>{{ $client->address }}</td>
                                                <td>
                                                    <span class="{{ $client->status == 1 ? 'label label-success' : 'label label-danger' }}">{{ $client->status == 1 ? 'Active' : 'Inactive' }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="Edit Client">
                                                        <i class="fa fa-edit"></i>
                                                    </a> |

                                                    <button type="button" class="btn btn-success btn-sm status" rel="{{ $client->id }}">
                                                        <i class="fa fa-reply"></i>
                                                    </button> |

                                                    <a href="{{ route('client.branches', $client->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Branches">
                                                        <i class="fa fa-plus"></i>
                                                    </a> |
                                                    <a href="{{ route('client.credentials', $client->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Globe Credential">
                                                        <i class="fa fa-plus"></i>
                                                    </a> 
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    
    <script>
        
        $(function(){

            $('.status').on('click', function(){


                let id = $(this).attr('rel');

                let data = {

                    method: 'POST',
                    url: `/update-client-status/${id}`,
                    data: {

                        _token: "{{ csrf_token() }}"
                    }
                }

                fireAlert(data);

            });

        });
    </script>

@endsection
