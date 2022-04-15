@extends('layouts.master')
@section('content')
    @if((empty($laInteraction)))
        <h1>Ajout d'une Interaction avec le médicament : {{$leMedicament[0]->nom_commercial}}</h1>
        {{ Form::open(array('url' => 'medicament/ajouterLaInteraction')) }}
        <input type="hidden" value="{{$leMedicament[0]->id_medicament}}" name="id_medicament">
        <label>Médicament</label>
        <select name="id_med_medicament">
            @foreach($mesMedicaments as $ligne)
                <?php $disabled = ''?>
                @if (($ligne->id_medicament) == ($leMedicament[0]->id_medicament))
                    <?php $disabled = 'disabled'?>
                @endif
                @foreach($mesInteractions as $inter)
                    @if(($ligne->id_medicament) == ($inter->id_medicament))
                        <?php $disabled = 'disabled'?>
                    @endif
                @endforeach
                <option value="{{$ligne->id_medicament}}" <?php echo $disabled?>>{{$ligne->nom_commercial}}</option>
            @endforeach
        </select>
        <button type="submit">Ajouter</button>

        {{ Form::close() }}
    @else
        <h1>Modification d'une Interaction pour le médicament : {{$leMedicament[0]->nom_commercial}}</h1>
        {{ Form::open(array('url' => 'medicament/modifierLaInteraction')) }}
        <input type="hidden" value="{{$leMedicament[0]->id_medicament}}" name="id_medicament">
        <input type="hidden" value="{{$laInteraction[0]->med_id_medicament}}" name="ancien_med_id_medicament">
        <label>Medicament</label>
        <select name="new_med_id_medicament">
            @foreach($mesMedicaments as $ligne)
                <?php $selected = ''?>
                <?php $disabled = ''?>
                @if(($ligne->id_medicament) == ($laInteraction[0]->id_medicament) )
                    <?php $selected = 'selected'?>
                @endif
                @if(($ligne->id_medicament) == ($leMedicament[0]->id_medicament) )
                    <?php $disabled = 'disabled'?>
                @endif
                @foreach($mesInteractions as $inter)
                    @if(($ligne->id_medicament) == ($inter->id_medicament))
                        <?php $disabled = 'disabled'?>
                    @endif
                @endforeach
                <option value="{{$ligne->id_medicament}}" <?php echo $selected?><?php echo " "?><?php echo $disabled?>>{{$ligne->nom_commercial}}</option>
            @endforeach
        </select>
        <button type="submit">Modifier</button>

        {{ Form::close() }}
    @endif
@stop

