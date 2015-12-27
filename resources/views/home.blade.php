@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif


            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">


                    {{ Form::open(array('action' => array('CourseController@create', Auth::id()))) }}

                        <!-- course title -->
                        {{ Form::label('title', 'Title') }}<br />
                        {{ Form::text('title') }}<br />

                        <!-- course description -->
                        {{ Form::label('description', 'Description') }}<br />
                        {{ Form::textarea('description') }}<br />


                        {{ Form::label('start_date', 'Start Date') }}<br />
                        {{ Form::date('start_date') }}<br />

                        {{ Form::label('start_time', 'Start Time') }}<br />
                        {{ Form::time('start_time') }}<br />


                        {{ Form::label('end_date', 'End Date') }}<br />
                        {{ Form::date('end_date') }}<br />

                        {{ Form::label('end_time', 'End Time') }}<br />
                        {{ Form::time('end_time') }}<br />

                        {{ Form::label('price', 'Price $') }}<br />
                        {{ Form::number('price', '0.00') }}<br />

                        {{ Form::label('total_slots', 'Open slots') }}<br />
                        {{ Form::number('total_slots', '0') }}<br />




                        {{ Form::submit('Create Course') }}

                    {{ Form::close() }}
                </div>
            </div>



            <div class="panel panel-default">
                <div class="panel-heading">Courses I'm Teaching</div>

                <div class="panel-body">

                    <ul>
                    @foreach($courses as $course)
                        <li>$course</li>
                    @endforeach
                    </ul>

                    <table>

                        <tr></tr>
                    </table>

                </div>
            </div>




        </div>
    </div>
</div>
@endsection
