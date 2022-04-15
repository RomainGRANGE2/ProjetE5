@extends('layouts.master')
@section('content')
    @if(isset($mesInteractions[0]))
        <h1>Les médicament(s) qui intéragissent avec le : {{$leMedicament[0]->nom_commercial}}</h1>
        <table class="table table-bordered table-responsive table-striped">
            <tr>
                <th>Médicament</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            @foreach ($mesInteractions as $ligne)
                <tr>
                    <td>{{$ligne->nom_commercial}}</td>
                    <td><a class="glyphicon glyphicon-pencil" href="{{url('/medicament/modifInteractions')}}/{{$leMedicament[0]->id_medicament}}/{{$ligne->med_id_medicament}}">MODIFIER</a></td>
                    <td>
                        <a class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top" title="Supprimer" href="#"
                           onclick="javascript:if (confirm('Suppression confirmée ?'))
                               { window.location= '{{url('/medicament/supprimerInteraction')}}/{{$leMedicament[0]->id_medicament}}/{{$ligne->med_id_medicament}}'; }">SUPPRIMER
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
        <a href="{{url('/medicament/ajoutinteraction')}}/{{$leMedicament[0]->id_medicament}}">AJOUTER INTERACTION</a>
    @else
        <h1 class="text-center">Aucune Interaction n'existe pour le médicament : {{$leMedicament[0]->nom_commercial}}</h1>
        <div class="text-center">
            <a href="{{url('/medicament/ajoutinteraction')}}/{{$leMedicament[0]->id_medicament}}">EN AJOUTER UNE</a>

        </div>
    @endif
@stop

