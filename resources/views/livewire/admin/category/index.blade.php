<div>
    {{-- Delete Model Start --}}
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Category Delete</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destoryCategory">
                    <div class="modal-body">
                        <h6>Are you sure you want to delete this?</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-rounded"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger btn-rounded">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Delete Model End --}}

    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Cateogry <a href="{{ route('category.create') }}"
                            class="btn btn-primary btn-rounded btn-sm float-end text-white">Add Category</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No#</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <input type="hidden" value="{{ $i = 1 }}">
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->status == '1' ? 'Active' : 'Deactive' }}</td>
                                        <td><a href="{{ url('admin/category/' . $category->id . '/edit') }}"
                                                class="btn btn-primary btn-rounded btn-sm text-white">Edit</a>
                                            <a href="#" wire:click="deleteCatagory({{ $category->id }})"
                                                class="btn btn-danger btn-rounded btn-sm text-white"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</a>
                                        </td>
                                    </tr>
                                    <input type="hidden" value="{{ $i += 1 }}">
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('close-delete-modal', event => {
            $('#deleteModal').modal('hide');
        });
    </script>
@endpush
