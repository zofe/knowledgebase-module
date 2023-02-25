<div>

        <x-rpd::table
            title="Articles"
            :items="$items"
        >

            <x-slot name="filters">
                    <div class="col">
                        <x-rpd::input debounce="350" model="search"  placeholder="search..." />
                    </div>
            </x-slot>


            <x-slot name="buttons">
                <a href="{{ route('kb.admin.articles.table') }}" class="btn btn-dark">reset</a>
            </x-slot>

            <table class="table">
                <thead>
                <tr>
                    <th>
                        <x-rpd::sort model="id" label="id" />
                    </th>
                    <th>
                        <x-rpd::sort model="title" label="title" />
                    </th>
                    <th>slug</th>


                </tr>
                </thead>
                <tbody>
                @foreach ($items as $article)
                    <tr>
                        <td>
                            <a href="{{ route('kb.admin.articles.edit',$article->id) }}">{{ $article->id }}</a>
                        </td>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->slug }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </x-rpd::table>

</div>

