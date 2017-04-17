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
    @lang('base.security.header')
@endsection

@section('content-header')
    <h1>@lang('base.security.header')<small>@lang('base.security.header_sub')</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">@lang('strings.home')</a></li>
        <li><a href="{{ route('account') }}">@lang('strings.account')</a></li>
        <li class="active">@lang('strings.security')</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('base.security.sessions')</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>@lang('strings.id')</th>
                            <th>@lang('strings.ip')</th>
                            <th>@lang('strings.last_activity')</th>
                            <th></th>
                        </tr>
                        @foreach($sessions as $session)
                            <tr>
                                <td><code>{{ substr($session->id, 0, 6) }}</code></td>
                                <td>{{ $session->ip_address }}</td>
                                <td>{{ Carbon::createFromTimestamp($session->last_activity)->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('account.security.revoke', $session->id) }}">
                                        <button class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> @lang('strings.revoke')</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box {{ (Auth::user()->use_totp) ? 'box-success' : 'box-danger' }}">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('base.security.2fa_header')</h3>
            </div>
            @if(Auth::user()->use_totp)
            <form action="{{ route('account.security.totp') }}" method="post">
                <div class="box-body">
                    <p>@lang('base.security.2fa_enabled')</p>
                    <div class="form-group">
                        <label for="new_password_again" class="control-label">@lang('strings.2fa_token')</label>
                        <div>
                            <input type="text" class="form-control" name="token" />
                            <p class="text-muted small">@lang('base.security.2fa_token_help')</p>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    {!! csrf_field() !!}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger btn-sm">@lang('base.security.disable_2fa')</button>
                </div>
            </form>
            @else
            <form action="#" method="post" id="do_2fa">
                <div class="box-body">
                    @lang('base.security.2fa_disabled')
                </div>
                <div class="box-footer">
                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn-success btn-sm">@lang('base.security.enable_2fa')</button>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
<div class="modal fade" id="open2fa" tabindex="-1" role="dialog" aria-labelledby="open2fa" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="#" method="post" id="2fa_token_verify">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('base.security.2fa_qr')</h4>
                </div>
                <div class="modal-body" id="modal_insert_content">
                    <div class="row">
                        <div class="col-md-12" id="notice_box_2fa" style="display:none;"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <center><span id="hide_img_load"><i class="fa fa-spinner fa-spin"></i> Loading QR Code...</span><img src="" id="qr_image_insert" style="display:none;"/><br /><code id="2fa_secret_insert"></code></center>
                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-info">@lang('base.security.2fa_checkpoint_help')</div>
                            <div class="form-group">
                                <label class="control-label" for="2fa_token">@lang('strings.2fa_token')</label>
                                {!! csrf_field() !!}
                                <input class="form-control" type="text" name="2fa_token" id="2fa_token" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm" id="submit_action">@lang('strings.submit')</button>
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="close_reload">@lang('strings.close')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    @parent
    {!! Theme::js('js/frontend/2fa-modal.js') !!}
@endsection
