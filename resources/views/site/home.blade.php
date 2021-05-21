@extends('site.layout.app')

@section('content')

@include('site.component.homeBanner')
@include('site.component.homeServices')
@include('site.component.homeCourses')
@include('site.component.homeProjects')
@include('site.component.homeContact')
@include('site.component.homePost')
@include('site.component.homeReviews')

@endsection