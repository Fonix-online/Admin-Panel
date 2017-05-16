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
    Server — {{ $server->name }}: Manage
@endsection

@section('content-header')
    <h1>{{ $server->name }}<small>Additional actions to control this server.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.servers') }}">Servers</a></li>
        <li><a href="{{ route('admin.servers.view', $server->id) }}">{{ $server->name }}</a></li>
        <li class="active">Manage</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom nav-tabs-floating">
            <ul class="nav nav-tabs">
                <li><a href="{{ route('admin.servers.view', $server->id) }}">About</a></li>
                @if($server->installed === 1)
                    <li><a href="{{ route('admin.servers.view.details', $server->id) }}">Details</a></li>
                    <li><a href="{{ route('admin.servers.view.build', $server->id) }}">Build Configuration</a></li>
                    <li><a href="{{ route('admin.servers.view.startup', $server->id) }}">Startup</a></li>
                    <li><a href="{{ route('admin.servers.view.database', $server->id) }}">Database</a></li>
                @endif
                <li class="active"><a href="{{ route('admin.servers.view.manage', $server->id) }}">Manage</a></li>
                <li class="tab-danger"><a href="{{ route('admin.servers.view.delete', $server->id) }}">Delete</a></li>
                <li class="tab-success"><a href="{{ route('server.index', $server->uuidShort) }}"><i class="fa fa-external-link"></i></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Reinstall Server</h3>
            </div>
            <div class="box-body">
                <p>This will reinstall the server with the assigned pack and service scripts. <strong>Danger!</strong> This could overwrite server data.</p>
            </div>
            <div class="box-footer">
                <form action="{{ route('admin.servers.view.manage.reinstall', $server->id) }}" method="POST">
                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn-danger">Reinstall Server</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Install Status</h3>
            </div>
            <div class="box-body">
                <p>If you need to change the install status from uninstalled to installed, or vice versa, you may do so with the button below.</p>
            </div>
            <div class="box-footer">
                <form action="{{ route('admin.servers.view.manage.toggle', $server->id) }}" method="POST">
                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn-primary">Toggle Install Status</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Rebuild Container</h3>
            </div>
            <div class="box-body">
                <p>This will trigger a rebuild of the server container when it next starts up. This is useful if you modified the server configuration file manually, or something just didn't work out correctly.</p>
            </div>
            <div class="box-footer">
                <form action="{{ route('admin.servers.view.manage.rebuild', $server->id) }}" method="POST">
                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn-default">Rebuild Server Container</button>
                </form>
            </div>
        </div>
    </div>
    @if(! $server->suspended)
        <div class="col-sm-4">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Suspend Server</h3>
                </div>
                <div class="box-body">
                    <p>This will suspend the server, stop any running processes, and immediately block the user from being able to access their files or otherwise manage the server through the panel or API.</p>
                </div>
                <div class="box-footer">
                    <form action="{{ route('admin.servers.view.manage.suspension', $server->id) }}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="action" value="suspend" />
                        <button type="submit" class="btn btn-warning">Suspend Server</button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="col-sm-4">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Unsuspend Server</h3>
                </div>
                <div class="box-body">
                    <p>This will unsuspend the server and restore normal user access.</p>
                </div>
                <div class="box-footer">
                    <form action="{{ route('admin.servers.view.manage.suspension', $server->id) }}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="action" value="unsuspend" />
                        <button type="submit" class="btn btn-success">Unsuspend Server</button>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
