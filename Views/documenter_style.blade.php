{{-- Styles of the "documenter" code panels, light and dark (pushed once per page) --}}
@once
@push('rapyd_styles')
<style>
    :root {
        --doc-bg: #f3f4f6; --doc-border: #e5e7eb; --doc-title: #1f2937; --doc-file: #6b7280;
        --doc-default: #0000bb; --doc-keyword: #007700; --doc-string: #dd0000; --doc-comment: #ff8000; --doc-html: #000000;
    }
    html.dark {
        --doc-bg: #1a2030; --doc-border: #2a3243; --doc-title: #e8ebf3; --doc-file: #97a0b8;
        --doc-default: #8ab4f8; --doc-keyword: #7fd8a9; --doc-string: #f4a4a4; --doc-comment: #9aa3b8; --doc-html: #d6dbe7;
    }
    .documenter { background: var(--doc-bg); border: 1px solid var(--doc-border); border-radius: .5rem; padding: 1rem 1.25rem; margin-bottom: 1rem; }
    .documenter h4 { font-family: ui-monospace, Menlo, monospace; font-size: 1.25rem; color: var(--doc-title); margin-bottom: .25rem; }
    .documenter pre { margin: 0; overflow-x: auto; color: var(--doc-html); background: transparent; }
    .documenter pre small { color: var(--doc-file); }
    .documenter code { color: var(--doc-file); font-size: .8rem; }
    .documenter code .text-success { color: var(--doc-keyword) !important; }
</style>
@endpush
@endonce
