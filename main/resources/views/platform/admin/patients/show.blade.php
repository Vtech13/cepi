<x-layouts.app :class-body="$class_body" :link-active="$link_active">

    <x-slot name="sidebar">
        <div class="sidebar-wrapper">
            <div class="sidebar-wrapper__stick">
                <div class="sidebar__block">
                    <div class="form">
                        <x-form.input name="search" id="search-filter-li" placeholder="Filtrer"></x-form.input>
                    </div>
                    <ul class="sidebar__list tab__links">
                        <li class="sidebar__list-item sidebar__list-item--active">
                            <button class="tab__link sidebar__list-link" data-id="tab-info-patient">
                                Info patient
                            </button>
                        </li>
                        @foreach ($patient->categories as $category)
                            <li class="sidebar__list-item">
                                <button class="tab__link sidebar__list-link" data-id="tab-{{ $category->id }}">
                                    {{ $category->name }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </x-slot>

    <x-section fluid>
        <h1>{{ $patient->fullName }}</h1>

        <div id="tab-info-patient" class="tab__content">
            <div class="block-content">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <x-box-info label="Prénom">{{ $patient->firstname }}</x-box-info>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <x-box-info label="Nom">{{ $patient->lastname }}</x-box-info>
                    </div>
                </div>

                @if (!empty($patient->information))
                    <x-box-info label="Information">{!! nl2br(strip_tags($patient->information)) !!}</x-box-info>
                @endif

                @if ($patient->categories->isNotEmpty())
                    <form action="{{ route('admin.files.download-all', $patient->id) }}" method="post">
                        @csrf
                        <x-form.button>Télécharger tous les fichiers</x-form.button>
                    </form>
                @endif
            </div>
        </div>

        @foreach ($patient->categories as $category)
            <div id="tab-{{ $category->id }}" class="tab__content">
                <div class="block-content">
                    <div class="category__top">
                        <p class="category__name">{{ $category->name }}</p>
                        <form action="{{ route('admin.files.download-one', $category->id) }}" class="form"
                              method="post">
                            @csrf
                            <x-form.button class="btn--info--invert">Télécharger les fichiers</x-form.button>
                        </form>
                    </div>

                    <p class="category__content">{!! nl2br(strip_tags($category->information)) !!}</p>

                    <div class="attachment-preview">
                        @foreach ($category->attachments as $attachment)
                            <x-attachment-preview :attachment="$attachment" :delete="false"/>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </x-section>
</x-layouts.app>
