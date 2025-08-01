@extends('layouts.admin')

@section('content')
    <div class="container">

        <h1 class="title">Tous les articles</h1>

        <div class="action action__add">
            <a href="{{ route('office.posts.create') }}">
                Ajouter un article
            </a>
            -
            <a href="{{ route('office.posts-categories.index') }}">
                Voir les categories
            </a>
        </div>

        <div class="line-separation"></div>

        @if (!empty($posts->count()))
            <div class="box__filter">
                <input type="text" name="posts-filter" id="posts-filter" class="form__input form__input--filter js__input-filter" placeholder="Filter">
            </div>

            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Date creation</th>
                    <th class="table-action">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ !empty($post->category) ? $post->category->name : '-' }}</td>
                        <td>{{ $post->status }}</td>
                        <td>{{ $post->created_at->format('d/m/Y H:i:s') }}</td>
                        <td class="actions t-center">
                            <a href="{{ route('office.posts.edit', $post->id) }}" title="Edit article">
                                <span class="icon icon-edit">EDIT</span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

@section('js')
    <script>
        document.querySelectorAll('.table-responsive').forEach(function (table) {
            let labels = Array.from(table.querySelectorAll('th')).map(function (th) {
                return th.innerText
            })
            table.querySelectorAll('td').forEach(function (td, i) {
                td.setAttribute('data-label', labels[i % labels.length])
            })
        })
    </script>
@endsection
