<div class="row">
    <div class="col-sm-6">
        <div class="form-group @if ($errors->has($attribute)) has-error @endif">
            <label class="control-label" for="{{ $attribute }}">
                {{ $attributeTitle }}
                @if (isset($field['required'])) 
                    <span title="" data-placement="right" data-toggle="tooltip" data-original-title="This field is required">*</span>
                @endif
                @if(isset($field['tooltip']))
                    <span title="" data-placement="right" data-toggle="tooltip" class="badge bg-black" data-original-title="{{ $field['tooltip'] }}">?</span>
                @endif
            </label>
            <input id="{{ $attribute }}"
                    class="form-control {{ $field['class'] or null }}"
                    type="{{ $field['type'] or 'text' }}"
                    name="{{ $attribute }}"
                    @if (isset($field['maxlength'])) maxlength="{{ $field['maxlength'] }}" @endif
                    @if (isset($field['disabled'])) disabled="disabled" @endif
                    @if (isset($field['readonly'])) readonly="readonly" @endif
                    @if (isset($field['autocomplete'])) autocomplete="{{ ($field['autocomplete'] ? 'on' : 'off') }}" @endif
                    @if (isset($field['autofocus'])) autofocus="autofocus" @endif
                    @if (isset($field['pattern'])) pattern="{{ $field['pattern'] }}" @endif
                    @if (isset($field['data-inputmask'])) data-mask="" @endif
                    @if (isset($field['data-inputmask'])) data-inputmask="{!! $field['data-inputmask'] !!}" @endif
                    @if (isset($field['required'])) required="required" @endif
                    @if (isset($field['placeholder'])) placeholder="{{ $field['placeholder'] }}" @endif
                    value="">
                    
            @if(isset($field['help']))
                <p class="help-block">{!! $field['help'] !!}</p>
            @endif

            @if ($errors->has($attribute))
                <p class="help-block">
                    <strong>{{ $errors->first($attribute) }}</strong>
                </p>
            @endif        
        </div>
        
        @if(isset($field['type']) && $field['type'] == 'password' && isset($field['confirm']) && $field['confirm'])
            <div class="form-group @if ($errors->has($attribute)) has-error @endif">
                <label class="control-label" for="{{ $attribute }}">
                    Confirm {{ $attributeTitle }}
                    @if (isset($field['required'])) 
                        <span title="" data-placement="right" data-toggle="tooltip" data-original-title="This field is required">*</span>
                    @endif
                    @if(isset($field['tooltip']))
                        <span title="" data-placement="right" data-toggle="tooltip" class="badge bg-black" data-original-title="{{ $field['tooltip'] }}">?</span>
                    @endif
                </label>
                <input id="{{ $attribute }}_confirmation"
                        class="form-control {{ $field['class'] or null }}"
                        type="{{ $field['type'] or 'text' }}"
                        name="{{ $attribute }}_confirmation"
                        @if (isset($field['maxlength'])) maxlength="{{ $field['maxlength'] }}" @endif
                        @if (isset($field['disabled'])) disabled="disabled" @endif
                        @if (isset($field['readonly'])) readonly="readonly" @endif
                        @if (isset($field['autocomplete'])) autocomplete="{{ ($field['autocomplete'] ? 'on' : 'off') }}" @endif
                        @if (isset($field['autofocus'])) autofocus="autofocus" @endif
                        @if (isset($field['pattern'])) pattern="{{ $field['pattern'] }}" @endif
                        @if (isset($field['data-inputmask'])) data-mask="" @endif
                        @if (isset($field['data-inputmask'])) data-inputmask="{!! $field['data-inputmask'] !!}" @endif
                        @if (isset($field['required'])) required="required" @endif
                        @if (isset($field['placeholder'])) placeholder="{{ $field['placeholder'] }}" @endif
                        value="">
                        
                @if(isset($field['help']))
                    <p class="help-block">{!! $field['help'] !!}</p>
                @endif

                @if ($errors->has($attribute))
                    <p class="help-block">
                        <strong>{{ $errors->first($attribute) }}</strong>
                    </p>
                @endif
            </div>
        @endif
    </div>
</div>

@if(isset($field['data-inputmask']))
    @section('enqueued-js')
        <script src="{{ asset('vendor/flare/plugins/input-mask/jquery.inputmask.js') }}"></script>
        <script src="{{ asset('vendor/flare/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
        <script src="{{ asset('vendor/flare/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script> 

        <script>

        $(function () {
            $("[data-inputmask]").inputmask();
        });
        </script>
    @append
@endif