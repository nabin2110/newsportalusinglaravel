@extends('backend.layouts.section')
@section('title','List '.$panel)
@section('main-section')
@include('sweetalert::alert')
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <div class="text-right m-3">
                <a href="{{ route($base_route.'create') }}" class="btn btn-primary">Create {{ $panel }}</a>
            </div>
            <!-- Card Content - Collapse -->
            <div class="card shadow mb-4">
                <div class="text-center mt-2">
                    <h4>List {{ $panel }}</h4>
                </div>
                <div class="filter-container text-right m-3">
                    <button type="button" class="btn btn-primary" id="filterToggle">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <div class="filter-form" id="filterForm">
                        <form id="filterFormElement" method="GET">
                            <div class="form-group">
                                <label for="search">Search</label>
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search item...">
                            </div>
                
                            <div class="form-group">
                                <label for="per_page">Per Page</label>
                                <select name="per_page" id="per_page" class="form-control">
                                    <option value="10" {{ request('per_page') == '10' ? 'selected' :'' }}>10</option>
                                    <option value="50" {{ request('per_page') == '50' ? 'selected' :'' }}>50</option>
                                    <option value="100" {{ request('per_page') == '100' ? 'selected' :'' }}>100</option>
                                </select>
                            </div>
                
                            <!-- Apply Filters Button -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Card Body -->
                <div class="card-body">
                   <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="sortable">
                        @forelse ($data['records'] as $record)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucfirst($record->name) }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route($base_route.'edit',$record->id) }}" class="btn btn-warning mr-2"><i class="fas fa-pen"></i></a>
                                        <form action="{{ route($base_route.'destroy',$record->id) }}" method="post" class="delete-form">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-danger">No Record Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                   </table>
                   <div class="text-right">
                        {{ $data['records']->links('pagination::bootstrap-5') }}
                   </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        @include('backend.includes.sweet_alert')
    </script>
@endsection