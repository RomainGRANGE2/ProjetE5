@extends('layouts.master')
@section('content')
    @if(empty($laPresentation))
    <h1>Ajout d'une Formulation pour le médicament : {{$leMedicament[0]->nom_commercial}}</h1>
    {{ Form::open(array('url' => 'medicament/ajouterLaFormulation')) }}
    <input type="hidden" value="{{$leMedicament[0]->id_medicament}}" name="id_medicament">
    <label>Présentation</label>
    <select name="id_presentation">
        @foreach($mesPresentation as $ligne)
            <?php $disabled = ''?>
            @foreach($mesFormulations as $formule)
                @if(($ligne->id_presentation) == ($formule->id_presentation))
                    <?php $disabled = 'disabled'?>
                @endif
            @endforeach
            <option value="{{$ligne->id_presentation}}" <?php echo $disabled?>>{{$ligne->lib_presentation}}</option>
        @endforeach
    </select>
    <label>Quantité Formuler</label>
    <input type="number" name="qte_formuler">
    <button type="submit">Ajouter</button>
    <br>
    @if($mauvaiseqte != '')
        <div class="alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>{{$mauvaiseqte}}
        </div>
    @endif
    {{ Form::close() }}
    @else
    <h1>Modification d'une Formulation pour le médicament : {{$mesFormulations[0]->nom_commercial}}</h1>
    {{ Form::open(array('url' => 'medicament/modifierLaFormulation')) }}
    <input type="hidden" value="{{$mesFormulations[0]->id_medicament}}" name="id_medicament">
    <input type="hidden" value="{{$mesFormulations[0]->id_presentation}}" name="old_id_presentation">
    <label>Présentation</label>
    <select name="id_presentation">
        @foreach($mesPresentation as $ligne)
            <?php $disabled = ''?>
            <?php $selected = ''?>
            @if(($ligne->id_presentation) == ($laPresentation[0]->id_presentation) )
            <?php $selected = 'selected'?>
            @endif
            @foreach($mesFormulations as $formule)
                @if(($ligne->id_presentation) == ($formule->id_presentation))
                    <?php $disabled = 'disabled'?>
                @endif
            @endforeach
            <option value="{{$ligne->id_presentation}}" <?php echo $selected." ".$disabled ?>>{{$ligne->lib_presentation}}</option>
        @endforeach
    </select>
    <label>Quantité Formuler</label>
    <input type="number" name="qte_formuler" value="{{$laFormulation[0]->qte_formuler}}">
    <button type="submit">Modifier</button>
    @if($mauvaiseqte != '')
        <div class="alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>{{$mauvaiseqte}}
        </div>
    @endif
    {{ Form::close() }}
    @endif

@stop

