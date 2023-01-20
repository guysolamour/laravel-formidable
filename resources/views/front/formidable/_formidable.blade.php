
<form method="POST" action="{{ route('formidable.store', $form) }}" novalidate>
    @csrf
    @foreach ($form->fields as $field)
        @if(
            $field->type === 'text' || $field->type === 'number' ||
            $field->type === 'email' || $field->type === 'date' || $field->type === 'url'
        )
            <div class="form-group">
                @if($field->label) <label for="{{ $field->id }}">{{ $field->label }}</label> @endif
                <input
                    type="{{ $field->type }}" name="{{ $field->name }}" id="{{ $field->id }}"  value="{{ old($field->name, $field->value) }}"
                    placeholder="{{ $field->placeholder }}" class="{{ $field->class ?? $field->className }} @error($field->name) is-invalid @enderror" @if($field->style) style="{{ $field->style }}" @endif
                    @if($field->rules)
                        @foreach ($field->rules  as $rule)
                            @if(Arr::exists($rule, 'arg'))
                                {{ Arr::get($rule, 'name') }}="{{ Arr::get($rule, 'arg') }}"
                            @else
                                {{ Arr::get($rule, 'name') }}
                            @endif
                        @endforeach
                    @endif
                    >
                    @error($field->name)
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message  }}</strong>
                    </span>
                    @enderror
            </div>
        @elseif($field->type === 'textarea')
            <div class="form-group">
                    @if($field->label) <label for="{{ $field->id }}">{{ $field->label }}</label> @endif
                    <textarea
                        name="{{ $field->name }}" id="{{ $field->id }}" class="{{ $field->class ?? $field->className }} @error($field->name) is-invalid @enderror"
                        placeholder="{{ $field->placeholder }}" @if($field->style) style="{{ $field->style }}" @endif
                        @if($field->rules)
                            @foreach ($field->rules  as $rule)
                                @if(Arr::exists($rule, 'arg'))
                                    {{ Arr::get($rule, 'name') }}="{{ Arr::get($rule, 'arg') }}"
                                @else
                                    {{ Arr::get($rule, 'name') }}
                                @endif
                            @endforeach
                        @endif
                    >{{ old($field->name, $field->value) }}</textarea>
                    @error($field->name)
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message  }}</strong>
                    </span>
                    @enderror
            </div>
        @elseif($field->type === 'select')
            <div class="form-group">
                @if($field->label) <label for="{{ $field->id }}">{{ $field->label }}</label> @endif
                <select
                    @if($field->multiple)
                    name="{{ $field->name }}[]"
                    @else
                    name="{{ $field->name }}"
                    @endif

                    id="{{ $field->id }}" class="{{ $field->class ?? $field->className }} @error($field->name) is-invalid @enderror"
                    @if($field->multiple) multiple @endif @if($field->value) value="{{ $field->value }}" @endif
                    @if($field->rules)
                        @foreach ($field->rules  as $rule)
                            @if(Arr::exists($rule, 'arg'))
                                {{ Arr::get($rule, 'name') }}="{{ Arr::get($rule, 'arg') }}"
                            @else
                                {{ Arr::get($rule, 'name') }}
                            @endif
                        @endforeach
                    @endif
                    >
                    @foreach($field->options as $option )
                        <option
                            @if(old($field->name) && old($field->name) == Arr::get($option, 'value')) selected @endif
                            value="{{ Arr::get($option, 'value') }}">{{ Arr::get($option, 'label') }}</option>
                    @endforeach
                </select>
                @error($field->name)
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message  }}</strong>
                    </span>
                    @enderror
            </div>
        @elseif($field->type === 'submit')
            <div class="form-group">
               <button
                    type="{{ $field->type }}" class="{{ $field->class ?? $field->className }}"
                    @if($field->style) style="{{ $field->style }}" @endif
                >{{ $field->label }}</button>
            </div>
        @endif
    @endforeach
</form>

