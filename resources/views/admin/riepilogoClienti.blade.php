@extends('layouts.stile2')
@section('content')

    <div class="container" style="padding-top: 100px">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body rounded" style="background: dimgrey;">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered nowrap" width="100%" cellspacing="0">
                        <thead class="table-light">
                        <tr>
                            <th>Filiale</th>
                            <th class="text-center">LEAD</th>
                            <th class="text-center">CL</th>
                            <th class="text-center">PC</th>
                            <th class="text-center">CLC</th>
                            <th class="text-center">PREM</th>
                            <th class="text-center">DEC</th>
                            <th class="text-center">TAPPO</th>
                            <th class="text-center">NORMO</th>
                            <th class="text-center">TOT</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($filialiConRiepilogo as $item)
                            <tr>
                                <td>{{$item->nome}}</td>
                                <td class="text-center">{{$item->LEAD}}</td>
                               <td class="text-center">{{$item->CL}}</td>
                                <td class="text-center">{{$item->PC}}</td>
                                <td class="text-center">{{$item->CLC}}</td>
                                <td class="text-center">{{$item->PREM}}</td>
                                <td class="text-center">{{$item->DEC}}</td>
                                <td class="text-center">{{$item->TAPPO}}</td>
                                <td class="text-center">{{$item->NORMO}}</td>
                                <td class="text-center bg-primary">{{$item->tot}}</td>
                            </tr>
                        @endforeach
                            <tr>
                                <td>TOT</td>
                                <td class="text-center bg-primary">{{$filialiConRiepilogo->sum('LEAD')}}</td>
                                <td class="text-center bg-primary">{{$filialiConRiepilogo->sum('CL')}}</td>
                                <td class="text-center bg-primary">{{$filialiConRiepilogo->sum('PC')}}</td>
                                <td class="text-center bg-primary">{{$filialiConRiepilogo->sum('CLC')}}</td>
                                <td class="text-center bg-primary">{{$filialiConRiepilogo->sum('PREM')}}</td>
                                <td class="text-center bg-primary">{{$filialiConRiepilogo->sum('DEC')}}</td>
                                <td class="text-center bg-primary">{{$filialiConRiepilogo->sum('TAPPO')}}</td>
                                <td class="text-center bg-primary">{{$filialiConRiepilogo->sum('NORMO')}}</td>
                                <td class="text-center bg-primary">{{$filialiConRiepilogo->sum('tot')}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

