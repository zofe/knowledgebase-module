 <x-rpd::edit title="Categories Edit">

        <x-slot name="buttons">
            <a href="{{ route('kb.admin.categories.table') }}" class="btn btn-primary">cancel</a>
        </x-slot>

        <div class="row">
            <div class="form-group col-md-6">
                <x-rpd::input model="category.name" label="Name" />
            </div>
            <div class="form-group col-md-6">
                <x-rpd::input model="category.slug" label="Slug" />
            </div>
        </div>

        <div class="row mb-4">
        </div>

        <x-slot name="actions">
            <button type="submit" class="btn btn-primary">Save</button>
        </x-slot>

    </x-rpd::edit>
