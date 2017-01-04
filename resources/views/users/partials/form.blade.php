<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', old('email'), ['class' => 'form-control']) !!}
</div>

<div class="container  user-roles" data-user-id="{{ $user->id }}">
    <div class="row">
        <div class="col-md-5 item-container">
            <h3>Unselected Roles</h3>
            <div id="unselected-roles" class="drag-container">
                @foreach ($otherRoles as $otherRole)
                    <div class="item" data-id="{{ $otherRole->id }}">
                        <input type="hidden" value="{{ $otherRole->id }}" name=""/>
                        {{ $otherRole->name }}
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
                        {{ $userRole->name }}
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
        $('#saveUser').on('click', function(){
            $('#selected-roles .item input[type="hidden"]').each(function() {
                $(this).attr('name', 'selectedRole[]');
            });
        });
    </script>
@append