@extends('admin.layouts.app')

@section('content')
    <h1>Hello Worlds</h1>

    <p>
        This view is loaded from module: Dashboard
    </p>
    {!! NoCaptcha::renderJs() !!}
    <form>
        {!! app('captcha')->display() !!}
    </form>
@endsection
