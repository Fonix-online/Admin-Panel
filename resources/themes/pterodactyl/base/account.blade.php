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
@extends('layouts.master')

@section('title')
    @lang('base.account.header')
@endsection

@section('content-header')
    <h1>@lang('base.account.header')<small>@lang('base.account.header_sub')</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">@lang('strings.home')</a></li>
        <li class="active">@lang('strings.account')</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-6">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('base.account.update_pass')</h3>
                    </div>
                    <form action="{{ route('account') }}" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="current_password" class="control-label">@lang('base.account.current_password')</label>
                                <div>
                                    <input type="password" class="form-control" name="current_password" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="new_password" class="control-label">@lang('base.account.new_password')</label>
                                <div>
                                    <input type="password" class="form-control" name="new_password" />
                                    <p class="text-muted small no-margin">@lang('auth.password_requirements')</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="new_password_again" class="control-label">@lang('base.account.new_password_again')</label>
                                <div>
                                    <input type="password" class="form-control" name="new_password_confirmation" />
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            {!! csrf_field() !!}
                            <input type="hidden" name="do_action" value="password" />
                            <input type="submit" class="btn btn-primary btn-sm" value="@lang('base.account.update_pass')" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <form action="{{ route('account') }}" method="POST">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('base.account.update_identitity')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="first_name" class="control-label">@lang('base.account.first_name')</label>
                                    <div>
                                        <input type="text" class="form-control" name="name_first" value="{{ Auth::user()->name_first }}" />
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="last_name" class="control-label">@lang('base.account.last_name')</label>
                                    <div>
                                        <input type="text" class="form-control" name="name_last" value="{{ Auth::user()->name_last }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <label for="password" class="control-label">@lang('strings.username')</label>
                                    <div>
                                        <input type="text" class="form-control" name="username" value="{{ Auth::user()->username }}" />
                                        <p class="text-muted small no-margin">@lang('base.account.username_help', [ 'requirements' => '<code>a-z A-Z 0-9 _ - .</code>'])</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer with-border">
                            {!! csrf_field() !!}
                            <input type="hidden" name="do_action" value="identity" />
                            <button type="submit" class="btn btn-sm btn-primary">@lang('base.account.update_identitity')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('base.account.update_email')</h3>
                    </div>
                    <form action="{{ route('account') }}" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="new_email" class="control-label">@lang('base.account.new_email')</label>
                                <div>
                                    <input type="email" class="form-control" name="new_email" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">@lang('base.account.current_password')</label>
                                <div>
                                    <input type="password" class="form-control" name="current_password" />
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            {!! csrf_field() !!}
                            <input type="hidden" name="do_action" value="email" />
                            <input type="submit" class="btn btn-primary btn-sm" value="@lang('base.account.update_email')" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
