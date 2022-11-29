
<div>
        <x-rpd::table
            title="Tags"
            :items="$items"
        >

            <x-slot name="filters">
                    <div class="col">
                        <x-rpd::input debounce="350" model="search"  placeholder="search..." />
                    </div>
            </x-slot>


            <x-slot name="buttons">
                <a href="{{ route('kb.tags.table') }}" class="btn btn-dark">reset</a>
            </x-slot>

            <table class="table">
                <thead>
                <tr>
                    <th>
                        <x-rpd::sort model="id" label="id" />
                    </th>
                    <th>
                        <x-rpd::sort model="name" label="name" />
                    </th>
                    <th>slug</th>


                </tr>
                </thead>
                <tbody>
                @foreach ($items as $tag)
                    <tr>
                        <td>
                            <a href="{{ route('kb.tags.edit',$tag->id) }}">{{ $tag->id }}</a>
                        </td>
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->slug }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </x-rpd::table>

</div>

