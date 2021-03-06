@extends('layouts.master')
@section('content')
    @if(isset($mesPrescriptions[0]))
        <h1 class="text-center">Prescription(s) du médicament : {{$leMedicament[0]->nom_commercial}}</h1>
        <table class="table table-bordered table-responsive table-striped">
            <tr>
                <th>Quantité de dosage</th>
                <th>Type d'individu</th>
                <th>Posologie</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            @foreach ($mesPrescriptions as $ligne)
                <tr>
                    <td>{{$ligne->qte_dosage}} PAR {{$ligne->unite_dosage}}</td>
                    <td>{{$ligne->lib_type_individu}}</td>
                    <td>{{$ligne->posologie}}</td>
                    <td><a class="glyphicon glyphicon-pencil" href="{{url('/medicament/modifPrescription')}}/{{$ligne->id_medicament}}/{{$ligne->id_dosage}}/{{$ligne->id_type_individu}}">MODIFIER</a></td>
                    <td>
                        <a class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top" title="Supprimer" href="#"
                           onclick="javascript:if (confirm('Suppression confirmée ?'))
                               { window.location= '{{url('/medicament/supprimerPrescription')}}/{{$ligne->id_medicament}}/{{$ligne->id_dosage}}/{{$ligne->id_type_individu}}'; }">SUPPRIMER
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="text-center">
            <a href="{{url('/medicament/ajoutPrescription')}}/{{$leMedicament[0]->id_medicament}}">AJOUTER PRESCRIPTION</a>
        </div>
    @else
        <h1 class="text-center">Aucune Prescription n'existe pour le médicament : {{$leMedicament[0]->nom_commercial}}</h1>
        <div class="text-center">
            <a href="{{url('/medicament/ajoutPrescription')}}/{{$leMedicament[0]->id_medicament}}">EN AJOUTER UNE</a>
        </div>
    @endif
@stop
