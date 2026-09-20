{{-- Public navbar entry: a button, so the demo stands out --}}
<li class="nav-item d-flex align-items-center">
    <a href="{{ route_lang('demo.articles') }}" class="btn btn-primary btn-sm ms-lg-2 my-1 {{ url_contains('/demo') ? 'active' : '' }}">
        <i class="fas fa-play me-1"></i>{{ __('Try the live demo') }}
    </a>
</li>
