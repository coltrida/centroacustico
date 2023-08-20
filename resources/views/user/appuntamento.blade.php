@extends('layouts.stile')
@section('content')
    <livewire:live-appuntamento :idClient="$idClient"/>
@endsection

@section('footerSection')
     <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
     <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
     <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
     {{--<script>
         $('document').ready(function () {
             let mess = "{{Session::has('message')}}"
             if(mess){
                 $('#info').modal();
                 setTimeout(function () {
                     $('#info').modal('hide');
                 }, 2000);
             }
         });
     </script>--}}
@endsection
