{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- Permission is hereby granted, free of charge, to any person obtaining a copy --}}
{{-- of this software and associated documentation files (the "Software"), to deal --}}
{{-- in the Software without restriction, including without limitation the rights --}}
{{-- to use, copy, modify, merge, publish, distribute, sublicense, and/or sell --}}
{{-- copies of the Software, and to permit persons to whom the Software is --}}
{{-- furnished to do so, subject to the following conditions: --}}

{{-- The above copyright notice and this permission notice shall be included in all --}}
{{-- copies or substantial portions of the Software. --}}

{{-- THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR --}}
{{-- IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, --}}
{{-- FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE --}}
{{-- AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER --}}
{{-- LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, --}}
{{-- OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE --}}
{{-- SOFTWARE. --}}
@extends('layouts.admin')

@section('title')
    Locations
@endsection

@section('content-header')
    <h1>Locations<small>All locations that nodes can be assigned to for easier categorization.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">Locations</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Location List</h3>
                <div class="box-tools">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#newLocationModal">Create New</button>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Short Code</th>
                            <th>Description</th>
                            <th class="text-center">Nodes</th>
                            <th class="text-center">Servers</th>
                        </tr>
                        @foreach ($locations as $location)
                            <tr>
                                <td><code>{{ $location->id }}</code></td>
                                <td><a href="{{ route('admin.locations.view', $location->id) }}">{{ $location->short }}</a></td>
                                <td>{{ $location->long }}</td>
                                <td class="text-center">{{ $location->nodes_count }}</td>
                                <td class="text-center">{{ $location->servers_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="newLocationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.locations') }}" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Create Location</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="pShortModal" class="form-label">Short Code</label>
                            <input type="text" name="short" id="pShortModal" class="form-control" />
                            <p class="text-muted small">A short identifier used to distinguish this location from others. Must be between 1 and 60 characters, for example, <code>us.nyc.lvl3</code>.</p>
                        </div>
                        <div class="col-md-12">
                            <label for="pLongModal" class="form-label">Description</label>
                            <textarea name="long" id="pLongModal" class="form-control" rows="4"></textarea>
                            <p class="text-muted small">A longer description of this location. Must be less than 255 characters.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {!! csrf_field() !!}
                    <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success btn-sm">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
