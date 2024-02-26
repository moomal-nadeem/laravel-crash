<x-header componentName="Laravel Data"/>
Welcome page

{{URL::current()}}
{{URL::full()}}
<a href="{{URL::to('/test')}}">Test Page</a>
<a href="{{URL::previous()}}">previous Page</a>

@include('test')

