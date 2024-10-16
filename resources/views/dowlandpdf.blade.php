@extends('layouts.plantillaresumen')

@section('clasebody')
    layout-top-nav
@endsection

@section('content')
    <div class="wrapper">

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <h4 class="title" align="center">REGISTRO DE AISTENCIAS</h4>
                    </div>
                </div>
                <div class="row">

                    <!-- /.col-md-6 -->
                    <div class="col-lg-12" style="font-size: 10px">


                        {{-- <h4 style="background: #ccc; padding:4px">B. FORMACIÓN ACADEMICA</h4><br><br> --}}
                        {{-- <p> (en base al perfil solicitado, rellenar de acuerdo a lo que usted acredita)</p> --}}

                        <table border="1" cellspacing="0" cellpadding="3" width='100%'>
                            <thead>
                                <tr style="background: #aeaeae">
                                    <th class="text-center mi_header"><strong>ID</strong></th>
                                    <th class="text-center mi_header"> <strong>DNI</strong></th>
                                    <th class="text-center mi_header"><strong>Usuario</strong></th>
                                    <th class="text-center mi_header"><strong>Fecha</strong></th>
                                    <th class="text-center mi_header"><strong>MA_1</strong></th>
                                    <th class="text-center mi_header"><strong>MA_2</strong></th>
                                    <th class="text-center mi_header"><strong>MA_3</strong></th>
                                    <th class="text-center mi_header"><strong>MA_4</strong></th>
                                    <th class="text-center mi_header"><strong>M_TARDE</strong></th>
                                    <th class="text-center mi_header"><strong>M_EXTRA</strong></th>

                                </tr>
                            </thead>
                            <tbody id="formacion">
                                @foreach ($datos as $dat)
                                    <tr>
                                        <td>{{$dat->id}}</td>
                                        <td>{{$dat->dni}}</td>
                                        <td>{{$dat->nombre_completo}}</td>
                                        <td>{{$dat->dni}}</td>
                                        <td>{{$dat->ma_1}}</td>
                                        <td>{{$dat->ma_2}}</td>
                                        <td>{{$dat->ma_3}}</td>
                                        <td>{{$dat->ma_4}}</td>
                                        <td>{{$dat->tot_min_ta}}</td>
                                        <td>1{{$dat->tot_min_ex}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="page-break"></div> {{-- salto de linea --}}
                        <br>
                        <h4 style="background: #ccc; padding:4px">C. EXPERIENCIA LABORAL </h4><br><br>
                        <p>(en base al perfil solicitado, ordenar cronológicamente: del actual a lo anterior)</p>

                        



                    </div>


                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->




    </div>
@endsection
