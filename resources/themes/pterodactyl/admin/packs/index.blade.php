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
    List Packs
@endsection

@section('content-header')
    <h1>Packs<small>All service packs available on the system.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">Packs</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Pack List</h3>
                <div class="box-tools">
                    <form action="{{ route('admin.packs') }}" method="GET">
                        <div class="input-group input-group-sm">
                            <input type="text" name="query" class="form-control pull-right" style="width:30%;" value="{{ request()->input('query') }}" placeholder="Search Packs">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                <a href="{{ route('admin.packs.new') }}"><button type="button" class="btn btn-sm btn-primary" style="border-radius: 0 3px 3px 0;margin-left:-1px;">Create New</button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Pack Name</th>
                            <th>Version</th>
                            <th>Description</th>
                            <th>Option</td>
                            <th class="text-center">Servers</th>
                        </tr>
                        @foreach ($packs as $pack)
                            <tr>
                                <td class="middle" data-toggle="tooltip" data-placement="right" title="{{ $pack->uuid }}"><code>{{ $pack->id }}</code></td>
                                <td class="middle"><a href="{{ route('admin.packs.view', $pack->id) }}">{{ $pack->name }}</a></td>
                                <td class="middle"><code>{{ $pack->version }}</code></td>
                                <td class="col-md-6">{{ str_limit($pack->description, 150) }}</td>
                                <td class="middle"><a href="{{ route('admin.services.option.view', $pack->option->id) }}">{{ $pack->option->name }}</a></td>
                                <td class="middle text-center">{{ $pack->servers_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($packs->hasPages())
                <div class="box-footer with-border">
                    <div class="col-md-12 text-center">{!! $packs->render() !!}</div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
