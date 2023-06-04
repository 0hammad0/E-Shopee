<div>

    {{-- Add Brand Start Modal --}}
    <div class="modal fade" id="addBrand" tabindex="-1" aria-labelledby="addBrandLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addBrandLabel">Add Brand</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="storeBrand()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="brandName"
                                placeholder="Brand name..." wire:model.defer="brandName" />
                            @error('brandName')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="brandSlug">Slug:</label>
                            <input type="text" class="form-control" id="brandSlug" name="brandSlug"
                                placeholder="slug..." wire:model.defer="brandSlug" />
                            @error('brandSlug')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select class="form-control" id="status" name="brandStatus"
                                wire:model.defer="brandStatus">
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                            @error('brandStatus')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-rounded"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-rounded text-white">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal --}}

    {{-- Edit Brand Start Model --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editBrandLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editBrandLabel">Edit Brand</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="updateBrand">
                    <div wire:loading class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div class="modal-body" wire:loading.remove>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="brandName"
                                placeholder="Brand name..." wire:model.defer="brandName" />
                            @error('brandName')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="brandSlug">Slug:</label>
                            <input type="text" class="form-control" id="brandSlug" name="brandSlug"
                                placeholder="slug..." wire:model.defer="brandSlug" />
                            @error('brandSlug')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select class="form-control" id="status" name="brandStatus"
                                wire:model.defer="brandStatus">
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                            @error('brandStatus')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-rounded"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-rounded text-white">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Edit Brand End Model --}}

    {{-- Delete Brand Start Model --}}
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Category Delete</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destoryBrand">
                    <div class="modal-body">
                        <h6>Are you sure you want to delete {{ $brandName }}?</h6>
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
    {{-- Delete Brand End Model --}}

    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Brand <a href="{{ route('category.create') }}"
                            class="btn btn-primary btn-rounded btn-sm float-end text-white" data-bs-toggle="modal"
                            data-bs-target="#addBrand">Add brand</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($brands as $brand)
                                    <tr>
                                        <td>{{ $loop->iteration + ($brands->currentPage() - 1) * $brands->perPage() }}
                                        </td>
                                        <td>{{ $brand->name }}</td>
                                        <td>{{ $brand->slug }}</td>
                                        <td class="{{ $brand->status == '1' ? 'text-success' : 'text-danger' }}">
                                            {{ $brand->status == '1' ? 'Active' : 'Deactive' }}</td>
                                        <td><a href="#" data-bs-toggle="modal"
                                                class="btn btn-primary btn-rounded btn-sm text-white"
                                                wire:click="editBrand({{ $brand->id }})">Edit</a>
                                            <a href="#" wire:click="deleteBrand({{ $brand->id }})"
                                                class="btn btn-danger btn-rounded btn-sm text-white"
                                                data-bs-toggle="modal">Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No Brand Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{ $brands->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('closeBrandModal', event => {
            $('#addBrand').modal('hide');
        });

        window.addEventListener('openEditModal', event => {
            $('#editModal').modal('show');
        });
        window.addEventListener('closeEditModal', event => {
            $('#editModal').modal('hide');
        });

        window.addEventListener('openDeleteBrandModal', event => {
            $('#deleteModal').modal('show');
        });
        window.addEventListener('closeDeleteBrandModal', event => {
            $('#deleteModal').modal('hide');
        });
    </script>
@endpush
