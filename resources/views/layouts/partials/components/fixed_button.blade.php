<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a class="btn-floating btn-lg {{$fixed_button_classes}}" href="{{ $fixed_button_route }}">
        <i class="fa {{$fixed_button_icon}}"></i>
    </a>
</div>


<!-- @section('fixedbutton')
    @include('layouts.partials.components.fixed_button', ['fixed_button_route'=> route('courses.create'), 
        'fixed_button_classes' => 'btn-primary', 'fixed_button_icon'=>'fa-plus'] )
@endsection -->