@extends('layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.pagenotfound') }}
@endsection

@section('contentheader_title')
    {{ '403 Forbidden' }}
@endsection

@section('$contentheader_description')
@endsection

@section('main-content')

    <div class="error-page">
        <h2 class="headline text-yellow"> 400</h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i>Bad Request</h3>


        </div><!-- /.error-content -->
    </div><!-- /.error-page -->
@endsection