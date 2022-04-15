@extends('layouts.master')
@section('content')
    @if(isset($mesFormulations[0]))
        <h1 class="text-center">Formulation(s) du médicament : {{$leMedicament[0]->nom_commercial}}</h1>
        <table class="table table-bordered table-responsive table-striped">
            <tr>
                <th>Présentation</th>
                <th>Quantité Formuler</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            @foreach ($mesFormulations as $ligne)
                <tr>
                    <td>{{$ligne->lib_presentation}}</td>
                    <td>{{$ligne->qte_formuler}}</td>
                    <td><a class="glyphicon glyphicon-pencil" href="{{url('/medicament/modifFormulation')}}/{{$ligne->id_medicament}}/{{$ligne->id_presentation}}">MODIFIER</a></td>
                    <td>
                        <a class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top" title="Supprimer" href="#"
                           onclick="javascript:if (confirm('Suppression confirmée ?'))
                               { window.location= '{{url('/medicament/supprimerFormulation')}}/{{$ligne->id_medicament}}/{{$ligne->id_presentation}}'; }">SUPPRIMER
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="text-center">
            <a href="{{url('/medicament/ajoutFormulation')}}/{{$leMedicament[0]->id_medicament}}">AJOUTER UNE FORMULATION</a>
        </div>
    @else
        <h1 class="text-center">Aucune Formulation n'existe pour le médicament : {{$leMedicament[0]->nom_commercial}}</h1>
        <div class="text-center">
            <a href="{{url('/medicament/ajoutFormulation')}}/{{$leMedicament[0]->id_medicament}}">EN AJOUTER UNE</a>
        </div>
    @endif
@stop

