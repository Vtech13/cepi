<div class="sidebar-wrapper">
    <div class="sidebar-wrapper__stick">
        <div class="sidebar__block">
            <x-sidebar.list>
                <x-sidebar.item name="Dashboard"
                                link="{{ route('admin.dashboard') }}"
                                active="{{ !empty($active) && strpos($active, 'dashboard') !== false }}"></x-sidebar.item>
                @can('viewAny', \App\Models\Patient::class)
                    <x-sidebar.item name="Patients"
                                    link="{{ route('admin.patients') }}"
                                    active="{{ !empty($active) && strpos($active, 'patients') !== false }}"></x-sidebar.item>
                @endcan
                @can('viewAny', \App\Models\User::class)
                    <x-sidebar.item name="Confrères"
                                    link="{{ route('admin.confreres') }}"
                                    active="{{ !empty($active) && strpos($active, 'confreres') !== false }}"></x-sidebar.item>
                @endcan
            </x-sidebar.list>
        </div>
    </div>
</div>
