<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('number_people', 'Number People:') !!}
    {!! Form::text('number_people', old('number_people'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('rating', 'Rating:') !!}
    {!! Form::select('rating', ['A' => 'A', 'B' => 'B', 'C' => 'C'], old('rating'), ['placeholder' => 'Pick a rating']) !!}
</div>

<div class="form-group">
    {!! Form::label('year_created', 'Year Created:') !!}
    {!! Form::date('year_created', $record->getNiceYearCreated()) !!}
</div>

<div class="form-group">
    {!! Form::label('logo', 'Logo:') !!}
    {!! Form::file('logo') !!}
    @if (isset($record->logo))
        {{ link_to('/logo/' . $record->logo, 'Download Logo', ['class' => 'btn btn-primary', 'target' => '_blank']) }}
    @endif
</div>

<div class="form-group">
    {!! Form::label('certificate', 'Certificate') !!}
    {!! Form::file('certificate') !!}
    @if (isset($record->certificate))
        {{ link_to('/certificates/' . $record->logo, 'Download Certificate', ['class' => 'btn btn-primary', 'target' => '_blank']) }}
    @endif
</div>

<div class="container  user-roles" data-user-id="{{ $record->id }}">
    <div class="row">
        <div class="col-md-5 item-container">
            <h3>Unselected Roles</h3>
            <div id="unselected-roles" class="drag-container">
                @foreach ($otherRoles as $otherRole)
                    <div class="item" data-id="{{ $otherRole->id }}">
                        <input type="hidden" value="{{ $otherRole->id }}" name=""/>
                        {{ $otherRole->toString() }}
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-5  item-container">
            <h3>Selected Roles</h3>
            <div id="selected-roles" class="drag-container">
                @foreach ($userRoles as $userRole)
                    <div class="item" data-role-id="{{ $userRole->id }}">
                        <input type="hidden" value="{{ $userRole->id }}" name=""/>
                        {{ $userRole->toString() }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script type="text/javascript" src="/js/dragula.min.js"></script>
    <script type="text/javascript">
        dragula([document.getElementById('unselected-roles'), document.getElementById('selected-roles')]);
        $('#saveRecord').on('click', function(){
            $('#selected-roles .item input[type="hidden"]').each(function() {
                $(this).attr('name', 'selectedRole[]');
            });
        });
    </script>
@append

